<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Entity\Taille;
use JulienLinard\Router\Response;
use App\Middleware\AdminMiddleware;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Core\Controller\Controller;
use JulienLinard\Doctrine\EntityManager; // Pour parler à la BDD
use JulienLinard\Core\Form\Validator; // Pour vérifier les données
use JulienLinard\Core\Middleware\CsrfMiddleware; // Pour le token CSRF
use JulienLinard\Router\Request; // Nécessaire pour récupérer les données POST

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
        $title = $request->getPost('title');
        $description = $request->getPost('description');
        $price = $request->getPost('price');
        if (!$this->validator->required($title) || !$this->validator->required($price)) {
            return $this->view('pizza/create', [
                'title' => 'Ajouter une pizza',
                'error' => 'Le nom et le prix sont obligatoires.',
                'csrf_token' => CsrfMiddleware::getToken()
            ]);
        }

        $imageUrl = null;
        if (isset($_FILES['media']) && $_FILES['media']['error'] === 0) {
            $uploadDir = dirname(__DIR__, 2) . '/public/uploads/pizzas/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', basename($_FILES['media']['name']));

            if (move_uploaded_file($_FILES['media']['tmp_name'], $uploadDir . $filename)) {
                $imageUrl = '/uploads/pizzas/' . $filename;
            }
        }

        try {
            $pizza = new Pizza();
            $pizza->name = $title;
            $pizza->description = $description ?? '';
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

    /**
     * Affiche le formulaire
     */
    #[Route(path: '/modify', methods: ['GET'], name: 'pizza.list_modify', middleware: [AdminMiddleware::class])]
    public function listModify(): Response
    {
        // On récupère toutes les pizzas pour les afficher dans la grille
        $pizzas = $this->em->getRepository(Pizza::class)->findAll();

        return $this->view('pizza/modify', [
            'title' => 'Modifier une pizza',
            'pizzas' => $pizzas // On passe la liste à la vue
        ]);
    }

    #[Route(path: '/pizza/edit/{id}', methods: ['GET'], name: 'pizza.edit', middleware: [AdminMiddleware::class])]
    public function edit(int $id): Response
    {
        try {
            $pizza = $this->em->find(Pizza::class, $id);
        } catch (\Exception $e) {
            $pizza = null;
        }

        if (!$pizza) {
            return $this->redirect('/modify');
        }

        return $this->view('pizza/edit', [
            'title' => 'Modifier : ' . $pizza->name,
            'pizza' => $pizza,
            'csrf_token' => CsrfMiddleware::getToken()
        ]);
    }

    /**
     * Traite la soumission du formulaire de modification
     */
    #[Route(path: '/pizza/edit/{id}', methods: ['POST'], name: 'pizza.update', middleware: [AdminMiddleware::class])]
    public function update(int $id, Request $request): Response
    {
        try {
            $pizza = $this->em->find(Pizza::class, $id);
        } catch (\Exception $e) {
            return $this->redirect('/modify');
        }

        if (!$pizza) return $this->redirect('/modify');

        $title = $request->getPost('title');
        $description = $request->getPost('description');
        $price = $request->getPost('price');

        if (!$this->validator->required($title) || !$this->validator->required($price)) {
            return $this->view('pizza/edit', [
                'title' => 'Modifier : ' . $pizza->name,
                'pizza' => $pizza,
                'error' => 'Champs obligatoires manquants',
                'csrf_token' => CsrfMiddleware::getToken()
            ]);
        }

        // Gestion image
        if (isset($_FILES['media']) && $_FILES['media']['error'] === 0) {
            $uploadDir = dirname(__DIR__, 2) . '/public/uploads/pizzas/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);
            
            $filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', basename($_FILES['media']['name']));
            
            if (move_uploaded_file($_FILES['media']['tmp_name'], $uploadDir . $filename)) {
                // Supprimer l'ancienne image pour nettoyer le serveur
                if ($pizza->image_url && file_exists(dirname(__DIR__, 2) . '/public' . $pizza->image_url)) {
                    @unlink(dirname(__DIR__, 2) . '/public' . $pizza->image_url);
                }
                $pizza->image_url = '/uploads/pizzas/' . $filename;
            }
        }

        // Mise à jour
        $pizza->name = $title;
        $pizza->description = $description ?? '';
        $pizza->base_price = (float) $price;

        try {
            // AJOUT IMPORTANT : persist() force l'ORM à regarder cet objet
            $this->em->persist($pizza); 
            $this->em->flush();
            return $this->redirect('/modify');
        } catch (\Exception $e) {
            return $this->view('pizza/edit', [
                'title' => 'Modifier : ' . $pizza->name,
                'pizza' => $pizza,
                'error' => 'Erreur SQL : ' . $e->getMessage(),
                'csrf_token' => CsrfMiddleware::getToken()
            ]);
        }
    }

    /**
     * NOUVEAU : Méthode pour supprimer une pizza
     */
    #[Route(path: '/pizza/delete/{id}', methods: ['GET'], name: 'pizza.delete', middleware: [AdminMiddleware::class])]
    public function delete(int $id): Response
    {
        try {
            $pizza = $this->em->find(Pizza::class, $id);
            if ($pizza) {
                // On supprime l'image du dossier si elle existe
                if ($pizza->image_url && file_exists(dirname(__DIR__, 2) . '/public' . $pizza->image_url)) {
                    @unlink(dirname(__DIR__, 2) . '/public' . $pizza->image_url);
                }
                
                $this->em->remove($pizza);
                $this->em->flush();
            }
        } catch (\Exception $e) {
            // On ignore l'erreur ou on logge
        }
        
        return $this->redirect('/modify');
    }

    #[Route(path: '/sizeprice', methods: ['GET'], name: 'size_price', middleware: [AdminMiddleware::class])]
    public function sizeprice(): Response
    {
        // On récupère la liste
        $tailles = $this->em->getRepository(Taille::class)->findAll();

        return $this->view('pizza/sizeprice', [ // Note : Assurez-vous que le fichier est bien dans views/pizza/
            'title' => 'Gérer les tailles', // J'ai corrigé le titre aussi
            'tailles' => $tailles // J'ai mis 'tailles' au pluriel pour être cohérent
        ]);
    }
}
