<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\DoctrineExtraBundle;

use Rafrsr\Crypto\Crypto;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\Kernel;
use Rafrsr\DoctrineExtraBundle\DBAL\Types\Encryptor;

/**
 * Class RafrsrDoctrineExtraBundle
 */
class RafrsrDoctrineExtraBundle extends Bundle
{
    /**
     * @var Kernel
     */
    protected static $kernel;

    public function __construct(Kernel $kernel)
    {
        self::$kernel = $kernel;
    }

    /**
     * @return Kernel
     */
    public static function getKernel()
    {
        return self::$kernel;
    }

    /**
     * Boots the Bundle.
     */
    public function boot()
    {
        $encryptor = $this->container->getParameter('rafrsr.doctrine.encryptor');
        $secret = $this->container->getParameter('rafrsr.doctrine.secret');

        Encryptor::set(Crypto::build($secret, $encryptor));
    }
}