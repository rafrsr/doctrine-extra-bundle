<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\DoctrineExtraBundle\DBAL\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;

/**
 * EncryptedTrait
 */
trait EncryptedTrait
{

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value !== null) {
            $value = Encryptor::get()->decrypt($value);
        }

        return parent::convertToPHPValue($value, $platform);
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value !== null) {
            $value = parent::convertToDatabaseValue($value, $platform);
        }

        return Encryptor::get()->encrypt($value);
    }

    /**
     * {@inheritdoc}
     */
    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }
}
