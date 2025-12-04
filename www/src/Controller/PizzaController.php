<?php

namespace App\Controller;

use JulienLinard\Router\Response;
use App\Middleware\AdminMiddleware;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Core\Controller\Controller;

class PizzaController extends Controller
{
    /**
     * Route vers la création de nouvelles pizzas
     * Vérification que l'utilisateur est un admin grâce au middleware
     */
    #[Route(path: '/pizza/create',methods: ['GET'],name: 'create', middleware: [AdminMiddleware::class]
    )]
    public function create(): Response
    {
        return $this->view('pizza/create', [
            'title' => 'ajouter des pizzas'
        ]);
    }
}