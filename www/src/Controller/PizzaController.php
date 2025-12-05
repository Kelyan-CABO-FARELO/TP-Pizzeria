<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Middleware\AdminMiddleware;
use JulienLinard\Router\Request; // Nécessaire pour récupérer les données POST
use JulienLinard\Router\Response;
use JulienLinard\Doctrine\EntityManager; // Pour parler à la BDD
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Core\Controller\Controller;
use JulienLinard\Core\Form\Validator; // Pour vérifier les données
use JulienLinard\Core\Middleware\CsrfMiddleware; // Pour le token CSRF

class PizzaController extends Controller
{
    // On injecte les services nécessaires
    public function __construct(
        private EntityManager $em,
        private Validator $validator
    ) {}

    /**
     * Affiche le formulaire
     */
    #[Route(path: '/pizza/create', methods: ['GET'], name: 'create', middleware: [AdminMiddleware::class])]
    public function create(): Response
    {
        return $this->view('pizza/create', [
            'title' => 'Ajouter une pizza',
            'csrf_token' => CsrfMiddleware::getToken()
        ]);
    }

    /**
     * Traite le formulaire (C'est cette partie qui manquait !)
     */
    /**
     * Traite le formulaire de création
     */
    #[Route(path: '/pizza/create', methods: ['POST'], name: 'create.post', middleware: [AdminMiddleware::class])]
    public function store(Request $request): Response
    {
        // CORRECTION ICI : Utilisation de getPost() au lieu de getBodyParam()
        // getBodyParam() ne fonctionne pas avec multipart/form-data
        $title = $request->getPost('title');
        $description = $request->getPost('description');
        $price = $request->getPost('price');
        
        // Validation des données
        // On vérifie que les variables ne sont pas nulles ou vides
        if (!$this->validator->required($title) || !$this->validator->required($price)) {
            return $this->view('pizza/create', [
                'title' => 'Ajouter une pizza',
                'error' => 'Le nom et le prix sont obligatoires.',
                'csrf_token' => CsrfMiddleware::getToken()
            ]);
        }

        // Gestion de l'upload d'image
        $imageUrl = null;
        // $_FILES est géré séparément par PHP, c'est correct
        if (isset($_FILES['media']) && $_FILES['media']['error'] === 0) {
            $uploadDir = dirname(__DIR__, 2) . '/public/uploads/pizzas/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            
            // Sécurisation du nom de fichier
            $filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', basename($_FILES['media']['name']));
            
            if (move_uploaded_file($_FILES['media']['tmp_name'], $uploadDir . $filename)) {
                $imageUrl = '/uploads/pizzas/' . $filename;
            }
        }

        // Création et sauvegarde de l'entité
        try {
            $pizza = new Pizza();
            $pizza->name = $title; 
            $pizza->description = $description ?? ''; // Assure que ce n'est pas null
            $pizza->base_price = (float) $price;
            $pizza->image_url = $imageUrl;

            $this->em->persist($pizza);
            $this->em->flush();
            
            return $this->redirect('/'); 
        } catch (\Exception $e) {
            return $this->view('pizza/create', [
                'title' => 'Ajouter une pizza',
                'error' => 'Erreur technique : ' . $e->getMessage(),
                'csrf_token' => CsrfMiddleware::getToken()
            ]);
        }
    }
}