<?php

/**
 * \AppserverIo\Apps\ApiGuard\Aspects\ExceptionHandlingAspect
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

namespace AppserverIo\Apps\ApiGuard\Aspects;

use AppserverIo\Psr\MetaobjectProtocol\Aop\MethodInvocationInterface;
use AppserverIo\Psr\MetaobjectProtocol\Dbc\ContractExceptionInterface;

/**
 * Aspect which is used to catch webservice DbC errors and respond to the client automatically
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io-apps/api-guard
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
     * @Pointcut("call(\AppserverIo\Apps\ApiGuard\Actions\*->*Action())")
     */
    public function allActionMethods()
    {
    }

    /**
     * Advice used to proceed a method but catch all Design by Contract related exceptions.
     * Will react on any caught exception with an error response to the client
     *
     * @param \AppserverIo\Psr\MetaobjectProtocol\Aop\MethodInvocationInterface $methodInvocation Initially invoked method
     *
     * @return mixed
     *
     * @Around("pointcut(allActionMethods())")
     */
    public function actionExceptionToError(MethodInvocationInterface $methodInvocation)
    {
        try {
            return $methodInvocation->proceed();

        } catch (ContractExceptionInterface $e) {
            // build up the right format for our response message
            $messageObject = new \stdClass();
            $messageObject->type = 'error';
            $messageObject->code = 400;
            $messageObject->message = 'Invalid request data';
            $message = $methodInvocation->getContext()->getConnector()->stringFromObject($messageObject);

            // get the servlet response and set the error message
            $parameters = $methodInvocation->getParameters();
            $servletResponse = $parameters['servletResponse'];
            $servletResponse->appendBodyStream($message);
            $servletResponse->setStatusCode($messageObject->code);
        }
    }
}
