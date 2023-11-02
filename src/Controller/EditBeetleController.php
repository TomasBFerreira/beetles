<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Beetle;
use App\Form\BeetleType;
use Doctrine\Persistence\ManagerRegistry;

class EditBeetleController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    #[Route('/dashboard/edit-beetle/{id}', name: 'edit_beetle')]
    public function __invoke(Request $request, int $id): Response
    {
        $entityManager = $this->doctrine->getManager();
        $beetle = $entityManager->getRepository(Beetle::class)->find($id);

        if (!$beetle) {
            // Handle not found case, e.g., redirect to an error page
        }

        $form = $this->createForm(BeetleType::class, $beetle);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('list_beetles');
        }

        return $this->render('dashboard/edit_beetle.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}