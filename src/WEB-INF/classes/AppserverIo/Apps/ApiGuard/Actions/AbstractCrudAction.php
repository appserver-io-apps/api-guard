<?php

/**
 * \AppserverIo\Apps\ApiGuard\Actions\AbstractCrudAction
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

use AppserverIo\Apps\ApiGuard\Connectors\JsonConnector;
use AppserverIo\Apps\ApiGuard\Interfaces\ConnectorInterface;
use AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface;
use AppserverIo\Psr\Servlet\Http\HttpServletResponseInterface;
use AppserverIo\Routlt\DispatchAction;
use AppserverIo\Appserver\Naming\InitialContext;

/**
 * Abstract action which provides basic CRUD functionality
 *
 * @author    Bernhard Wick <bw@appserver.io>
 * @copyright 2015 TechDivision GmbH <info@appserver.io>
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * @link      https://github.com/appserver-io-apps/api-guard
 * @link      http://www.appserver.io/
 */
abstract class AbstractCrudAction extends DispatchAction
{

    /**
     * The connector used to understand incoming request data
     *
     * @var \AppserverIo\Apps\ApiGuard\Interfaces\ConnectorInterface $connector
     */
    protected $connector;

    /**
     * Default constructor
     *
     * @Ensures("$this->connector instanceof ConnectorInterface")
     */
    public function __construct()
    {
        // we only support a JSON connector by now
        $this->setConnector(new JsonConnector());
    }

    /**
     * Getter for our connector instance
     *
     * @return \AppserverIo\Apps\ApiGuard\Interfaces\ConnectorInterface
     */
    public function getConnector()
    {
        return $this->connector;
    }

    /**
     * Will return the proxy needed for further instance processing in the persistence container
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface $servletRequest The current request
     *
     * @return \AppserverIo\RemoteMethodInvocation\RemoteProxy
     */
    protected function getProxy(HttpServletRequestInterface $servletRequest)
    {
        // create an initial context instance and inject the servlet request
        $initialContext = new InitialContext();
        $initialContext->injectServletRequest($servletRequest);

        // lookup and return the requested bean proxy
        $proxy = $initialContext->lookup(static::PROCESSING_PROXY);
        return $proxy;
    }

    /**
     * Default action to be executed when browsing the mapped URLs
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface  $servletRequest  The request instance
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletResponseInterface $servletResponse The response instance
     *
     * @return null
     */
    public function indexAction(HttpServletRequestInterface $servletRequest, HttpServletResponseInterface $servletResponse)
    {
        $servletResponse->appendBodyStream('indexAction');
    }

    /**
     * Action to create an instance
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface  $servletRequest  The request instance
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletResponseInterface $servletResponse The response instance
     *
     * @return null
     */
    public function createAction(HttpServletRequestInterface $servletRequest, HttpServletResponseInterface $servletResponse)
    {
        $instance = $this->connector->instanceFromString($servletRequest->getBodyStream(), static::TARGET_ENTITY);
        $proxy = $this->getProxy($servletRequest);
        $proxy->create($instance);
    }

    /**
     * Action to get an instance
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface  $servletRequest  The request instance
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletResponseInterface $servletResponse The response instance
     *
     * @return null
     */
    public function getAction(HttpServletRequestInterface $servletRequest, HttpServletResponseInterface $servletResponse)
    {
        $instance = $this->connector->instanceFromString($servletRequest->getBodyStream(), static::TARGET_ENTITY);
        $proxy = $this->getProxy($servletRequest);
        $proxy->get($instance);
    }

    /**
     * Action to update an instance
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface  $servletRequest  The request instance
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletResponseInterface $servletResponse The response instance
     *
     * @return null
     */
    public function updateAction(HttpServletRequestInterface $servletRequest, HttpServletResponseInterface $servletResponse)
    {
        $instance = $this->connector->instanceFromString($servletRequest->getBodyStream(), static::TARGET_ENTITY);
        $proxy = $this->getProxy($servletRequest);
        $proxy->update($instance);
    }

    /**
     * Action to delete an instance
     *
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletRequestInterface  $servletRequest  The request instance
     * @param \AppserverIo\Psr\Servlet\Http\HttpServletResponseInterface $servletResponse The response instance
     *
     * @return null
     */
    public function deleteAction(HttpServletRequestInterface $servletRequest, HttpServletResponseInterface $servletResponse)
    {
        $instance = $this->connector->instanceFromString($servletRequest->getBodyStream(), static::TARGET_ENTITY);
        $proxy = $this->getProxy($servletRequest);
        $proxy->delete($instance);
    }

    /**
     * Setter for our connector instance
     *
     * @param \AppserverIo\Apps\ApiGuard\Interfaces\ConnectorInterface $connector Connector instance to use
     *
     * @return null
     */
    public function setConnector(ConnectorInterface $connector)
    {
        $this->connector = $connector;
    }
}
