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

namespace TCorp\WebApi\Client;


/**
 * A generic client for consuming the Telecom Corpprate WebAPI
 */
class GenericClient
{

    /**
     * Base URL for all entpoints
     *
     * @var string
     */
    protected $baseUrl = 'https://tcorpapi.krealmwebservices.com.au';


    /**
     * Username for API authentication
     *
     * @var string
     */
    protected $username = '';


    /**
     * Password for API authentication
     *
     * @var string
     */
    protected $password = '';


    /**
     * Relative URL to the current endpoint
     *
     * @var string
     */
    protected $endpoint = '';


    /**
     * HTTP query parameters to send with the request
     *
     * @var string[]
     */
    protected $params = array();


    /**
     * A Guzzle HTTP client for sending the requests
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient = null;


    /**
     * Allow redirects when sending the request
     *
     * @var bool
     */
    protected $allowRedirects = false;


    /**
     * Max seconds to wait while trying to connect to the API
     *
     * @var float
     */
    protected $connectTimeout = 0;


    /**
     * Verify the API's SSL certificate
     *
     * @var bool
     */
    protected $verifySSLCert = true;


    /**
     * Max seconds for the request to complete
     *
     * @var float
     */
    protected $timeout = 5;


    /**
     * The last response returned by the API
     *
     * @var mixed
     */
    protected $response = null;



    /**
     * Set the base URL for all endpoints
     * -------------------------------------------------------------------------
     * @param   string  $value  A new value
     *
     * @return void
     */
    public function setBaseUrl(string $value) : void
    {
        $this->baseUrl = trim($value);
    }


    /**
     * Set the username for API authentication
     * -------------------------------------------------------------------------
     * @param   string  $value  A new value
     *
     * @return void
     */
    public function setUsername(string $value) : void
    {
        $this->username = trim($value);
    }


    /**
     * Set the password for API authentication
     * -------------------------------------------------------------------------
     * @param   string  $value  A new value
     *
     * @return void
     */
    public function setPassword(string $value) : void
    {
        $this->password = trim($value);
    }


    /**
     * Set the current endpoint
     * -------------------------------------------------------------------------
     * @param   string  $value  A new value
     *
     * @return void
     */
    public function setEndpoint(string $value) : void
    {
        $this->endpoint = trim($value);
    }


    /**
     * Set the HTTP query parameters to be sent with the request. Note that
     * this method with replace all existing parameters with the new value. Use
     * setParam() to set just one HTTP parameter
     * -------------------------------------------------------------------------
     * @param   array   $value  A new value
     *
     * @return void
     */
    public function setParams(array $value) : void
    {
        $this->params = $value;
    }


    /**
     * Set the value of a single HTTP parameter
     * -------------------------------------------------------------------------
     * @param   string  $name   Name of the HTTP parameter
     * @param   mixed   $value  New value of the HTTP parameter
     *
     * @return void
     */
    public function setParam(string $name, mixed $value) : void
    {
        $this->params[$name] = $value;
    }


    /**
     * Set wether to allow redirects or not
     * -------------------------------------------------------------------------
     * @param   bool  $value  A new value
     *
     * @return void
     */
    public function setAllowRedirects(bool $value) : void
    {
        $this->allowRedirects = $value;
    }


    /**
     * Set the max seconds to wait while trying to connect to the API
     * -------------------------------------------------------------------------
     * @param   float  $value  A new value
     *
     * @return void
     */
    public function setConnectTimeout(float $value) : void
    {
        $this->connectTimeout = $value;
    }


    /**
     * Set wether to verify the API's SSL certificate or not
     * -------------------------------------------------------------------------
     * @param   bool  $value  A new value
     *
     * @return void
     */
    public function setVerifySSLCert(bool $value) : void
    {
        $this->verifySSLCert = $value;
    }


    /**
     * Set the max seconds for the request to complete
     * -------------------------------------------------------------------------
     * @param   float  $value  A new value
     *
     * @return void
     */
    public function setTimeout(float $value) : void
    {
        $this->timeout = $value;
    }


    /**
     * Set the last response returned by the API
     * -------------------------------------------------------------------------
     * @param   mixed     $value  A new value
     *
     * @return void
     */
    protected function setResponse($value) : void
    {
        $this->response = $value;
    }


    /**
     * Get the base URL for all endpoints
     * -------------------------------------------------------------------------
     * @return  string  A base URL
     */
    public function getBaseUrl() : string
    {
        return $this->baseUrl;
    }


    /**
     * Get the username for API authentication
     * -------------------------------------------------------------------------
     * @return  string  An API Username
     */
    public function getUsername() : string
    {
        return $this->username;
    }


    /**
     * Get the password for API authentication
     * -------------------------------------------------------------------------
     * @return  string  An API Password
     */
    public function getPassword() : string
    {
        return $this->password;
    }


    /**
     * Get the the current endpoint
     * -------------------------------------------------------------------------
     * @return  string  Relative URL to the current endpoint
     */
    public function getEndpoint() : string
    {
        return $this->endpoint;
    }


    /**
     * Get the HTTP query parameters to be sent with the request
     * -------------------------------------------------------------------------
     * @return  array   Array of HTTP params and thier values
     */
    public function getParams() : array
    {
        return $this->params;
    }


    /**
     * Get wether to allow redirects or not
     * -------------------------------------------------------------------------
     * @return  bool    TRUE if redirects allowed, FALSE if not
     */
    public function getAllowRedirects() : bool
    {
        return $this->allowRedirects;
    }


    /**
     * Get the max seconds to wait while trying to connect to the API
     * -------------------------------------------------------------------------
     * @return  float   Max seconds to wait
     */
    public function getConnectTimeout() : float
    {
        return $this->connectTimeout;
    }


    /**
     * Get wether to verify the API's SSL certificate or not
     * -------------------------------------------------------------------------
     * @return  bool    TRUE if verity SSL certificate, FALSE if not
     */
    public function getVerifySSLCert() : bool
    {
        return $this->verifySSLCert;
    }


    /**
     * Get the max seconds for the request to complete
     * -------------------------------------------------------------------------
     * @return  float   Max seconds for the request to complete
     */
    public function getTimeout() : float
    {
        return $this->timeout;
    }


    /**
     * Get the last response returned by the API
     * -------------------------------------------------------------------------
     * @return  mixed   The last response returned by the API
     */
    public function getResponse() : mixed
    {
        return $this->response;
    }



    /**
     * Execute the API rquest using the GET http method
     * -------------------------------------------------------------------------
     * @return [type] [description]
     */
    public function get()
    {
    }


    /**
     * Execute the API rquest using the POST http method
     * -------------------------------------------------------------------------
     * @return [type] [description]
     */
    public function post()
    {
    }


    /**
     * Execute the API rquest using the PUT http method
     * -------------------------------------------------------------------------
     * @return [type] [description]
     */
    public function put()
    {
    }


    /**
     * Execute the API rquest using the DELETE http method
     *  -------------------------------------------------------------------------
     * @return [type] [description]
     */
    public function delete()
    {
    }


    /**
     * Execute the API rquest using the PATCH http method
     * -------------------------------------------------------------------------
     * @return [type] [description]
     */
    public function patch()
    {
    }



    public function execute(string $)


}
