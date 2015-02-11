<?php

/**
 * AppserverIo\Apps\ApiGuard\Processors\UserProcessor
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

use AppserverIo\Apps\ApiGuard\Entities\User;

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
 * @Singleton
 * @Startup
 */
class UserProcessor extends AbstractProcessor
{

    /**
     * Checks if the processor only stores instances of the User entity
     *
     * @return boolean
     */
    public function isConsistent()
    {
        foreach ($this->container as $user) {
            if (!$user instanceof User) {
                return false;
            }
        }

        return true;
    }
}
