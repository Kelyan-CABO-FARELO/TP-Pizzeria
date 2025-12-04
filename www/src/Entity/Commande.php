<?php

namespace App\Entity;

use JulienLinard\Doctrine\Mapping\Entity;
use JulienLinard\Doctrine\Mapping\Column;
use JulienLinard\Doctrine\Mapping\Id;

#[Entity(table: 'Commande')]
class Commande
{
    #[Id]
    #[Column(type: 'integer', autoIncrement: true)]
    public ?int $id = null;

    #[Column(type: 'integer')]
    public int $id_user;

    #[Column(type: 'integer')]
    public int $id_statut;

    // Le DEFAULT CURRENT_TIMESTAMP est géré par la BDD, 
    // on peut laisser null à la création coté PHP ou initialiser avec date()
    #[Column(type: 'datetime')] 
    public ?string $date = null;

    #[Column(type: 'float')]
    public float $total_price;
}