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


class Client
{

    /**
     * A list of valid HTTP methods/verbs
     *
     * @var string[]
     */
    protected static $validMethods = ['GET','POST','PUT',
        'PATCH','DELETE','OPTIONS'];


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
     * [protected description]
     *
     * @var string
     */
    protected $method = 'GET';

    protected $params = [];

    protected $format = 'json';

    protected $headers = [];

    protected $timeout = 5;

    protected $verifySSL = true;

    protected $username = '';

    protected $password = '';

    protected $allowRedirects = true;

    protected $response = null;



    /**
     * [setEndpoint description]
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
     * [setResource description]
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
     * [setMethod description]
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return  $this
     */
    public function setMethod(string $value) : Client
    {
        // Convert to uppercase
        $value = strtoupper($value);

        // If valid, set the new value
        if (in_array($value, static::$validMethods)) {
            $this->method = $value;
        }

        // Return the result
        return $this;
    }


    /**
     * [setParams description]
     * -------------------------------------------------------------------------
     * @param   \stdClass|array     $value  The new value
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
     * [setFormat description]
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return  $this
     */
    public function setFormat(string $value) : Client
    {
        // Set the new value
        $this->format = $value;

        // Return the result
        return $this;
    }


    /**
     * [setHeaders description]
     * -------------------------------------------------------------------------
     * @param   array   $value  The new value
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
     * [setTimeout description]
     * -------------------------------------------------------------------------
     * @param   int $value  The new value
     *
     * @return  $this
     */
    public function setTimeout(int $value) : Client
    {
        // Set the new value
        $this->timeout = $value;

        // Return the result
        return $this;
    }


    /**
     * [setVerifySSL description]
     * -------------------------------------------------------------------------
     * @param   bool    $value  The new value
     *
     * @return  $this
     */
    public function setVerifySSL(bool $value) : Client
    {
        // Set the new value
        $this->verifySSL = $value;

        // Return the result
        return $this;
    }


    /**
     * [setUsername description]
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return  $this
     */
    public function setUsername(string $value) : Client
    {
        // Set the new value
        $this->username = $value;

        // Return the result
        return $this;
    }


    /**
     * [setPassword description]
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return  $this
     */
    public function setPassword(string $value) : Client
    {
        // Set the new value
        $this->password = $value;

        // Return the result
        return $this;
    }


    /**
     * [setAllowRedirects description]
     * -------------------------------------------------------------------------
     * @param   bool    $value  The new value
     *
     * @return  $this
     */
    public function setAllowRedirects(bool $value) : Client
    {
        // Set the new value
        $this->allowRedirects = $value;

        // Return the result
        return $this;
    }


    /**
     * [setResponse description]
     * -------------------------------------------------------------------------
     * @param   [type]  $value  The new value
     *
     * @return  $this
     */
    protected function setResponse($value) : Client
    {
        // Set the new value
        $this->response = $value;

        // Return the result
        return $this;
    }
















    public function create()
    {
    }

    public function read()
    {
    }

    public function update()
    {
    }

    public function delete()
    {
    }

    public function options()
    {
    }

    public function execute()
    {
    }

}
