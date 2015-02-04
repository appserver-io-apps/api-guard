<?php

/**
 * \AppserverIo\Apps\WhoAmI\Actions\AbstractCrudAction
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

use AppserverIo\Apps\WhoAmI\Connectors\JsonConnector;
use AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface;
use AppserverIo\Psr\Servlet\Http\HttpServletResponseInterface;
use AppserverIo\Routlt\DispatchAction;
use AppserverIo\Apps\WhoAmI\Interfaces\ConnectorInterface;

/**
 * <TODO CLASS DESCRIPTION>
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH - <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io-apps/whoami
 * @link      http://www.appserver.io/
 */
abstract class AbstractCrudAction extends DispatchAction
{

    protected $connector;

    /**
     * Default constructor
     *
     * @ensures $this->connector instanceof ConnectorInterface
     */
    public function __construct()
    {
        $this->connector = new JsonConnector();
    }

    /**
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface $servletRequest
     * @return mixed
     */
    protected function getProxy(HttpServletRequestInterface $servletRequest)
    {
        // create an initial context instance and inject the servlet request
        $initialContext = new InitialContext();
        $initialContext->injectServletRequest($servletRequest);

        // lookup and return the requested bean proxy
        return $initialContext->lookup(static::PROCESSING_PROXY);
    }

    /**
     * Dummy action implementation that writes 'Hello World' to the response.
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface  $servletRequest  The request instance
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletResponseInterface $servletResponse The response instance
     *
     * @return void
     */
    public function indexAction(HttpServletRequestInterface $servletRequest, HttpServletResponseInterface $servletResponse)
    {
        $servletResponse->appendBodyStream('indexAction');
    }

    /**
     * Dummy action implementation that writes 'Hello World' to the response.
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface  $servletRequest  The request instance
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletResponseInterface $servletResponse The response instance
     *
     * @return void
     */
    public function createAction(HttpServletRequestInterface $servletRequest, HttpServletResponseInterface $servletResponse)
    {
        $instance = $this->connector->getInstance($servletRequest->getBodyStream(), static::TARGET_ENTITY);
        $proxy = $this->getProxy($servletRequest);
        $proxy->create($instance);
    }

    /**
     * Dummy action implementation that writes 'Hello World' to the response.
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface  $servletRequest  The request instance
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletResponseInterface $servletResponse The response instance
     *
     * @return void
     */
    public function getAction(HttpServletRequestInterface $servletRequest, HttpServletResponseInterface $servletResponse)
    {
        $proxy = $this->getProxy($servletRequest);
    }

    /**
     * Dummy action implementation that writes 'Hello World' to the response.
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface  $servletRequest  The request instance
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletResponseInterface $servletResponse The response instance
     *
     * @return void
     */
    public function updateAction(HttpServletRequestInterface $servletRequest, HttpServletResponseInterface $servletResponse)
    {
        $servletResponse->appendBodyStream('updateAction');
    }

    /**
     * Dummy action implementation that writes 'Hello World' to the response.
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface  $servletRequest  The request instance
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletResponseInterface $servletResponse The response instance
     *
     * @return void
     */
    public function deleteAction(HttpServletRequestInterface $servletRequest, HttpServletResponseInterface $servletResponse)
    {
        $servletResponse->appendBodyStream('deleteAction');
    }
}
