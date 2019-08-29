<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\T3;


/**
 * A basic client for sending API requests to Telecom Corporates T3 system
 */
class Client
{

    /**
     * Base URL for all requests
     *
     * @var string
     */
    protected $endpoint = 'https://portal.tbill.live/numbers-service-impl/api';


    /**
     * Resource URL, relative to $endpoint
     *
     * @var string
     */
    protected $resource = '';


    /**
     * HTTP method/verb to use when sending the request.
     *
     * @var string
     */
    protected $method = 'GET';


    /**
     * A list of parameters to send with the request
     *
     * @var mixed[]
     */
    protected $params = [];


    /**
     * A list of additional headers to send with the request
     *
     * @var string[]
     */
    protected $headers = ['Content-type' => 'application/json'];



    /**
     * Set the base URL for all requests
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return  $this
     */
    public function setEndpoint(string $value) : Client
    {
        // Set the new value
        $this->endpoint = rtrim($value, '/ ');

        // Return the result
        return $this;
    }


    /**
     * Set the resource URL, relative to $endpoint
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return  $this
     */
    public function setResource(string $value) : Client
    {
        // Set the new value
        $this->resource = rtrim($value, '/ ');

        // Return the result
        return $this;
    }


    /**
     * Set the HTTP method/verb to use when sending the request.
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return  $this
     */
    public function setMethod(string $value) : Client
    {
        // Set the new value
        $this->method = strtoupper($value);

        // Return the result
        return $this;
    }


    /**
     * Set the entire list of parameters to send with the request
     * -------------------------------------------------------------------------
     * @param   mixed  $value  The new value
     *
     * @return  $this
     */
    public function setParams($value) : Client
    {
        // Make sure the value is an array
        $value = (array) $value;

        // Set the new value
        $this->params = $value;

        // Return the result
        return $this;
    }


    /**
     * Set/add a single HTTP parameter to send with the request
     * -------------------------------------------------------------------------
     * @param  string       $name       The name of the parameter
     * @param  string|int   $value      A value for the parameter
     *
     * @return  $this
     */
    public function setParam(string $name, $value) : Client
    {
        // Set the new value
        $this->params[$name] = $value;

        // Return the result
        return $this;
    }


    /**
     * Set the entire list of additional headers to send with the request
     * -------------------------------------------------------------------------
     * @param   string[]  $value  The new value
     *
     * @return  $this
     */
    public function setHeaders(array $value) : Client
    {
        // Set the new value
        $this->headers = $value;

        // Return the result
        return $this;
    }


    /**
     * Set/add a single additional header to send with the request
     * -------------------------------------------------------------------------
     * @param  string       $name       The HTTP header name
     * @param  string|int   $value      A value for the HTTP header
     *
     * @return  $this
     */
    public function setHeader(string $name, $value) : Client
    {
        // Set the new value
        $this->headers[$name] = $value;

        // Return the result
        return $this;
    }


    /**
     * Get the base URL for all requests
     * -------------------------------------------------------------------------
     * @return  string
     */
    public function getEndpoint() : string
    {
        // Return the result
        return $this->endpoint;
    }


    /**
     * Get the resource URL, relative to $endpoint
     * -------------------------------------------------------------------------
     * @return  string
     */
    public function getResource() : string
    {
        // Return the result
        return $this->resource;
    }


    /**
     * Get the HTTP method/verb to use when sending the request.
     * -------------------------------------------------------------------------
     * @return  string
     */
    public function getMethod() : string
    {
        // Return the result
        return $this->method;
    }


    /**
     * Get the entire list of parameters to send with the request
     * -------------------------------------------------------------------------
     * @return  mixed[]
     */
    public function getParams()
    {
        // Return the result
        return $this->params;
    }


    /**
     * Get a single HTTP parameter to send with the request
     * -------------------------------------------------------------------------
     * @param  string   $name       The name of the parameter
     * @param  mixed    $default    Default value in case it doesn't exist
     *
     * @return  mixed
     */
    public function getParam(string $name, $default = null)
    {
        // Return the result
        return $this->params[$name] ?? $default;
    }


    /**
     * Get the entire list of additional headers to send with the request
     * -------------------------------------------------------------------------
     * @return  string[]
     */
    public function getHeaders() : array
    {
        // Return the result
        return $this->headers;
    }


    /**
     * Get a single additional headers to send with the request
     * -------------------------------------------------------------------------
     * @param  string   $name       The HTTP header name
     * @param  mixed    $default    Default value in case it doesn't exist
     *
     * @return  mixed
     */
    public function getHeader(string $name, $default = null)
    {
        // Return the result
        return $this->headers[$name] ?? $default;
    }


    /**
     * Execute an API request
     * -------------------------------------------------------------------------
     * @return mixed    API response on success, False on failure
     */
    public function execute()
    {
        // Initilise some local variables
        $method       = $this->getMethod();
        $endpoint     = $this->getEndpoint();
        $resource     = $this->getResource();
        $params       = $this->getParams();
        $headers      = $this->getHeaders();


        // Initilise a guzzle http client
        $httpClient = new \GuzzleHttp\Client([
            'base_uri'        => $endpoint,
            'allow_redirects' => true,
            'headers'         => $headers,
        ]);

        // Send the API request
        $response = $httpClient->request($method, $resource, ['query' => $params]);

        $result = ($response->getStatusCode() == 200) ?
            json_decode((string) $response->getBody()) : false;

        // Return the final result.
        return $result;
    }

}
