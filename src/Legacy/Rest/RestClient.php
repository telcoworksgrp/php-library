<?php
/**
 * =============================================================================
 *
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 * =============================================================================
 */

namespace TCorp\Legacy\Rest;

/**
 * Basic REST API client for sending/reciving REST resources
 */
class RestClient
{

    /**
     * Base URL for all requests
     *
     * @var string
     */
    protected $endpoint = '';


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
    protected $headers = [];


    /**
     * Maximum number of seconds for an API request to complete
     *
     * @var int
     */
    protected $timeout = 5;


    /**
     * Allow redirects when sending an API request or not
     *
     * @var bool
     */
    protected $verifySSL = true;

    protected $username = '';

    protected $password = '';

    protected $allowRedirects = true;

    protected $response = null;



/**
 * Set the
 * -----------------------------------------------------------------------------
 * @param   string  $value  The new value
 *
 * @return  $this
 */
public function setEndpoint(string $value) : RestClient
{
    // Set the new value
    $this->endpoint = $value;

    // Return the result
    return $this;
}


/**
 * Set the
 * -----------------------------------------------------------------------------
 * @param   string  $value  The new value
 *
 * @return  $this
 */
public function setResource(string $value) : RestClient
{
    // Set the new value
    $this->resource = $value;

    // Return the result
    return $this;
}


/**
 * Set the
 * -----------------------------------------------------------------------------
 * @param   string  $value  The new value
 *
 * @return  $this
 */
public function setMethod(string $value) : RestClient
{
    // Set the new value
    $this->method = $value;

    // Return the result
    return $this;
}


/**
 * Set the
 * -----------------------------------------------------------------------------
 * @param   string  $value  The new value
 *
 * @return  $this
 */
public function setParams(string $value) : RestClient
{
    // Set the new value
    $this->params = $value;

    // Return the result
    return $this;
}


/**
 * Set the
 * -----------------------------------------------------------------------------
 * @param   string  $value  The new value
 *
 * @return  $this
 */
public function setHeaders(string $value) : RestClient
{
    // Set the new value
    $this->headers = $value;

    // Return the result
    return $this;
}


/**
 * Set the
 * -----------------------------------------------------------------------------
 * @param   string  $value  The new value
 *
 * @return  $this
 */
public function setTimeout(string $value) : RestClient
{
    // Set the new value
    $this->timeout = $value;

    // Return the result
    return $this;
}


/**
 * Set the
 * -----------------------------------------------------------------------------
 * @param   string  $value  The new value
 *
 * @return  $this
 */
public function setVerifySSL(string $value) : RestClient
{
    // Set the new value
    $this->verifySSL = $value;

    // Return the result
    return $this;
}


/**
 * Set the
 * -----------------------------------------------------------------------------
 * @param   string  $value  The new value
 *
 * @return  $this
 */
public function setUsername(string $value) : RestClient
{
    // Set the new value
    $this->username = $value;

    // Return the result
    return $this;
}


/**
 * Set the
 * -----------------------------------------------------------------------------
 * @param   string  $value  The new value
 *
 * @return  $this
 */
public function setPassword(string $value) : RestClient
{
    // Set the new value
    $this->password = $value;

    // Return the result
    return $this;
}


/**
 * Set the
 * -----------------------------------------------------------------------------
 * @param   string  $value  The new value
 *
 * @return  $this
 */
public function setAllowRedirects(string $value) : RestClient
{
    // Set the new value
    $this->allowRedirects = $value;

    // Return the result
    return $this;
}


/**
 * Set the
 * -----------------------------------------------------------------------------
 * @param   string  $value  The new value
 *
 * @return  $this
 */
public function setResponse(string $value) : RestClient
{
    // Set the new value
    $this->response = $value;

    // Return the result
    return $this;
}


/**
 * Get the
 * -----------------------------------------------------------------------------
 * @return  string
 */
public function getEndpoint() : string
{
    // Return the result
    return $this->endpoint;
}


/**
 * Get the
 * -----------------------------------------------------------------------------
 * @return  string
 */
public function getResource() : string
{
    // Return the result
    return $this->resource;
}


/**
 * Get the
 * -----------------------------------------------------------------------------
 * @return  string
 */
public function getMethod() : string
{
    // Return the result
    return $this->method;
}


/**
 * Get the
 * -----------------------------------------------------------------------------
 * @return  string
 */
public function getParams() : string
{
    // Return the result
    return $this->params;
}


/**
 * Get the
 * -----------------------------------------------------------------------------
 * @return  string
 */
public function getHeaders() : string
{
    // Return the result
    return $this->headers;
}


/**
 * Get the
 * -----------------------------------------------------------------------------
 * @return  string
 */
public function getTimeout() : string
{
    // Return the result
    return $this->timeout;
}


/**
 * Get the
 * -----------------------------------------------------------------------------
 * @return  string
 */
public function getVerifySSL() : string
{
    // Return the result
    return $this->verifySSL;
}


/**
 * Get the
 * -----------------------------------------------------------------------------
 * @return  string
 */
public function getUsername() : string
{
    // Return the result
    return $this->username;
}


/**
 * Get the
 * -----------------------------------------------------------------------------
 * @return  string
 */
public function getPassword() : string
{
    // Return the result
    return $this->password;
}


/**
 * Get the
 * -----------------------------------------------------------------------------
 * @return  string
 */
public function getAllowRedirects() : string
{
    // Return the result
    return $this->allowRedirects;
}


/**
 * Get the
 * -----------------------------------------------------------------------------
 * @return  string
 */
public function getResponse() : string
{
    // Return the result
    return $this->response;
}









}
