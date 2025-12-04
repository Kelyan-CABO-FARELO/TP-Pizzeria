<?php

namespace App\Entity;

use JulienLinard\Doctrine\Mapping\Entity;
use JulienLinard\Doctrine\Mapping\Column;
use JulienLinard\Doctrine\Mapping\Id;

#[Entity(table: 'Pizza')]
class Pizza
{
    #[Id]
    #[Column(type: 'integer', autoIncrement: true)]
    public ?int $id = null;

    #[Column(type: 'string', length: 100)]
    public string $name;

    #[Column(type: 'text')]
    public string $description;

    #[Column(type: 'string', length: 255, nullable: true)]
    public ?string $image_url = null;

    // NOUVEAU : Le prix de base (ex: 8.00)
    #[Column(type: 'float')]
    public float $base_price;
}