<?php

namespace App\Controller;

use App\Entity\Pizza;
use App\Entity\Taille;
use App\Entity\Commande;
use App\Entity\CommandeLigne;
use App\Entity\StatutCommande;
use JulienLinard\Router\Request;
use JulienLinard\Router\Response;
use App\Middleware\AdminMiddleware;
use JulienLinard\Doctrine\EntityManager;
use JulienLinard\Router\Attributes\Route;
use JulienLinard\Core\Controller\Controller;
use JulienLinard\Auth\Middleware\AuthMiddleware;

class CommandeController extends Controller
{
    public function __construct(private EntityManager $em) {}

    /**
     * Valide le panier et crée la commande en BDD
     */
    #[Route(path: '/commande/validate', methods: ['POST'], name: 'commande.validate', middleware: [AuthMiddleware::class])]
    public function validate(): Response
    {
        $sessionPanier = $_SESSION['panier'] ?? [];
        if (empty($sessionPanier)) {
            return $this->redirect('/carte');
        }

        // 1. Création de la commande globale
        $commande = new Commande();
        $commande->id_user = $_SESSION['user_id'];
        $commande->id_statut = 1; // ID 1 = "En attente" ou "Validée"
        $commande->date = date('Y-m-d H:i:s');
        $commande->total_price = 0; // On calculera après

        $this->em->persist($commande);
        $this->em->flush(); // Pour récupérer l'ID de la commande

        $total = 0;

        // 2. Création des lignes
        foreach ($sessionPanier as $item) {
            $pizza = $this->em->find(Pizza::class, $item['pizza_id']);
            $taille = $this->em->find(Taille::class, $item['taille_id']);

            if ($pizza && $taille) {
                // Calcul du prix : Base de la pizza + supplément taille
                $prixLigne = $pizza->base_price + $taille->price_supplement;
                
                $ligne = new CommandeLigne();
                
                // CORRECTIONS ICI : mapping avec les noms de l'Entité CommandeLigne
                $ligne->id_commande = $commande->id;    // Au lieu de commande_id
                $ligne->id_produit = $pizza->id;        // Au lieu de pizza_id
                $ligne->quantity = 1;
                $ligne->unit_price = $prixLigne;        // Au lieu de price

                // ATTENTION : Votre entité CommandeLigne n'a pas de propriété pour la taille.
                // Si vous voulez stocker la taille, vous devez ajouter "public int $id_taille;" dans l'entité et la table.
                // $ligne->id_taille = $taille->id; 

                $this->em->persist($ligne);
                $total += $prixLigne;
            }
        }

        // 3. Mise à jour du total
        $commande->total_price = $total;
        $this->em->persist($commande);
        $this->em->flush();

        // 4. Vider le panier
        unset($_SESSION['panier']);

        return $this->redirect('/mes-commandes');
    }

    /**
     * Page client : Voir ses commandes
     */
    #[Route(path: '/mes-commandes', methods: ['GET'], name: 'commande.mine', middleware: [AuthMiddleware::class])]
    public function myOrders(): Response
    {
        // Récupérer les commandes du user connecté
        // Assurez-vous que 'id_user' et 'date' sont bien les noms dans l'entité Commande
        $commandes = $this->em->getRepository(Commande::class)->findBy(['id_user' => $_SESSION['user_id']], ['date' => 'DESC']);
        
        // Pour afficher les statuts en texte
        $statuts = $this->em->getRepository(StatutCommande::class)->findAll();
        $statusMap = [];
        foreach($statuts as $s) $statusMap[$s->id] = $s->label;

        return $this->view('home/mes_commandes', [
            'title' => 'Mes commandes',
            'commandes' => $commandes,
            'statusMap' => $statusMap
        ]);
    }

    /**
     * Page Admin : Gérer toutes les commandes
     */
    #[Route(path: '/admin/commandes', methods: ['GET'], name: 'admin.commandes', middleware: [AdminMiddleware::class])]
    public function manageOrders(): Response
    {
        // Tri par date décroissante
        $commandes = $this->em->getRepository(Commande::class)->findBy([], ['date' => 'DESC']);
        $statuts = $this->em->getRepository(StatutCommande::class)->findAll();

        return $this->view('admin/commandes', [
            'title' => 'Gestion des commandes',
            'commandes' => $commandes,
            'statuts' => $statuts
        ]);
    }

    /**
     * Action Admin : Changer le statut
     */
    #[Route(path: '/admin/commande/status', methods: ['POST'], name: 'admin.commande.status', middleware: [AdminMiddleware::class])]
    public function updateStatus(Request $request): Response
    {
        $commandeId = $request->getPost('commande_id');
        $newStatusId = $request->getPost('status_id');

        $commande = $this->em->find(Commande::class, $commandeId);
        if ($commande) {
            // CORRECTION : Utilisation de id_statut au lieu de status_id
            $commande->id_statut = (int)$newStatusId;
            $this->em->persist($commande);
            $this->em->flush();
        }

        return $this->redirect('/admin/commandes');
    }
}