<?php

/**
 * \AppserverIo\Apps\WhoAmI\Interfaces\ConnectorInterface
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
 * @copyright 2015 TechDivision GmbH - <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/whoami
 * @link      http://www.appserver.io/
 */

namespace AppserverIo\Apps\WhoAmI\Interfaces;

/**
 * <TODO CLASS DESCRIPTION>
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH - <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/whoami
 * @link      http://www.appserver.io/
 */
interface ConnectorInterface
{

    /**
     * @param $rawData
     * @param $targetEntity
     * @return mixed
     *
     * @requires is_object(json_decode($rawData))
     * @requires class_exists($targetEntity)
     *
     * @ensures $dgResult instanceof $targetEntity
     */
    public function instanceFromString($rawData, $targetEntity);

    /**
     * @param $rawData
     * @return mixed
     */
    public function identifierFromString($rawData);

    /**
     * @param object $object
     */
    public function stringFromObject($object);
}

