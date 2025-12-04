<?php

namespace App\Entity;

use JulienLinard\Doctrine\Mapping\Entity;
use JulienLinard\Doctrine\Mapping\Column;
use JulienLinard\Doctrine\Mapping\Id;

#[Entity(table: 'Commande_Ligne')]
class CommandeLigne
{
    #[Id]
    #[Column(type: 'integer', autoIncrement: true)]
    public ?int $id = null;

    #[Column(type: 'integer')]
    public int $id_commande;

    #[Column(type: 'integer')]
    public int $id_produit;

    #[Column(type: 'integer')]
    public int $quantity;

    #[Column(type: 'float')]
    public float $unit_price;
}