<?php 

namespace App\Controller;

use App\Entity\Relationship;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class FamilyTreeController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    #[Route('/dashboard/family-tree', name: 'family_tree')]
    public function __invoke(): Response
    {
        $relationships = $this->doctrine
            ->getRepository(Relationship::class)
            ->findAll();    
        return $this->render('dashboard/family_tree.html.twig', [
            'relationships' => $relationships,
        ]);
    }
}