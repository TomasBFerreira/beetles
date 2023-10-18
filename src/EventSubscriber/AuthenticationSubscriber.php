<?php

namespace App\EventSubscriber;

use App\Controller\DashboardController;
use App\Controller\LoginController;
use App\Controller\LogoutController;
use App\Repository\UserRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AuthenticationSubscriber implements EventSubscriberInterface
{
    public function __construct(private UserRepository $userRepository)
    {
    } 
    public static function getSubscribedEvents()
    {
        return[KernelEvents::REQUEST => 'onKernelRequest'];
    }
    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();
        $session = $request->getSession();
        $route = $request->attributes->get('_route');
        if($route !== DashboardController::NAME) {
            return;
        }

        if(!$session->has('user_id')){
            $response = new RedirectResponse(LoginController::PATH);
            $event->setResponse($response);
            return;
        }

        $id = $session->get('user_id');
        $user = $this->userRepository->find($id);
        if($user === null) 
        {
            $response = new RedirectResponse(LogoutController::PATH);
            $event->setResponse($response);
            return;
        }

        $request->attributes->set('user', $user);
    }

}
