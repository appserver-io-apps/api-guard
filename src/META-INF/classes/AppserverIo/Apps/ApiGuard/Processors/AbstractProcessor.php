<?php

/**
 * AppserverIo\Apps\ApiGuard\Processors\AbstractProcessor
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * PHP version 5
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io-apps/api-guard
 * @link      http://www.appserver.io
 */

namespace AppserverIo\Apps\ApiGuard\Processors;

use AppserverIo\Apps\ApiGuard\Interfaces\ConnectorInterface;
use AppserverIo\Apps\ApiGuard\Interfaces\EntityInterface;
use AppserverIo\Apps\ApiGuard\Interfaces\ProcessorInterface;

/**
 * A singleton session bean implementation that handles the
 * data by using Doctrine ORM.
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io-apps/api-guard
 * @link      http://www.appserver.io
 *
 * @Invariant("$this->isConsistent()")
 */
abstract class AbstractProcessor extends \Stackable implements ProcessorInterface
{

    /**
     * Container to store all instances in
     *
     * @var array $container
     */
    protected $container;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->container = new \Stackable();
    }

    /**
     * Will create the instance within our instance store
     *
     * @param \AppserverIo\Apps\ApiGuard\Interfaces\EntityInterface $instance The instance to create
     *
     * @return null
     */
    public function create(EntityInterface $instance)
    {
        if (!isset($this->container[$instance->getId()])) {
            $this->container[$instance->getId()] = $instance;
        }
    }

    /**
     * Will get the instance from our instance store
     *
     * @param string $id The id of the instance to get
     *
     * @return \AppserverIo\Apps\ApiGuard\Interfaces\EntityInterface
     */
    public function get($id)
    {
        if (isset($this->container[$id])) {
            return $this->container[$id];
        }
    }

    /**
     * Will update the instance within our instance store
     *
     * @param \AppserverIo\Apps\ApiGuard\Interfaces\EntityInterface $instance The instance to create
     *
     * @return null
     */
    public function update(EntityInterface $instance)
    {
        $this->container[$instance->getId()] = $instance;
    }

    /**
     * Will delete the instance from our instance store
     *
     * @param string $id The id of the instance to get
     *
     * @return null
     */
    public function delete($id)
    {
        if (isset($this->container[$id])) {
            unset($this->container[$id]);
        }
    }
}
