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
 * Basic client for sending API requests to Rest APIs
 */
class Client
{

    /**
     * Base URL for all API resources
     *
     * @var string
     */
    protected $baseUrl = '';

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
     * Send an API request and return the result
     * -------------------------------------------------------------------------
     * @return stdClass
     */
    public function execute()
    {
        // Initialise a HTTP client
        $client = new \GuzzleHttp\Client(['base_uri' => $this->getBaseUrl()]);

        // Send the HTTP request and get the result
        $result = $client->request($this->getMethod(), $this->getResource(), [
            'query'   => $this->getParams(),
            'headers' => $this->getHeaders(),
            'auth'    => [$this->getClientId(), $this->getSecret()],
            'timeout' => $this->getTimeout()
        ]);

        // Decode the result
        $result = json_decode($result->getBody());

        // Return the result
        return $result;
    }


    /**
     * Set the base URL for all API resources
     * -------------------------------------------------------------------------
     * @param  string   $value  An absolute base URL
     *
     * @return \TCorp\Rest\Client
     */
    public function setBaseUrl(string $value) : Client
    {
        $this->baseUrl = $value;
        return $this;
    }


    /**
     * Get the base URL for all API resources
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getBaseUrl() : string
    {
        return $this->baseUrl;
    }


    /**
     * Set the relative URL to the required resource
     * -------------------------------------------------------------------------
     * @param  string   $value  A relative URL
     *
     * @return \TCorp\Rest\Client
     */
    public function setResource(string $value) : Client
    {
        $this->resource = $value;
        return $this;
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
     * Set the HTTP method to use when sending the requst
     * -------------------------------------------------------------------------
     * @param  string   $value  A HTTP method/verb (eg: GET,POST,PUT,DELETE)
     *
     * @return \TCorp\Rest\Client
     */
    public function setMethod(string $value) : Client
    {
        $this->method = strtoupper($value);
        return $this;
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
     * Set the HTTP parameters to send with the request
     * -------------------------------------------------------------------------
     * @param  mixed    $value  Assoc array or object containing HTTP params
     *
     * @return \TCorp\Rest\Client
     */
    public function setParams($value) : Client
    {
        $this->params = (array) $value;
        return $this;
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
     * Clear/remove all parameters
     * -------------------------------------------------------------------------
     * @return Client
     */
    public function clearParams() : Client
    {
        $this->params = [];
        return $this;
    }


    /**
     * Set the single HTTP parameter to send with the request
     * -------------------------------------------------------------------------
     * @param  string   $name   The name of the HTTP parameter
     * @param  mixed    $value  A new value for the parameter
     *
     * @return \TCorp\Rest\Client
     */
    public function setParam(string $name, $value) : Client
    {
        $this->params[$name] = $value;
        return $this;
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
     * Set the additional HTTP headers to send with the request
     * -------------------------------------------------------------------------
     * @param  array   $value   Assoc array of HTTP headers
     *
     * @return \TCorp\Rest\Client
     */
    public function setHeaders(array $value) : Client
    {
        $this->headers = $value;
        return $this;
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
     * Set the single HTTP header to send with the request
     * -------------------------------------------------------------------------
     * @param  string   $name   The name of the HTTP header
     * @param  mixed    $value  A new value for the header
     *
     * @return \TCorp\Rest\Client
     */
    public function setHeader(string $name, $value) : Client
    {
        $this->headers[$name] = $value;
        return $this;
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
     * Set the client id/username for authentication
     * -------------------------------------------------------------------------
     * @param  string   $value  An API client id/username
     *
     * @return \TCorp\Rest\Client
     */
    public function setClientId(string $value) : Client
    {
        $this->clientId = $value;
        return $this;
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
     * Set the secret/key/password for authentication
     * -------------------------------------------------------------------------
     * @param  string   $value  An API client secret/key/password
     *
     * @return \TCorp\Rest\Client
     */
    public function setSecret(string $value) : Client
    {
        $this->secret = $value;
        return $this;
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
     * Set the timeout for the request in seconds.
     * -------------------------------------------------------------------------
     * @param  float  $value    Timeout in seconds
     *
     * @return \TCorp\Rest\Client
     */
    public function setTimeout(float $value) : Client
    {
        $this->timeout = $value;
        return $this;
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
