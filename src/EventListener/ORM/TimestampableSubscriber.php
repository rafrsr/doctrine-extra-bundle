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
use Rafrsr\DoctrineExtraBundle\Model\TimestampableInterface;

/**
 * Class TimestampableSubscriber
 */
class TimestampableSubscriber implements EventSubscriber
{
    /**
     * @inheritDoc
     */
    public function getSubscribedEvents()
    {
        return [
            Events::prePersist => 'prePersist',
            Events::preUpdate => 'preUpdate',
        ];
    }

    /**
     * @param LifecycleEventArgs $event The event.
     */
    public function prePersist(LifecycleEventArgs $event)
    {
        $object = $event->getObject();
        if ($object instanceof TimestampableInterface) {
            $object->setCreatedAt(new \DateTime());
            $object->setUpdatedAt(new \DateTime());
        }
    }

    /**
     * @param LifecycleEventArgs $event The event.
     */
    public function preUpdate(LifecycleEventArgs $event)
    {
        $object = $event->getObject();
        if ($object instanceof TimestampableInterface) {
            $object->setUpdatedAt(new \DateTime());
        }
    }
}