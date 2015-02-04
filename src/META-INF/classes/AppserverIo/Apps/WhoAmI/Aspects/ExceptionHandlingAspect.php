<?php

/**
 * \AppserverIo\Apps\WhoAmI\Aspects\ExceptionHandlingAspect
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

namespace AppserverIo\Apps\WhoAmI\Aspects;

use AppserverIo\Doppelgaenger\Interfaces\MethodInvocationInterface;
use AppserverIo\Doppelgaenger\Interfaces\ExceptionInterface;

/**
 * <TODO CLASS DESCRIPTION>
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH - <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io/whoami
 * @link      http://www.appserver.io/
 *
 * @Stateless
 *
 * @Aspect
 */
class ExceptionHandlingAspect
{

    /**
     * Pointcut specifying all actions within any action class we have
     *
     * @return null
     *
     * @Pointcut("call(\AppserverIo\Apps\WhoAmI\Actions\*->*Action())")
     */
    public function allActionMethods()
    {
    }

    /**
     * Advice used to proceed a method but always replace the result with true
     *
     * @param \AppserverIo\Doppelgaenger\Interfaces\MethodInvocationInterface $methodInvocation Initially invoked method
     *
     * @return null
     *
     * @Around("pointcut(allActionMethods())")
     */
    public function dbcExceptionToError(MethodInvocationInterface $methodInvocation)
    {
        try {
            $methodInvocation->proceed();

        } catch (ExceptionInterface $e) {

            // build up the right format for our response message
            $messageObject = new \stdClass();
            $messageObject->type = 'error';
            $messageObject->message = 'Houston, we have a problem with our contracts';
            $message = $methodInvocation->getContext()->connector->stringFromObject($messageObject);

            // get the servlet response and set the error message
            $parameters = $methodInvocation->getParameters();
            $servletResponse = $parameters['servletResponse'];
            $servletResponse->appendBodyStream($message);
        }
    }
}
