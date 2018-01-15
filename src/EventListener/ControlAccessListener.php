<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ControlAccessListener
{
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * @param FilterControllerEvent $event
     *
     * @throws AccessDeniedException
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $request = $event->getRequest();
        $controller = $request->attributes->get('_controller');

        if ($controller != 'api_platform.action.get_subresource') {
            return;
        }

        $id = $request->attributes->get('id');

        if (!$this->authorizationChecker->isGranted('view', $id)) {
            throw new AccessDeniedException('Unauthorized operation: ' . $controller);
        }
    }
}
