<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LogoutController extends AbstractController
{
    public const PATH = '/logout';
    public const NAME = 'logout';
    #[Route(self::PATH, self::NAME)]
    public function logout(Request $request): Response
    {
        $session = $request->getSession();

        $session->clear();

        return $this->redirectToRoute(LoginController::NAME); 
    }
}