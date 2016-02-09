<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\DoctrineExtraBundle\DBAL\Types;

use Rafrsr\Crypto\Crypto;

/**
 * Class Encryptor
 */
class Encryptor
{

    /**
     * @var Crypto
     */
    protected static $encryptor;

    /**
     * @return Crypto
     */
    public static function get()
    {
        return self::$encryptor;
    }

    /**
     * @param Crypto $encryptor
     *
     * @return $this
     */
    public static function set(Crypto $encryptor)
    {
        self::$encryptor = $encryptor;
    }
}