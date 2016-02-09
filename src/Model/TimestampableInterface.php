<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\DoctrineExtraBundle\Model;

/**
 * Use this interface in all entities that you need to automatically
 * set a timestamp on creation or update
 */
interface TimestampableInterface
{
    /**
     * Get creation time.
     *
     * @return \DateTime
     */
    public function getCreatedAt();

    /**
     * Get the time of last update.
     *
     * @return \DateTime
     */
    public function getUpdatedAt();

    /**
     * Set creation time.
     *
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt);

    /**
     * Set the time of last update.
     *
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt(\DateTime $updatedAt);
}