<?php

declare(strict_types=1);

namespace App\Entity;

use JulienLinard\Doctrine\Mapping\Entity;
use JulienLinard\Doctrine\Mapping\Column;
use JulienLinard\Doctrine\Mapping\Id;
use JulienLinard\Auth\Models\UserInterface;

#[Entity(table: 'User')]
class User implements UserInterface
{
    #[Id]
    #[Column(type: 'integer', autoIncrement: true)]
    public int $id;

    #[Column(type: 'string', length: 100)]
    public string $lastname;

    #[Column(type: 'string', length: 100)]
    public string $firstname;

    #[Column(type: 'string', length: 150)]
    public string $email;

    #[Column(type: 'string', length: 255)]
    public string $password;

    #[Column(type: 'string', length: 10, default: 'CLIENT')]
    public string $role = 'CLIENT';

    // Relation avec User_info (optionnel pour le login, mais présent en base)
    #[Column(name: 'id_user_info', type: 'integer', nullable: true)]
    public ?int $id_user_info = null;

    /**
     * ===============================================
     * Méthodes requises par UserInterface
     * ===============================================
     */

    public function getAuthIdentifier(): int|string
    {
        return $this->id;
    }

    public function getAuthPassword(): string
    {
        return $this->password;
    }

    public function getAuthRoles(): array|string
    {
        return $this->role;
    }

    public function getAuthPermissions(): array
    {
        // Vous pourrez retourner des permissions spécifiques ici plus tard
        return [];
    }
}