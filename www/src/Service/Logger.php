<?php

/**
 * ============================================
 * LOGGER SERVICE
 * ============================================
 * 
 * CONCEPT PÉDAGOGIQUE : Logging structuré
 * 
 * Ce service permet d'enregistrer des logs structurés pour :
 * - Le débogage (trouver les erreurs)
 * - La traçabilité (savoir qui a fait quoi)
 * - La sécurité (détecter les tentatives d'attaque)
 * 
 * NIVEAUX DE LOG :
 * - INFO : Actions normales (connexion, création, etc.)
 * - WARNING : Avertissements (tentatives échouées, validations échouées)
 * - ERROR : Erreurs (exceptions, problèmes techniques)
 * 
 * FORMAT DES LOGS :
 * [2024-01-15 10:30:45] [INFO] Message {"context": "data"}
 * 
 * CONCEPT : Rotation des logs
 * Quand le fichier de log dépasse 10 MB, il est renommé avec la date/heure
 * Cela évite que les logs deviennent trop volumineux.
 */

namespace App\Service;

/**
 * Service de logging structuré
 * 
 * CONCEPT : Classe statique
 * Toutes les méthodes sont statiques pour faciliter l'utilisation
 * Logger::info('Message') au lieu de (new Logger())->info('Message')
 */
class Logger
{
    // ============================================
    // CONSTANTES DE CONFIGURATION
    // ============================================
    private const LOG_DIR = __DIR__ . '/../../storage/logs/';  // Dossier des logs
    private const LOG_FILE = 'app.log';                        // Nom du fichier de log
    private const MAX_LOG_SIZE = 10 * 1024 * 1024;            // 10 MB (taille max avant rotation)

    /**
     * Log un message avec un niveau
     * 
     * CONCEPT PÉDAGOGIQUE : Méthode générique de logging
     * 
     * Cette méthode est utilisée par toutes les méthodes spécialisées
     * (info, warning, error, exception)
     * 
     * FORMAT DU LOG :
     * [TIMESTAMP] [LEVEL] MESSAGE {"context": "data"}
     * 
     * @param string $level Niveau du log (INFO, WARNING, ERROR)
     * @param string $message Message à logger
     * @param array $context Contexte additionnel (données structurées)
     */
    public static function log(string $level, string $message, array $context = []): void
    {
        $logFile = self::LOG_DIR . self::LOG_FILE;
        
        // Créer le dossier s'il n'existe pas
        // CONCEPT : Création automatique des dossiers nécessaires
        if (!is_dir(self::LOG_DIR)) {
            @mkdir(self::LOG_DIR, 0755, true);
        }

        // Rotation des logs si nécessaire
        // CONCEPT : Gestion de l'espace disque
        // Si le fichier dépasse 10 MB, le renommer avec la date/heure
        if (file_exists($logFile) && filesize($logFile) > self::MAX_LOG_SIZE) {
            self::rotateLogs();
        }

        // Formater le message de log
        // CONCEPT : Format structuré avec timestamp et contexte JSON
        $timestamp = date('Y-m-d H:i:s');
        $contextStr = !empty($context) ? ' ' . json_encode($context) : '';
        $logMessage = "[{$timestamp}] [{$level}] {$message}{$contextStr}" . PHP_EOL;

        // Écrire dans le fichier de log
        // CONCEPT : FILE_APPEND = ajouter à la fin du fichier
        // LOCK_EX = verrouiller le fichier pendant l'écriture (évite les conflits)
        @file_put_contents($logFile, $logMessage, FILE_APPEND | LOCK_EX);
    }

    /**
     * Log un message d'information
     */
    public static function info(string $message, array $context = []): void
    {
        self::log('INFO', $message, $context);
    }

    /**
     * Log un avertissement
     */
    public static function warning(string $message, array $context = []): void
    {
        self::log('WARNING', $message, $context);
    }

    /**
     * Log une erreur
     */
    public static function error(string $message, array $context = []): void
    {
        self::log('ERROR', $message, $context);
    }

    /**
     * Log une exception
     */
    public static function exception(\Throwable $e, array $context = []): void
    {
        $context['exception'] = [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ];
        self::error('Exception: ' . $e->getMessage(), $context);
    }

    /**
     * Rotation des logs
     */
    private static function rotateLogs(): void
    {
        $logFile = self::LOG_DIR . self::LOG_FILE;
        $backupFile = self::LOG_DIR . self::LOG_FILE . '.' . date('Y-m-d_His');
        
        if (file_exists($logFile)) {
            @rename($logFile, $backupFile);
        }
    }
}

