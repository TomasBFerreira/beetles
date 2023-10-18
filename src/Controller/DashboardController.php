<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{    
    public const PATH = '/dashboard';
    public const NAME = 'dashboaard';
    #[Route(self::PATH, self::NAME)]
    public function __invoke( Request $request): Response
    {
        $user = $request->attributes->get('user');
        return $this->render('dashboard/index.html.twig', [
            'user' => $user
        ]);   
    }
}