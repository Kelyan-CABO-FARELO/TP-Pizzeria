<?php 

namespace App\Repository;

use App\Entity\User;
use JulienLinard\Doctrine\Database\Connection;
use JulienLinard\Doctrine\EntityManager;
use JulienLinard\Doctrine\Metadata\MetadataReader;
use JulienLinard\Doctrine\Repository\EntityRepository;

class UserRepository extends EntityRepository
{
    public function __construct(EntityManager $em, string $entityClass = User::class)
    {
        parent::__construct(
            $em->getConnection(),
            $em->getMetadataReader(),
            $entityClass
        );
    }



    /**
     * Méthode qui récupère un uilisateur grâce à son email
     * @param string $email
     * @return User|null L'utilisateur ou null si pas trouvé
     */
    public function findByEmail(string $email):User|null{
        // Requête SQL: SELECT * FROM user WHERE email=$email
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * Méthode qui vérifie qu'un email existe déja
     * @param string $email
     * @return bool
     */
    public function emailExists(string $email):bool{
        return $this->findByEmail($email) !== null;
    }
}