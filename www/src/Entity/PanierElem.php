<?php

namespace App\Entity;

use JulienLinard\Doctrine\Mapping\Entity;
use JulienLinard\Doctrine\Mapping\Column;
use JulienLinard\Doctrine\Mapping\Id;

#[Entity(table: 'Panier_elem')]
class PanierElem
{
    // Note: Table avec clé primaire composite (id_panier, id_produit)
    
    #[Id]
    #[Column(type: 'integer')]
    public int $id_panier;

    #[Id]
    #[Column(type: 'integer')]
    public int $id_produit;

    #[Column(type: 'integer', default: 1)]
    public int $quantity = 1;
}