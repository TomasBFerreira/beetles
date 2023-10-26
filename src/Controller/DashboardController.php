<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Beetle;
use App\Form\BeetleType; 
use Doctrine\Persistence\ManagerRegistry;

class DashboardController extends AbstractController
{    
    public const PATH = '/dashboard';
    public const NAME = 'dashboard';
    public function __construct(private ManagerRegistry $doctrine)
    {

    }
    #[Route(self::PATH, self::NAME)]
    public function __invoke( Request $request): Response
    {
        $user = $request->attributes->get('user');
        return $this->render('dashboard/index.html.twig', [
            'user' => $user
        ]);   
    }

    public function listBeetles(): Response
{
    $beetles = $this->doctrine->getRepository(Beetle::class)->findAll();

    return $this->render('dashboard/list_beetles.html.twig', [
        'beetles' => $beetles,
    ]);
}

public function createBeetle(Request $request): Response
{
    $beetle = new Beetle();
    $form = $this->createForm(BeetleType::class, $beetle);

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->doctrine->getManager();
        $entityManager->persist($beetle);
        $entityManager->flush();

        return $this->redirectToRoute('list_beetles');
    }

    return $this->render('dashboard/create_beetle.html.twig', [
        'form' => $form->createView(),
    ]);
}
}