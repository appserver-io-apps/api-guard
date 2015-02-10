<?php

/**
 * \AppserverIo\Apps\ApiGuard\Actions\UsersAction
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

namespace AppserverIo\Apps\ApiGuard\Actions;

/**
 * Action specifying user specific configuration to use abstract CRUD functionality
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io-apps/api-guard
 * @link      http://www.appserver.io/
 */
class UsersAction extends AbstractCrudAction
{

    /**
     * The proxy processor class
     *
     * @var string PROCESSING_PROXY
     */
    const PROCESSING_PROXY = 'UserProcessor';

    /**
     * The target entity to pass to the processor
     *
     * @var string TARGET_ENTITY
     */
    const TARGET_ENTITY = '\AppserverIo\Apps\ApiGuard\Entities\User';
}
