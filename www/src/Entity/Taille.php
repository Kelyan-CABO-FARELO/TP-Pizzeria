<?php

namespace App\Entity;

use JulienLinard\Doctrine\Mapping\Entity;
use JulienLinard\Doctrine\Mapping\Column;
use JulienLinard\Doctrine\Mapping\Id;

#[Entity(table: 'Taille')]
class Taille
{
    #[Id]
    #[Column(type: 'integer', autoIncrement: true)]
    public ?int $id = null;

    #[Column(type: 'string', length: 50)]
    public string $label;

    // CHANGÉ : C'est maintenant un montant à ajouter (ex: +2.00 ou -1.00)
    #[Column(type: 'float', default: 0.00)]
    public float $price_supplement = 0.00;
}