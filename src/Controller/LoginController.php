<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class LoginController extends AbstractController
{
    private ?User $user = null;
    public function __construct(private UserRepository $repository)
    {
    }
    private function findUser(string $email): ?User
    {
        if ($this->user !== null){
            return $this->user;
        }
        $this->user = $this->repository->findOneBy(['email' => $email]);
        return $this->user;
    }
    #[Route('/login', name: 'login')]
    public function __invoke(Request $request): Response
    {
        $form = $this->createFormBuilder()->
            add('email', EmailType::class, ['constraints' => [new NotBlank(), new Email(), new Callback(function($email, ExecutionContextInterface $context)
                {$user = $this->findUser($email); if ($user === null) {$context->addViolation('Invalid user or password');return;}
                $data = $context->getRoot()->getData(); if (!password_verify($data['password'], $user->getPassword())){$context->addViolation('User or password not found');}})]])->
            add('password', PasswordType::class, ['constraints' =>[new NotBlank(), new Length(min:8, max:200)]])->
            add('submit', SubmitType::class)->
            getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()){
                $data = $form->getData();
                $email = $data['email'];
                $user = $this->findUser($email);
                $request->getSession()->set('user', $user->getId());
                return $this->redirectToRoute('dashboard');
            }
        return $this->render('login/login.html.twig', ['form' => $form->createView()]);
    }
}
