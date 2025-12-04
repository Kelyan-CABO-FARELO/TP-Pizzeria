<?php


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
    public ?int $id = null;

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
    #[Column(type: 'integer', default: NULL)]
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

    /**
     * Vérifie si l'utilisateur possède le rôle donné.
     * Appelée par $auth->hasRole('ADMIN')
     */
    public function hasRole(string $role): bool
    {
        // On récupère les rôles via la méthode standard définie dans l'interface
        $currentRoles = $this->getAuthRoles();

        // Si c'est un tableau (ex: ['USER', 'ADMIN']), on cherche dedans
        if (is_array($currentRoles)) {
            return in_array($role, $currentRoles);
        }

        // Si c'est juste une chaîne (ex: 'ADMIN'), on compare directement
        return $currentRoles === $role;
    }

    /**
     * Vérifie si l'utilisateur a une permission spécifique.
     * Appelée par $auth->can('edit_post')
     */
    public function hasPermission(string $permission): bool
    {
        return in_array($permission, $this->getAuthPermissions());
    }
}