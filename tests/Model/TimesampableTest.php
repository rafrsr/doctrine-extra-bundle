<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\DoctrineExtraBundle\Tests;

use Rafrsr\DoctrineExtraBundle\Tests\Fixtures\Post;

/**
 * Class TimesampableTest
 */
class TimesampableTest extends \PHPUnit_Framework_TestCase
{

    public function testInterface()
    {
        $post = new Post();
        $yesterday = new \DateTime('yesterday');
        $now = new \DateTime();
        $post->setCreatedAt($yesterday);
        $post->setUpdatedAt($now);

        $this->assertEquals($yesterday, $post->getCreatedAt());
        $this->assertEquals($now, $post->getUpdatedAt());
    }
}

