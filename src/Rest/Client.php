<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Rest;


/**
 * Client for sending and receiving requests and responses from REST APIs
 */
class Client
{

    /**
     * Base URl for all API endpoints
     *
     * @var string
     */
    protected $baseUrl = '';


    /**
     * Request that will be sent to the API
     *
     * @var \TCorp\Rest\Request
     */
    protected $request = null;


    /**
     * Credentials for authenticating with the API
     *
     * @var \TCorp\Rest\Credentials
     */
    protected $credentials = null;


    /**
     * Configuration values for this APi client
     *
     * @var \TCorp\Rest\Config
     */
    protected $config = null;


    /**
     * The last response returned by the API
     *
     * @var \TCorp\Rest\Response
     */
    protected $response = null;



    /**
     * Constructor method for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @param Request       $request       An inital request object
     * @param Credentials   $credentials   An initial credentials object
     * @param Config        $config        An inital config object
     */
    public function __construct($request = null, $credentials = null,
        $config = null)
    {
        // Initialise some class properties
        $this->setRequest($request);
        $this->setCredentials($credentials);
        $this->setConfig($config);
    }


    /**
     * Set the Base URl for all API endpoints
     * -------------------------------------------------------------------------
     * @param  string   $value  A new URL
     *
     * @return Client
     */
    public function setBaseUrl(string $value) : Client
    {
        $this->baseUrl = trim($value);
        $this->baseUrl = rtrim($this->baseUrl, "/");
        return $this;
    }


    /**
     * Get the Base URl for all API endpoints
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getBaseUrl() : string
    {
        return $this->baseUrl;
    }


    /**
     * Set the Request that will be sent to the API
     * -------------------------------------------------------------------------
     * @param  Request  $value  A new request object
     *
     * @return Client
     */
    public function setRequest(Request $value) : Client
    {
        $this->request = $value;
        return $this;
    }


    /**
     * Get the Request that will be sent to the API
     * -------------------------------------------------------------------------
     * @return Request
     */
    public function getRequest() : ?Request
    {
        return $this->request;
    }


    /**
     * Set Credentials for authenticating with the API
     * -------------------------------------------------------------------------
     * @param  Credentials  $value  A new credentials object
     *
     * @return Client
     */
    public function setCredentials(Credentials $value) : Client
    {
        $this->credentials = $value;
        return $this;
    }


    /**
     * Get Credentials for authenticating with the API
     * -------------------------------------------------------------------------
     * @return Credentials
     */
    public function getCredentials() : ?Credentials
    {
        return $this->credentials;
    }


    /**
     * Set Configuration values for this APi client
     * -------------------------------------------------------------------------
     * @param  Config   $value  A new configuration object
     *
     * @return Client
     */
    public function setConfig(Config $value) : Client
    {
        $this->config = $value;
        return $this;
    }


    /**
     * Get Configuration values for this APi client
     * -------------------------------------------------------------------------
     * @return Config
     */
    public function getConfig() : ?Config
    {
        return $this->config;
    }


    /**
     * Set the last response returned by the API
     * -------------------------------------------------------------------------
     * @param  Response $value  A new response object
     *
     * @return Client
     */
    protected function setResponse(Response $value) : Client
    {
        $this->response = $value;
        return $this;
    }


    /**
     * Get the last response returned by the API
     * -------------------------------------------------------------------------
     * @return Response
     */
    public function getResponse() : ?Response
    {
        return $this->response;
    }


    /**
     * Execute/send the current request and get the API's response
     * -------------------------------------------------------------------------
     * @return Response
     *
     * @todo Implimeni this method
     */
    public function execute() : ?Response
    {
    }

}
