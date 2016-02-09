<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\DoctrineExtraBundle\EventListener\ORM;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Rafrsr\DoctrineExtraBundle\Model\ProxyServiceInterface;

/**
 * Class ProxyServiceSubscriber
 */
class ProxyServiceSubscriber implements EventSubscriber, ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @inheritDoc
     */
    public function getSubscribedEvents()
    {
        return [
            Events::postLoad => 'postLoad',
        ];
    }

    /**
     * @param LifecycleEventArgs $event The event.
     */
    public function postLoad(LifecycleEventArgs $event)
    {
        $object = $event->getObject();
        if ($object instanceof ProxyServiceInterface && $object->getServiceName()) {
            $object->setService($this->container->get($object->getServiceName()));
        }
    }
}