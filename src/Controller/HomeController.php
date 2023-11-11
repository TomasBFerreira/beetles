<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public const PATH = '/home';
    public const NAME = 'home';
    #[Route(self::PATH, self::NAME)]
    public function __invoke( Request $request): Response
    {
        $user = $request->attributes->get('user');
        return $this->render('home/index.html.twig', [
            'user' => $user
        ]);
    }
}
