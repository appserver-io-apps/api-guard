<?php

/**
 * \AppserverIo\Apps\ApiGuard\Entities\EntityInterface
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
 * Interface common to all entities
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io-apps/api-guard
 * @link      http://www.appserver.io/
 */
interface EntityInterface
{

    /**
     * Returns the value of the class member userId.
     *
     * @return string Holds the value of the class member userId
     */
    public function getId();

    /**
     * Sets the value for the class member userId.
     *
     * @param string $id Holds the value for the class member userId
     *
     * @return void
     */
    public function setId($id);

    /**
     * Method used to validate the consistency of the object.
     * We use DbC to do so
     *
     * @return null
     */
    public function markConsistent();

    /**
     * Whether or not the entity is consistent
     *
     * @return boolean
     */
    public function isConsistent();
}
