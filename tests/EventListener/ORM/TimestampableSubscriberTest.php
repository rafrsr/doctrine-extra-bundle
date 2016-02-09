<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\DoctrineExtraBundle\Tests\EventListener\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use Rafrsr\DoctrineExtraBundle\EventListener\ORM\TimestampableSubscriber;
use Rafrsr\DoctrineExtraBundle\Tests\Fixtures\Post;

class TimestampableSubscriberTest extends \PHPUnit_Framework_TestCase
{

    public function testInterface()
    {
        $subscriber = new TimestampableSubscriber();
        $this->assertInstanceOf('Doctrine\Common\EventSubscriber', $subscriber);
    }

    public function testSubscribedEvents()
    {
        $subscriber = new TimestampableSubscriber();
        $events = [
            Events::prePersist => 'prePersist',
            Events::preUpdate => 'preUpdate'
        ];
        $this->assertEquals($events, $subscriber->getSubscribedEvents());
    }

    public function testPrePersist()
    {
        $subscriber = new TimestampableSubscriber();
        $post = new Post();
        /** @var ObjectManager $manager */
        $manager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $event = new LifecycleEventArgs($post, $manager);
        $subscriber->prePersist($event);

        $now = new \DateTime();
        $this->assertEquals($post->getCreatedAt()->format('c'), $now->format('c'));
        $this->assertEquals($post->getUpdatedAt()->format('c'), $now->format('c'));
    }

    public function testPreUpdate()
    {
        $subscriber = new TimestampableSubscriber();
        $post = new Post();
        /** @var ObjectManager $manager */
        $manager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $event = new LifecycleEventArgs($post, $manager);
        $subscriber->preUpdate($event);

        $now = new \DateTime();
        $this->assertNull($post->getCreatedAt());
        $this->assertEquals($post->getUpdatedAt()->format('c'), $now->format('c'));
    }
}
