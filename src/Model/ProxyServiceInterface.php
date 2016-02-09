<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\DoctrineExtraBundle\Model;

/**
 * ProxyServiceInterface
 */
interface ProxyServiceInterface
{

    /**
     * Get instance of related service
     *
     * @return object instance of related service
     */
    public function getService();

    /**
     * Set instance of service
     *
     * @param object $service
     *
     * @return $this
     */
    public function setService($service);

    /**
     * Get instance of related service
     *
     * @return object instance of related service
     */
    public function getServiceName();

    /**
     * Set the service name
     *
     * @param string $serviceName
     *
     * @return $this
     */
    public function setServiceName($serviceName);
}