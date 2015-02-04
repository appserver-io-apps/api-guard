<?php

/**
 * \AppserverIo\Apps\WhoAmI\Actions\UsersAction
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
 * @link      https://github.com/appserver-io-apps/whoami
 * @link      http://www.appserver.io/
 */

namespace AppserverIo\Apps\WhoAmI\Actions;

/**
 * <TODO CLASS DESCRIPTION>
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH - <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io-apps/whoami
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
    const TARGET_ENTITY = '\AppserverIo\Apps\WhoAmI\Entities\User';
}
