<?php

/**
 * ============================================
 * VALIDATOR SERVICE
 * ============================================
 * 
 * CONCEPT PÉDAGOGIQUE : Service de validation centralisé
 * 
 * Ce service centralise toute la logique de validation des données.
 * Il utilise le Validator de core-php en interne mais expose une API
 * compatible avec l'ancienne version pour faciliter la migration.
 * 
 * AVANTAGES :
 * 1. Réutilisabilité : mêmes règles de validation partout
 * 2. Maintenabilité : modifier les règles en un seul endroit
 * 3. Testabilité : facile à tester unitairement
 * 4. Séparation des responsabilités : le Controller délègue la validation
 * 
 * PRINCIPE : Validation côté serveur
 * La validation côté client (JavaScript) peut être contournée.
 * La validation côté serveur est OBLIGATOIRE pour la sécurité.
 */

namespace App\Service;

use JulienLinard\Core\Form\Validator as CoreValidator;

/**
 * Service de validation des données
 * 
 * CONCEPT : Service Layer avec wrapper autour de core-php Validator
 * Cette classe maintient l'API existante tout en utilisant core-php en interne
 */
class Validator
{
    /**
     * Tableau des erreurs de validation
     * 
     * CONCEPT : Stockage des erreurs
     * Chaque erreur est associée au nom du champ
     * Exemple : ['email' => "L'email est requis.", 'password' => "Le mot de passe est requis."]
     */
    private array $errors = [];
    
    private CoreValidator $coreValidator;

    public function __construct()
    {
        $this->coreValidator = new CoreValidator();
    }

    /**
     * Valide un email
     * 
     * CONCEPT PÉDAGOGIQUE : Validation en plusieurs étapes
     * 
     * Vérifications effectuées :
     * 1. Email non vide
     * 2. Format email valide (avec filter_var)
     * 3. Longueur maximale (255 caractères)
     * 
     * @param string $email Email à valider
     * @param string $fieldName Nom du champ (pour les messages d'erreur)
     * @return bool True si valide, false sinon
     */
    public function validateEmail(string $email, string $fieldName = 'email'): bool
    {
        // Vérifier que l'email n'est pas vide
        // CONCEPT : Validation "required"
        if (empty($email)) {
            $this->errors[$fieldName] = "L'email est requis.";
            return false;
        }

        // Vérifier le format de l'email avec filter_var()
        // CONCEPT : Validation de format avec les filtres PHP natifs
        // FILTER_VALIDATE_EMAIL vérifie le format RFC 5322
        if (!$this->coreValidator->email($email)) {
            $this->errors[$fieldName] = "L'email n'est pas valide.";
            return false;
        }

        // Vérifier la longueur maximale
        // CONCEPT : Validation de longueur (contrainte de la base de données)
        // La colonne email est VARCHAR(150), donc max 150 caractères
        if (!$this->coreValidator->max($email, 150)) {
            $this->errors[$fieldName] = "L'email ne peut pas dépasser 150 caractères.";
            return false;
        }

        return true;
    }

    /**
     * Valide un mot de passe
     * 
     * CONCEPT PÉDAGOGIQUE : Validation de sécurité
     * 
     * Règles de validation :
     * 1. Mot de passe non vide
     * 2. Longueur minimale (8 caractères par défaut)
     * 3. Complexité (majuscule, minuscule, chiffre, caractère spécial)
     * 
     * @param string $password Mot de passe à valider
     * @param string $fieldName Nom du champ
     * @param int $minLength Longueur minimale (défaut: 8)
     * @return bool True si valide, false sinon
     */
    public function validatePassword(string $password, string $fieldName = 'password', int $minLength = 8): bool
    {
        // Vérifier que le mot de passe n'est pas vide
        if (empty($password)) {
            $this->errors[$fieldName] = "Le mot de passe est requis.";
            return false;
        }

        // Vérifier la longueur minimale
        // CONCEPT : Politique de sécurité des mots de passe
        // Un mot de passe trop court est facile à deviner (force brute)
        if (!$this->coreValidator->min($password, $minLength)) {
            $this->errors[$fieldName] = "Le mot de passe doit contenir au moins {$minLength} caractères.";
            return false;
        }

        // Vérifier que le mdp contient au moins une majuscule, une minuscule, un chiffre et un caractère spécial en une seule regex
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/', $password)) {
            $this->errors[$fieldName] = "Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et un caractère spécial.";
            return false;
        }

        return true;
    }

    /**
     * Valide un titre de todo
     * 
     * CONCEPT : Validation de données métier
     * 
     * Règles :
     * 1. Titre non vide (après trim)
     * 2. Longueur maximale (500 caractères)
     * 
     * @param string $title Titre à valider
     * @param string $fieldName Nom du champ
     * @param int $maxLength Longueur maximale (défaut: 500)
     * @return bool True si valide, false sinon
     */
    public function validateTitle(string $title, string $fieldName = 'title', int $maxLength = 255): bool
    {
        // Supprimer les espaces en début/fin
        // CONCEPT : trim() pour nettoyer les données
        // Évite les titres avec seulement des espaces
        $title = trim($title);
        
        // Vérifier que le titre n'est pas vide après trim
        if (empty($title)) {
            $this->errors[$fieldName] = "Le titre est requis.";
            return false;
        }

        // Vérifier la longueur maximale
        // CONCEPT : Contrainte de la base de données
        // La colonne title est VARCHAR(500), donc max 500 caractères
        if (!$this->coreValidator->max($title, $maxLength)) {
            $this->errors[$fieldName] = "Le titre ne peut pas dépasser {$maxLength} caractères.";
            return false;
        }

        return true;
    }

    /**
     * Valide une description
     */
    public function validateDescription(?string $description, string $fieldName = 'description', int $maxLength = 65535): bool
    {
        if ($description === null || $description === '') {
            return true; // Description optionnelle
        }

        if (!$this->coreValidator->max($description, $maxLength)) {
            $this->errors[$fieldName] = "La description ne peut pas dépasser {$maxLength} caractères.";
            return false;
        }

        return true;
    }

    /**
     * Valide un nom (prénom ou nom)
     */
    public function validateName(?string $name, string $fieldName, bool $required = false, int $maxLength = 255): bool
    {
        $name = trim($name ?? '');
        
        if ($required && empty($name)) {
            $this->errors[$fieldName] = "Le champ {$fieldName} est requis.";
            return false;
        }

        if (!empty($name) && !$this->coreValidator->max($name, $maxLength)) {
            $this->errors[$fieldName] = "Le champ {$fieldName} ne peut pas dépasser {$maxLength} caractères.";
            return false;
        }

        return true;
    }

    /**
     * Valide un ID
     */
    public function validateId(int $id, string $fieldName = 'id'): bool
    {
        if ($id <= 0) {
            $this->errors[$fieldName] = "L'ID doit être un nombre positif.";
            return false;
        }

        return true;
    }

    /**
     * Valide une date
     */
    public function validateDate(?string $date, string $fieldName = 'date'): ?\DateTime
    {
        if (empty($date)) {
            return null; // Date optionnelle
        }

        try {
            $dateTime = new \DateTime($date);
            return $dateTime;
        } catch (\Exception $e) {
            $this->errors[$fieldName] = "La date n'est pas valide.";
            return null;
        }
    }

    /**
     * Valide un fichier uploadé
     */
    public function validateUploadedFile(array $file, array $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/avif', 'image/webp'], int $maxSize = 10485760): bool
    {
        if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            $this->errors['file'] = "Erreur lors de l'upload du fichier.";
            return false;
        }

        // Vérifier la taille
        if ($file['size'] > $maxSize) {
            $maxSizeMB = round($maxSize / 1024 / 1024, 2);
            $this->errors['file'] = "Le fichier ne peut pas dépasser {$maxSizeMB} MB.";
            return false;
        }

        // Vérifier le type MIME
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedTypes)) {
            $this->errors['file'] = "Type de fichier non autorisé. Types acceptés: " . implode(', ', $allowedTypes);
            return false;
        }

        // Vérifier que c'est vraiment une image
        $imageInfo = @getimagesize($file['tmp_name']);
        if ($imageInfo === false) {
            $this->errors['file'] = "Le fichier n'est pas une image valide.";
            return false;
        }

        return true;
    }

    /**
     * Retourne toutes les erreurs
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Retourne la première erreur
     */
    public function getFirstError(): ?string
    {
        return !empty($this->errors) ? reset($this->errors) : null;
    }

    /**
     * Vérifie s'il y a des erreurs
     */
    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    /**
     * Réinitialise les erreurs
     */
    public function reset(): void
    {
        $this->errors = [];
    }
}

 