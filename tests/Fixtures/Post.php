<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\DoctrineExtraBundle\Tests\Fixtures;

use Rafrsr\DoctrineExtraBundle\Model\TimestampableInterface;
use Rafrsr\DoctrineExtraBundle\Model\TimestampableTrait;

/**
 * Class Post
 */
class Post implements TimestampableInterface
{
    use TimestampableTrait;
}