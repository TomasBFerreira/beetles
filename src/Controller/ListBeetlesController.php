<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Beetle;
use Doctrine\Persistence\ManagerRegistry;

class ListBeetlesController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    #[Route('/dashboard/list-beetles', name: 'list_beetles')]
    public function __invoke(Request $request): Response
    {
        $beetles = $this->doctrine->getRepository(Beetle::class)->findAll();

        return $this->render('dashboard/list_beetles.html.twig', [
            'beetles' => $beetles,
        ]);
    }
}