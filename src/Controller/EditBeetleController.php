<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Beetle;
use App\Form\BeetleType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class EditBeetleController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine, private SluggerInterface $slugger)
    {
    }

    #[Route('/dashboard/edit-beetle/{id}', name: 'edit_beetle')]
    public function __invoke(Request $request, int $id): Response
    {
        $entityManager = $this->doctrine->getManager();
        $beetle = $entityManager->getRepository(Beetle::class)->find($id);

        if (!$beetle) {
            // Handle not found case, e.g., redirect to an error page
        }// Handle not found case, e.g., redirect to an error page

        $form = $this->createForm(BeetleType::class, $beetle);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $pictureFile */
            $pictureFile = $form->get('picture')->getData();

            if ($pictureFile) {
                $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $this->slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pictureFile->guessExtension();

                try {
                    $pictureFile->move(
                        $this->getParameter('kernel.project_dir').'/public/uploads/pictures',
                        $newFilename
                    );
                } catch (FileException $e) {
                    $this->addFlash('error', 'Failed to upload file');
                }
                $beetle->setPictureFilename($newFilename);
            }
            $entityManager->flush();

            return $this->redirectToRoute('list_beetles');
        }

        return $this->render('dashboard/edit_beetle.html.twig', [
            'form' => $form->createView(),
            'beetle' => $beetle, 
        ]);
    }
}