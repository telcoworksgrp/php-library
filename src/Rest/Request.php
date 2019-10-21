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
 * Class that represents a REST API request
 */
class Request
{

    /**
     * The relative URL to the API endpoint to which the
     * request should be sent to.
     *
     * @var string
     */
    protected $endpoint = '';

    /**
     * HTTP method to use when sending the request to
     * the API (eg: GET, POST, PUT, DELETE, etc)
     *
     * @var string
     */
    protected $method = 'GET';


    /**
     * HTTP parameters to be sent with the request to the API
     *
     * @var string[]
     */
    protected $params = [];


    /**
     * Additional HTTP headers to be sent with the request
     *
     * @var string[]
     */
    protected $headers = [];



    /**
     * Constructor method for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @param string          $endpoint  Inital endpoint URL
     * @param string          $method    Initial HTTP method to use
     * @param array|stdClass  $params    Inital list of HTTP params
     * @param array           $headers   Inital list of HTTP headers
     */
    public function __construct(string $endpoint = '', string $method = 'GET',
        $params = [], array $headers = [])
    {
        // Initialise some class properties
        $his->setEndpoint($endpoint);
        $this->setMethod($method);
        $this->setParams($params);
        $this->setHeaders($headers);
    }


    /**
     * Set the API endpoint to which the request should be sent to.
     * -------------------------------------------------------------------------
     * @param  string  $value   A new relative URL
     *
     * @return Request
     */
    public function setEndpoint(string $value) : Request
    {
        $this->endpoint = trim($value);
        $this->endpoint = trim($this->endpoint, "/");
        return $this;
    }


    /**
     * Get the API endpoint URL to which the request will be sent to.
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getEndpoint() : string
    {
        return $this->endpoint;
    }


    /**
     * Set the HTTP method to use when sending the request
     * -------------------------------------------------------------------------
     * @param  string  $value   A new HTTP method (eg: GET,POST,PUT,DELETE)
     *
     * @return Request
     */
    public function setMethod(string $value) : Request
    {
        $this->method = trim($value);
        $this->method = strtoupper($this->method);
        return $this;
    }


    /**
     * Get the HTTP method that will be used when sending the request
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }


    /**
     * Set ALL HTTP parameters to be sent with the request
     * -------------------------------------------------------------------------
     * @param  array|stdClass   $value   Assoc array or object with new params
     *
     * @return Request
     */
    public function setParams($value) : Request
    {
        $this->params = (array) $value;
        return $this;
    }


    /**
     * Get ALL HTTP parameters to be sent with the request
     * -------------------------------------------------------------------------
     * @param  bool $asObject   Return result as an object
     *
     * @return mixed
     */
    public function getParams(bool $asObject = false)
    {
        return ($asObject) ? (object) $this->params : $this->params;
    }


    /**
     * Remove all HTTP parameters from the request
     * -------------------------------------------------------------------------
     * @return Request
     */
    public function clearParams() : Request
    {
        $this->params = [];
    }


    /**
     * Set a single HTTP parameter which will be sent with the request
     * -------------------------------------------------------------------------
     * @param  string   $name   Name of the HTTP param to add/set
     * @param  mixed    $value  Value to set the param to
     *
     * @return Request
     */
    public function setParam(string $name, $value) : Request
    {
        $this->params[$name] = $value;
        return $this;
    }


    /**
     * Get a single HTTP parameter which will be sent with the request
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the HTTP param to get
     * @param  mixed    $default    Value to return if no value found
     *
     * @return mixed
     */
    public function getParam(string $name, $default = null)
    {
        return $this->params[$name] ?? $default;
    }


    /**
     * Set ALL HTTP headers to be sent with the request
     * -------------------------------------------------------------------------
     * @param  string[]   $value   Assoc array of HTTP headers
     *
     * @return Request
     */
    public function setHeaders(array $value) : Request
    {
        $this->headers = $value;
        return $this;
    }


    /**
     * Get ALL HTTP headers to be sent with the request to the API
     * -------------------------------------------------------------------------
     * @return string[]
     */
    public function getHeaders() : array
    {
        return $this->headers;
    }


    /**
     * Remove all HTTP headers from the request
     * -------------------------------------------------------------------------
     * @return Request
     */
    public function clearHeaders() : Request
    {
        $this->headers = [];
    }


    /**
     * Set a single HTTP header which will be sent with the request
     * -------------------------------------------------------------------------
     * @param  string   $name   Name of the HTTP header to add/set
     * @param  string   $value  Value to set the header to
     *
     * @return Request
     */
    public function setHeader(string $name, string $value) : Request
    {
        $this->headers[$name] = $value;
        return $this;
    }


    /**
     * Get a single HTTP header which will be sent with the request
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the HTTP header to get
     * @param  mixed    $default    Value to return if no value found
     *
     * @return mixed
     */
    public function getHeader(string $name, $default = null)
    {
        return $this->headers[$name] ?? $default;
    }

}
