<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Entity\Taille;
use JulienLinard\Router\Request;
use JulienLinard\Router\Response;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Core\Controller\Controller;
use JulienLinard\Doctrine\EntityManager;

class PanierController extends Controller
{
    public function __construct(private EntityManager $em) {}

    #[Route(path: '/panier', methods: ['GET'], name: 'panier.index')]
    public function index(): Response
    {
        $sessionPanier = $_SESSION['panier'] ?? [];
        $panierComplet = [];
        $total = 0;

        foreach ($sessionPanier as $id => $item) {
            $pizza = $this->em->find(Pizza::class, $item['pizza_id']);
            $taille = $this->em->find(Taille::class, $item['taille_id']);

            if ($pizza && $taille) {
                $prixPizza = $pizza->base_price + $taille->price_supplement;
                $panierComplet[] = [
                    'pizza' => $pizza,
                    'taille' => $taille,
                    'quantity' => 1, // On simplifie à 1 pour l'instant
                    'price' => $prixPizza,
                    'index' => $id // Pour pouvoir supprimer
                ];
                $total += $prixPizza;
            }
        }

        return $this->view('home/panier', [
            'title' => 'Votre Panier',
            'items' => $panierComplet,
            'total' => $total
        ]);
    }

    #[Route(path: '/panier/add', methods: ['POST'], name: 'panier.add')]
    public function add(Request $request): Response
    {
        $pizzaId = $request->getPost('pizza_id');
        $tailleId = $request->getPost('size');

        if (!$pizzaId || !$tailleId) {
            return $this->redirect('/carte');
        }

        // On ajoute au panier en session
        if (!isset($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        $_SESSION['panier'][] = [
            'pizza_id' => $pizzaId,
            'taille_id' => $tailleId
        ];

        return $this->redirect('/panier');
    }

    #[Route(path: '/panier/remove/{index}', methods: ['GET'], name: 'panier.remove')]
    public function remove(int $index): Response
    {
        if (isset($_SESSION['panier'][$index])) {
            unset($_SESSION['panier'][$index]);
        }
        return $this->redirect('/panier');
    }
}