<?php

namespace App\Entity;

use JulienLinard\Doctrine\Mapping\Entity;
use JulienLinard\Doctrine\Mapping\Column;
use JulienLinard\Doctrine\Mapping\Id;

#[Entity(table: 'Pizza_Produit')]
class PizzaProduit
{
    #[Id]
    #[Column(type: 'integer', autoIncrement: true)]
    public ?int $id = null;

    #[Column(type: 'integer')]
    public int $id_pizza;

    #[Column(type: 'integer')]
    public int $id_taille;

    // RETIRÉ : public float $price; 
    // Le prix n'est plus stocké ici, il est calculé (Pizza.base_price + Taille.price_supplement)
}