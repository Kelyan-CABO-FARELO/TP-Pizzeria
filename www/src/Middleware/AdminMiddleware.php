<?php

namespace App\Middleware;

use JulienLinard\Auth\Middleware\RoleMiddleware;

/**
 * Middleware spécifique pour sécuriser l'accès ADMIN
 */
class AdminMiddleware extends RoleMiddleware
{
    public function __construct()
    {
        parent::__construct('ADMIN', '/');
    }
}