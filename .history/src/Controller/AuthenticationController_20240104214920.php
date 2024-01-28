<?php
// src/Controller/AuthenticationController.php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthenticationController
{
    /**
     * @Route("/api/login_check", name="api_login_check", methods={"POST"})
     */
    public function login(): Response
    {
        // La logique d'authentification est gérée par le bundle JWT, cette méthode ne sera pas exécutée.
        throw new \Exception('This method should not be called. This is handled by the "lexik_jwt_authentication" firewall.');
    }
}
