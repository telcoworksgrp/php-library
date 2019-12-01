<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp;


/**
 * Client for accessing Telecom Corporate's Web API
 */
class WebApi
{

    /**
     * Base URL for all API resources
     *
     * @var string
     */
    protected $baseUrl = 'https://api.telecomcorp.com.au/';

    /**
     * Relative URL to the required resource
     *
     * @var string
     */
    protected $resource = '';


    /**
     * HTTP method to use when sending the requst
     *
     * @var string
     */
    protected $method = 'GET';


    /**
     * HTTP parameters to send with the request
     *
     * @var string
     */
    protected $params = [];


    /**
     * Additional HTTP headers to send with the request
     *
     * @var string[]
     */
    protected $headers = [];


    /**
     * A client id/username for authentication
     *
     * @var string
     */
    protected $clientId = '';


    /**
     * A secret/key/password for authentication
     *
     * @var string
     */
    protected $secret = '';


    /**
     * Timeout for the request in seconds. Use 0 for unlimited
     *
     * @var float
     */
    protected $timeout = 0;



    /**
     * Set the relative URL to the required resource
     * -------------------------------------------------------------------------
     * @param  string   $value  A relative URL
     *
     * @return Client
     */
    public function setResource(string $value) : Client
    {
        $this->resource = $value;
    }


    /**
     * Set the HTTP method to use when sending the requst
     * -------------------------------------------------------------------------
     * @param  string   $value  A HTTP method/verb (eg: GET,POST,PUT,DELETE)
     *
     * @return Client
     */
    public function setMethod(string $value) : Client
    {
        $this->method = $value;
    }


    /**
     * Set the HTTP parameters to send with the request
     * -------------------------------------------------------------------------
     * @param  mixed    $value  Assoc array or object containing HTTP params
     *
     * @return Client
     */
    public function setParams($value) : Client
    {
        $this->params = (array) $value;
    }


    /**
     * Set the single HTTP parameter to send with the request
     * -------------------------------------------------------------------------
     * @param  string   $name   The name of the HTTP parameter
     * @param  mixed    $value  A new value for the parameter
     *
     * @return Client
     */
    public function setParam(string $name, $value) : Client
    {
        $this->params[$name] = $value;
    }


    /**
     * Set the additional HTTP headers to send with the request
     * -------------------------------------------------------------------------
     * @param  array   $value   Assoc array of HTTP headers
     *
     * @return Client
     */
    public function setHeaders(array $value) : Client
    {
        $this->headers = $value;
    }


    /**
     * Set the single HTTP header to send with the request
     * -------------------------------------------------------------------------
     * @param  string   $name   The name of the HTTP header
     * @param  mixed    $value  A new value for the header
     *
     * @return Client
     */
    public function setHeader(string $name, $value) : Client
    {
        $this->headers[$name] = $value;
    }


    /**
     * Set the client id/username for authentication
     * -------------------------------------------------------------------------
     * @param  string   $value  An API client id/username
     *
     * @return Client
     */
    public function setClientId(string $value) : Client
    {
        $this->clientId = $value;
    }


    /**
     * Set the secret/key/password for authentication
     * -------------------------------------------------------------------------
     * @param  string   $value  An API client secret/key/password
     *
     * @return Client
     */
    public function setSecret(string $value) : Client
    {
        $this->secret = $value;
    }


    /**
     * Set the timeout for the request in seconds.
     * -------------------------------------------------------------------------
     * @param  float  $value    Timeout in seconds
     *
     * @return Client
     */
    public function setTimeout(float $value) : Client
    {
        $this->timeout = $value;
    }


    /**
     * Get the relative URL to the required resource
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getResource() : string
    {
        return $this->resource;
    }


    /**
     * Get the HTTP method to use when sending the requst
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }


    /**
     * Get the HTTP parameters to send with the request
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getParams() : array
    {
        return $this->params;
    }


    /**
     * Get the additional HTTP headers to send with the request
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getHeaders() : array
    {
        return $this->headers;
    }


    /**
     * Get a single HTTP parameter to send with the request
     * -------------------------------------------------------------------------
     * @param  string   $name       The name of the HTTP parameter
     * @param  mixed    $default    Value to return if not value is found
     *
     * @return string
     */
    public function getParam(string $name, $default)
    {
        return $this->params[$name] ?? $default;
    }


    /**
     * Get a single HTTP header to send with the request
     * -------------------------------------------------------------------------
     * @param  string   $name       The name of the HTTP header
     * @param  mixed    $default    Value to return if not value is found
     *
     * @return string
     */
    public function getHeader(string $name, $default)
    {
        return $this->headers[$name] ?? $default;
    }


    /**
     * Get the client id/username for authentication
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getClientId() : string
    {
        return $this->clientId;
    }


    /**
     * Get the secret/key/password for authentication
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getSecret() : string
    {
        return $this->secret;
    }


    /**
     * Get the timeout for the request in seconds.
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getTimeout() : float
    {
        return $this->timeout;
    }



}
