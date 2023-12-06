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
        $hierarchicalFamilyTree = $this->buildHierarchicalFamilyTree($familyTrees);

        
        return $this->render('dashboard/family_tree.html.twig', [
            'familyTrees' => $familyTrees,
                ]);
    }

    private function buildHierarchicalFamilyTree(array $familyTrees): array
{
    $hierarchicalTree = [];

    foreach ($familyTrees as $beetle) {
        $lineage = $beetle->getLineage();

        if (!isset($hierarchicalTree[$lineage])) {
            $hierarchicalTree[$lineage] = [];
        }

        $hierarchicalTree[$lineage][$beetle->getId()] = [
            'beetle' => $beetle,
            'children' => $this->buildHierarchicalFamilyTree($beetle->getChild()->toArray()),
        ];
    }

    return $hierarchicalTree;
}
}