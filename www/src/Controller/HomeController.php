<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Entity\Taille;
use JulienLinard\Router\Request;
use JulienLinard\Router\Response;
use App\Middleware\AdminMiddleware;
use JulienLinard\Core\View\ViewHelper;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Core\Controller\Controller;
use JulienLinard\Doctrine\EntityManager;

class HomeController extends Controller
{
    public function __construct(
        private EntityManager $em
    ) {}

    /**
     * Route racine : affiche la page d'accueil
     */
    #[Route(path: '/', methods: ['GET'], name: 'home')]
    public function index(): Response
    {
        return $this->view('home/index', [
            'title' => 'Welcome',
            'message' => 'Hello World!'
        ]);
    }

    /**
     * Route vers la carte
     * Pas besoin d'être connecté donc pas de middleware
     */
    #[Route(path: '/carte', methods: ['GET'], name: 'carte')]
    public function carte(): Response
    {
        try {
            $pizzas = $this->em->getRepository(Pizza::class)->findAll();
            $taille = $this->em->getRepository(Taille::class)->findAll();
        } catch (\Exception $e) {
            $pizzas = []; // En cas d'erreur, liste vide pour ne pas casser la page
        }

        return $this->view('home/carte', [
            'title' => 'Notre carte',
            'pizzas' => $pizzas,
            'tailles' => $taille
        ]);
    }

    #[Route(path: '/onepizza/{id}', methods: ['GET'], name: 'onepizza')]
    public function onepizza(int $id): Response
    {
        try {
            $pizza = $this->em->find(Pizza::class, $id);
            // AJOUTE CETTE LIGNE : On récupère toutes les tailles
            $tailles = $this->em->getRepository(Taille::class)->findAll(); 
        } catch (\Exception $e) {
            $pizza = null;
            $tailles = [];
        }

        if (!$pizza) {
            return $this->redirect('/carte');
        }

        return $this->view('home/onepizza', [
            'title' => $pizza->name,
            'pizza' => $pizza,
            'tailles' => $tailles // <--- AJOUTE ÇA : On envoie la variable à la vue
        ]);
    }

    /**
     * Route vers l'histoire de la pizzeria
     * Pas besoin d'être connecté don cpas de middleware
     */
    #[Route(path: '/pizzeria', methods: ['GET'], name: 'pizzeria')]
    public function pizzeria(): Response
    {
        return $this->view('home/pizzeria', [
            'title' => 'Notre pizzeria'
        ]);
    }

    /**
     * Route vers la gestion des pizzas
     * Vérification que l'utilisateur est un admin grâce au middleware
     */
    #[Route(path: '/pizza', methods: ['GET'], name: 'pizza',middleware: [AdminMiddleware::class])]
    public function pizza(): Response
    {
        return $this->view('home/pizza', [
            'title' => 'Gérer les pizzas'
        ]);
    }

    /**
     * Route vers la gestion des des commandes
     * Vérification que l'utilisateur est un admin grâce au middleware
     */
    #[Route(
        path: '/commandes',
        methods: ['GET'],
        name: 'commandes',
        middleware: [AdminMiddleware::class]
    )]
    public function commandes(): Response
    {
        return $this->view('home/commandes', [
            'title' => 'Gérer les commandes'
        ]);
    }
}
