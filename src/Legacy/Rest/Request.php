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
 * Class for composing an REST API request.
 */
class Request
{

    /**
     * A list of valid HTTP methods/verbs
     *
     * @var string[]
     */
    protected static $validMethods = ['GET','POST','PUT',
        'PATCH','DELETE','OPTIONS'];


    /**
     * Resouce URL to send the API request to
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
     * Set the resouce URL to send the API request to
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return $this
     */
    public function setResource(string $value) : Request
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
    public function setMethod(string $value) : Request
    {

        // If valid, set the new value
        if (in_array($value, static::$validMethods)){
            $this->method = $method;
        }

        // Return the result
        return $this;
    }


    /**
     * Set the entire list of parameters to send with the request
     * -------------------------------------------------------------------------
     * @param   mixed   $value  Object or assoc array containing new values
     *
     * @return $this
     */
    public function setParams($value) : Request
    {
        // Make sure we have an array
        $value = (array) $value;

        // Set the new value
        $this->params = $value;

        // Return the result
        return $this;
    }


    /**
     * Set a single parameter to send with the request
     * -------------------------------------------------------------------------
     * @param   string      $name       Name of the parameter to set
     * @param   string|int  $value      A new value for the parameter
     * @param   bool        $replace    Replace any existing value
     *
     * @return $this
     */
    public function setParam(string $name, $value, bool $replace = true) : Request
    {
        // Set the new value
        if (!(isset($this->params[$name]) && !replace)) {
            $this->params[$name] = $value;
        }

        // Return the result
        return $this;
    }


    /**
     * Set the entire list of additional headers to send with the request
     * -------------------------------------------------------------------------
     * @param   string[]    $value  An assoc array containing HTTP headers
     *
     * @return $this
     */
    public function setHeaders(array $value) : Request
    {
        // Set the new value
        $this->headers = $value;

        // Return the result
        return $this;
    }



    public function setHeader(string $name, $value, bool $replace = true) : Request
    {
        // Set the new value
        $this->headers[$name] = $value;

        // Return the result
        return $this;
    }






    public function getResource() : string
    {
    }

    public function getMethod() : string
    {
    }

    public function getParams() : array
    {
    }

    public function getParam(string $name, $default = null)
    {
    }

    public function getHeaders() : array
    {
    }

    public function getHeader(string $name, $default = null)
    {
    }

}
