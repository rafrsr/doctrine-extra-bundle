<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\DoctrineExtraBundle\DBAL\Types;

use Doctrine\DBAL\Types\TextType;

/**
 * Encrypted Type
 */
class EncryptedType extends TextType
{
    use EncryptedTrait;

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'encrypted';
    }
}