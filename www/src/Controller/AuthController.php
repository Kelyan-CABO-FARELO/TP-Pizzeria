<?php

/**
 * ============================================
 * AUTH CONTROLLER
 * ============================================
 * * Contrôleur pour l'authentification (login, register, logout)
 * Utilise AuthManager pour gérer l'authentification
 */

declare(strict_types=1);

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Service\Logger;
use App\Service\Validator as Vvalidator;
use JulienLinard\Router\Request;
use JulienLinard\Router\Response;
use App\Repository\UserRepository;
// AJOUT : Import du Middleware CSRF pour récupérer le token
use JulienLinard\Auth\AuthManager;
use JulienLinard\Core\Form\Validator;
use JulienLinard\Core\Session\Session;
use JulienLinard\Core\View\ViewHelper;
use JulienLinard\Doctrine\EntityManager;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Core\Controller\Controller;
use JulienLinard\Auth\Middleware\GuestMiddleware;
use JulienLinard\Core\Middleware\CsrfMiddleware as CsrfCoreMiddleware;

class AuthController extends Controller
{
    public function __construct(
        private AuthManager $auth,
        private EntityManager $em,
        private Validator $validator,
        private UserRepository $userRepository,
        private Vvalidator $vvalidator
    ) {}

    /**
     * Affiche le formulaire de connexion
     */
    #[Route(path: '/auth/login', methods: ['GET'], name: 'login', middleware: [new GuestMiddleware()])]
    public function loginForm(): Response
    {
        return $this->view('auth/login', [
            'title' => 'Connexion',
            // CORRECTION : On passe le token à la vue
            'csrf_token' => CsrfCoreMiddleware::getToken()
        ]);
    }

    /**
     * Traite la connexion
     */
    #[Route(path: '/auth/login', methods: ['POST'], name: 'login.post', middleware: [new GuestMiddleware()])]
    public function login(Request $request): Response
    {
        $email = $request->getBodyParam('email', '');
        $password = $request->getBodyParam('password', '');
        $remember = $request->getBodyParam('remember', false);

        // Validation
        $errors = [];

        if (!$this->validator->required($email)) {
            $errors['email'] = 'L\'email est requis';
        } elseif (!$this->validator->email($email)) {
            $errors['email'] = 'L\'email n\'est pas valide';
        }

        if (!$this->validator->required($password)) {
            $errors['password'] = 'Le mot de passe est requis';
        }

        // ...
        if (!empty($errors)) {
            // Optionnel si on affiche directement : Session::flash(...) n'est pas strictement nécessaire ici
            $errorMsg = 'Veuillez corriger les erreurs du formulaire';

            return $this->view('auth/login', [
                'title' => 'Connexion',
                'errors' => $errors,
                'old' => ['email' => $email],
                'csrf_token' => CsrfCoreMiddleware::getToken(),
                // AJOUT ICI : On passe la variable $error à la vue
                'error' => $errorMsg
            ]);
        }

        // Tentative d'authentification
        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        // N'oubliez pas la correction de redirection ici aussi (vers '/')
        if ($this->auth->attempt($credentials, (bool)$remember)) {
            Session::flash('success', 'Connexion réussie !');
            return $this->redirect('/');
        }

        // Echec de connexion
        $errorMsg = 'Email ou mot de passe incorrect';

        return $this->view('auth/login', [
            'title' => 'Connexion',
            'old' => ['email' => $email],
            'csrf_token' => CsrfCoreMiddleware::getToken(),
            // AJOUT ICI : On passe la variable $error à la vue
            'error' => $errorMsg
        ]);
    }

    #[Route(path: "/register", name: "app_register", middleware: [GuestMiddleware::class])]
    public function signForm()
    {
        return $this->view("auth/register", [
            "csrf_token" => ViewHelper::csrfToken()
        ]);
    }

    /**
     * Méthode qui récupère les informations du formuliare de création de compte
     */
    #[Route(path: "/register", methods: ["POST"], name: "app_register.post", middleware: [GuestMiddleware::class, CsrfCoreMiddleware::class])]
    public function register(Request $request)
    {
        try {
            $email = trim($_POST['email']) ?? '';
            $password = $_POST['password'] ?? '';
            $firstname = trim($_POST['firstname']) ?? '';
            $lastname = trim($_POST['lastname']) ?? '';

            //Validation
            $is_valid = true;
            $is_valid = $this->vvalidator->validateEmail($email) && $is_valid;
            $is_valid = $this->vvalidator->validatePassword($password)  && $is_valid;
            $is_valid = $this->vvalidator->validateName($firstname, 'firstname, true, 100') && $is_valid;
            $is_valid = $this->vvalidator->validateName($lastname, 'lastname, true, 100') && $is_valid;

            if (!$is_valid) {
                $error = $this->vvalidator->getFirstError() ?? "Les données fournies ne sont pas valides";
                Logger::warning("Validation échouée lors de l'inscription", [
                    'email' => $email,
                    'errors' => $this->vvalidator->getErrors()
                ]);

                return $this->view("auth/register", [
                    "error" => $error,
                    "csrf_token" => ViewHelper::csrfToken()
                ]);
            }

            //Tout va bien on doit vérifier si l'utilisateur existe deja dans la bdd, On doit communiquer avec la bdd
            if ($this->userRepository->emailExists($email)) {
                // Si l'email existe
                Logger::warning("Tentative d'inscrisption avec un email existant", ["email" => $email]);
                return $this->view("auth/register", [
                    "error" => "Cet email existe déjà",
                    "csrf_token" => ViewHelper::csrfToken()
                ]);
            }

            //L'utilisateur n'existe pas on doit le créer
            // On instnacie un nouvel objet User
            $user = new User;
            // Si getter setter => $user->setEmail($email)
            $user->email = $email;
            $user->password = password_hash($password, PASSWORD_BCRYPT);
            $user->firstname = $firstname;
            $user->lastname = $lastname;

            $this->em->persist($user);

            $this->em->flush();

            $savedUser = $this->userRepository->findByEmail($email);

            // On connecte l'utilisateur
            $this->auth->login($savedUser);

            Logger::info("Nouvel utilisateur inscrit", ["email" => $email]);

            return $this->redirect("/");
        } catch (\Exception $e) {
            Logger::exception($e, ["action" => "register"]);
            return $this->view("auth/register", [
                "error" => $e,
                "csrf_token" => ViewHelper::csrfToken()
            ]);
        }
    }

    /**
     * Méthode de déconnexion
     * @return Response
     */
    #[Route(path: '/logout', methods: ['GET'], name: 'logout')]
    public function logout(): Response
    {
        $this->auth->logout();
        return $this->redirect('/');
    }
}
