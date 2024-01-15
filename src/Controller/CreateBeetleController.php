<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Beetle;
use App\Form\BeetleType;
use Doctrine\Persistence\ManagerRegistry;

class CreateBeetleController extends AbstractController
{
    /*
    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    #[Route('/dashboard/create-beetle', name: 'create_beetle')]
    public function __invoke(Request $request): Response
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
    */
}