<?php 

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BeetleRepository;
use App\Entity\Beetle;

class FamilyTreeController extends AbstractController
{
    public function __construct(private BeetleRepository $repository)
    {
    }

    #[Route('/api/familytree', name: 'api_familytree', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        $beetles = $this->repository->findAll();

        $data = [];
        foreach ($beetles as $beetle) {
            $data[] = [
                'id' => $beetle->getId(),
                'name' => $beetle->getName(),
                'lineage' => $beetle->getLineage(),
                'gen' => $beetle->getGen(),
                'sex' => $beetle->getSex(),
                'date' => $beetle->getDate()->format('Y-m-d'),
                'length' => $beetle->getLength(),
                'pictureFilename' => $beetle->getPictureFilename(),
                'relationship' => $beetle->getRelationship() ? $beetle->getRelationship()->getId() : null,
            ];
        }

        return new JsonResponse($data);
    }

    #[Route('/api/familytree/search/{name}', name: 'api_familytree_search', methods: ['GET'])]
public function search(string $name): JsonResponse
{
    $beetles = $this->repository->findByName($name);

    $data = [];
    foreach ($beetles as $beetle) {
        $data[] = [
            'id' => $beetle->getId(),
            'name' => $beetle->getName(),
        ];
    }

    return new JsonResponse($data);
}
}
?>