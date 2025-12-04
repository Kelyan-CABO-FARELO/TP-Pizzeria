<?php

/**
 * ============================================
 * HOME CONTROLLER
 * ============================================
 * 
 * CONCEPT PÉDAGOGIQUE : Controller simple
 * 
 * Ce contrôleur gère la route racine "/" et affiche la page d'accueil.
 */

declare(strict_types=1);

namespace App\Controller;

use JulienLinard\Router\Response;
use App\Middleware\AdminMiddleware;
use JulienLinard\Core\View\ViewHelper;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Core\Controller\Controller;

class HomeController extends Controller
{
    /**
     * Route racine : affiche la page d'accueil
     * 
     * CONCEPT : Route simple sans middleware
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
     * Pas besoin d'être connecté don cpas de middleware
     */
    #[Route(path: '/carte', methods: ['GET'], name: 'carte')]
    public function carte(): Response
    {
        return $this->view('home/carte', [
            'title' => 'Notre carte'
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
    #[Route(
        path: '/pizza',methods: ['GET'],name: 'pizza', middleware: [AdminMiddleware::class]
    )]
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
        path: '/commandes',methods: ['GET'],name: 'commandes', middleware: [AdminMiddleware::class]
    )]
    public function commandes(): Response
    {
        return $this->view('home/commandes', [
            'title' => 'Gérer les commandes'
        ]);
    }
}
