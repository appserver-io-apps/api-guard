<?php

/**
 * \AppserverIo\Apps\ApiGuard\Connectors\JsonConnector
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
 * @link      http://www.appserver.io/
 */

namespace AppserverIo\Apps\ApiGuard\Connectors;

use AppserverIo\Apps\ApiGuard\Interfaces\ConnectorInterface;

/**
 * Connector used to
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io-apps/api-guard
 * @link      http://www.appserver.io/
 *
 * @Stateless
 */
class JsonConnector implements ConnectorInterface
{

    /**
     * The protocol this connector handles
     *
     * @var string PROTOCOL
     */
    const PROTOCOL = 'JSON';

    /**
     * Getter for the connectors protocol
     *
     * @return string
     */
    public function getProtocol()
    {
        return self::PROTOCOL;
    }

    /**
     * Will create an instance of the $targetEntity class based on the data given as raw string
     *
     * @param string $rawData      Data string to generate the instance from
     * @param string $targetEntity The fully qualified class name to create an instance from
     *
     * @return object
     *
     * @Requires("is_object(json_decode($rawData))")
     * @Requires("class_exists($targetEntity)")
     *
     * @Ensures("$dgResult instanceof $targetEntity")
     */
    public function instanceFromString($rawData, $targetEntity)
    {
        $object = json_decode($rawData);

        $resultInstance = new $targetEntity();
        foreach (get_object_vars($object) as $property => $value) {
            $method = 'set' . ucfirst($property);
            if (method_exists($resultInstance, $method)) {
                $resultInstance->$method($value);
            }
        }

        // try to mark the instance as consistent
        $resultInstance->markConsistent();

        return $resultInstance;
    }

    /**
     * Will return an identifier used to uniquely identify the instance
     *
     * @param string $rawData Data string to generate the identifier for
     *
     * @return string
     */
    public function identifierFromString($rawData)
    {

    }

    /**
     * Will create a string from an object .
     * This string is readily formatted for transmitting using the connectors protocol
     *
     * @param \stdClass $object The object to transform into a formatted string
     *
     * @return string
     */
    public function stringFromObject($object)
    {
        return json_encode($object);
    }
}
