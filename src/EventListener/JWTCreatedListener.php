<?php


namespace App\EventListener;

use App\Service\UserInformation;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\User\UserInterface;

class JWTCreatedListener
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    private $userInformation;

    /**
     * @param RequestStack $requestStack
     * @param UserInformation $userInformation
     */
    public function __construct(RequestStack $requestStack, UserInformation $userInformation)
    {
        $this->requestStack = $requestStack;
        $this->userInformation = $userInformation;
    }

    /**
     * @param JWTCreatedEvent $event
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        $payload = $event->getData();
        $user = $event->getUser();

        if (!$user instanceof UserInterface){
            return;
        }

        foreach ($this->userInformation->getInfo($user) as $key => $info) {
            $payload[$key] = $info;
        }

        $event->setData($payload);

    }
}