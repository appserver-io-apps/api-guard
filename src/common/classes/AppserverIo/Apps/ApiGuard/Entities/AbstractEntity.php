<?php

/**
 * \AppserverIo\Apps\ApiGuard\Entities\AbstractEntity
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
 * @link      https://github.com/appserver-io/api-guard
 * @link      http://www.appserver.io/
 */

namespace AppserverIo\Apps\ApiGuard\Entities;

use AppserverIo\Apps\ApiGuard\Interfaces\EntityInterface;

/**
 * Abstract entity class handling serialization and the consistency state
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH - <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/api-guard
 * @link      http://www.appserver.io/
 */
abstract class AbstractEntity implements EntityInterface
{
    /**
     * Marks the entity as consistent if set TRUE
     *
     * @var boolean $isConsistent
     */
    protected $isConsistent;

    /**
     * Default constructor
     */
    public function __construct()
    {
        $this->isConsistent = false;
    }

    /**
     * Whether or not the entity is consistent
     *
     * @return boolean
     */
    public function isConsistent()
    {
        return $this->isConsistent;
    }

    /**
     * Will return a JSON serializable array
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $objectArray = array();
        foreach (get_object_vars($this) as $property => $value) {
            // collect all properties in an array, expect for consistency state, we do not need those being public
            if ($property === 'isConsistent') {
                continue;
            }

            $objectArray[$property] = $value;
        }

        $entityName = strtolower(ltrim(strrchr(get_class($this), '\\'), '\\'));
        return array($entityName => $objectArray);
    }
}
