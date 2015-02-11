<?php

/**
 * \AppserverIo\Apps\ApiGuard\Interfaces\ConnectorInterface
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

namespace AppserverIo\Apps\ApiGuard\Interfaces;

/**
 * Common interface for connectors used to connect a webservice using different protocols
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io-apps/api-guard
 * @link      http://www.appserver.io/
 */
interface ConnectorInterface
{

    /**
     * Getter for the connectors protocol
     *
     * @return string
     */
    public function getProtocol();

    /**
     * Will create an instance of the $targetEntity class based on the data given as raw string
     *
     * @param string $rawData      Data string to generate the instance from
     * @param string $targetEntity The fully qualified class name to create an instance from
     *
     * @return object
     */
    public function instanceFromString($rawData, $targetEntity);

    /**
     * Will return an identifier used to uniquely identify the instance
     *
     * @param string $rawData Data string to generate the identifier for
     *
     * @return string
     */
    public function identifierFromString($rawData);

    /**
     * Will create a string from an object .
     * This string is readily formatted for transmitting using the connectors protocol
     *
     * @param object $object The object to transform into a formatted string
     *
     * @return string
     */
    public function stringFromObject($object);
}
