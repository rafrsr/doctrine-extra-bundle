<?php

/**
 * LICENSE: This file is subject to the terms and conditions defined in
 * file 'LICENSE', which is part of this source code package.
 *
 * @copyright 2016 Copyright(c) - All rights reserved.
 */

namespace Rafrsr\DoctrineExtraBundle\Model;

/**
 * ProxyServiceTrait
 */
trait ProxyServiceTrait
{
    /**
     * Its not a column and can not be persisted
     * is used to inject the service instance in a cycle event
     *
     * @var object
     */
    protected $service;

    /**
     * Service name
     *
     * @var string
     * @ORM\Column(name="service", type="string")
     */
    protected $serviceName;

    /**
     * @return object
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param object $service
     *
     * @return $this
     */
    public function setService($service)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * @return string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * @param string $serviceName
     *
     * @return $this
     */
    public function setServiceName($serviceName)
    {
        $this->serviceName = $serviceName;

        return $this;
    }
}