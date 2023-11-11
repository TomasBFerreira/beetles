<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BeetleRepository;
use Doctrine\Persistence\ManagerRegistry;

class FamilyTreeController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    #[Route('/dashboard/family-tree', name: 'family_tree')]
    public function __invoke(BeetleRepository $beetleRepository): Response
    {
        $familyTrees = $beetleRepository->findFamilyTrees();

        return $this->render('dashboard/family_tree.html.twig', [
            'familyTrees' => $familyTrees,
                ]);
    }
}