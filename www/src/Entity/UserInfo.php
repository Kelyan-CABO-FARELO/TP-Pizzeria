<?php

namespace App\Entity;

use JulienLinard\Doctrine\Mapping\Entity;
use JulienLinard\Doctrine\Mapping\Column;
use JulienLinard\Doctrine\Mapping\Id;

#[Entity(table: 'User_info')]
class UserInfo
{
    #[Id]
    #[Column(type: 'integer', autoIncrement: true)]
    public ?int $id = null;

    #[Column(type: 'string', length: 15, nullable: true)]
    public ?string $mobile = null;

    #[Column(type: 'string', length: 255, nullable: true)]
    public ?string $address = null;
}