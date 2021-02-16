<?php

namespace App\EventSubscriber;

use App\Entity\Company;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\EventSubscriber;

class AppSubscriber implements EventSubscriber
{
    public function onOnPersist($event)
    {
        // ...
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            //Events::preUpdate,
        ];
    }

    // callback methods must be called exactly like the events they listen to;
    // they receive an argument of type LifecycleEventArgs, which gives you access
    // to both the entity object of the event and the entity manager itself
    public function prePersist(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof Company) {
            return;
        }

        if($entity->getId()){
            dump('Aqui puedes hacer algunas cosas');
        }else{
            dump('Aqui puedes hacer otras cosas');
        }
    }

}
