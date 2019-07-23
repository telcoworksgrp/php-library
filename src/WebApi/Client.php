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

namespace TCorp\WebApi;


/**
 * A client for consuming the Telecom Corporate WebAPI
 */
class Client
{

    /**
     * Base URL for all entpoints
     *
     * @var string
     */
    protected $baseUrl = 'https://api.telecomcorp.com.au';


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
    * Allow redirects when sending the request
    *
    * @var bool
    */
    protected $redirects = false;


    /**
    * Verify the API's SSL certificate
    *
    * @var bool
    */
    protected $verifySSL = true;


    /**
    * Max seconds for the request to complete
    *
    * @var float
    */
    protected $timeout = 5;


    /**
     * The request to send to the API
     *
     * @var \TCorp\WebApi\Request
     */
    protected $request = null;


    /**
     * The last response returned by the API
     *
     * @var \TCorp\WebApi\Response
     */
    protected $response = null;



    /**
     * Set the base URL for all endpoints
     * -------------------------------------------------------------------------
     * @param   string  $value  A new value
     *
     * @return $this
     */
    public function setBaseUrl(string $value) : Client
    {
        $this->baseUrl = rtrim($value, '/');
        return $this;
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
     * Set the username for API authentication
     * -------------------------------------------------------------------------
     * @param   string  $value  A new value
     *
     * @return \TCorp\WebApi\Client
     */
    public function setUsername(string $value) : Client
    {
        $this->username = trim($value);
        return $this;
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
     * Set the password for API authentication
     * -------------------------------------------------------------------------
     * @param   string  $value  A new value
     *
     * @return \TCorp\WebApi\Client
     */
    public function setPassword(string $value) : Client
    {
        $this->password = trim($value);
        return $this;
    }


    /**
     * Get the password for API authentication
     * -------------------------------------------------------------------------
     * @return  string  An API password
     */
    public function getPassword() : string
    {
        return $this->password;
    }


    /**
     * Set whether to allow redirects or not
     * -------------------------------------------------------------------------
     * @param   bool  $value  A new value
     *
     * @return \TCorp\WebApi\Client
     */
    public function setRedirects(bool $value) : Client
    {
        $this->redirects = $value;
        return $this;
    }


    /**
     * Get whether to allow redirects or not
     * -------------------------------------------------------------------------
     * @return  bool    TRUE if redirects allowed, FALSE if not
     */
    public function getRedirects() : bool
    {
        return $this->redirects;
    }


    /**
     * Set whether to verify the API's SSL certificate or not
     * -------------------------------------------------------------------------
     * @param   bool  $value  A new value
     *
     * @return \TCorp\WebApi\Client
     */
    public function setVerifySSL(bool $value) : Client
    {
        $this->verifySSLCert = $value;
        return $this;
    }


    /**
     * Get whether to verify the API's SSL certificate or not
     * -------------------------------------------------------------------------
     * @return  bool    TRUE if verity SSL certificate, FALSE if not
     */
    public function getVerifySSL() : bool
    {
        return $this->verifySSL;
    }


    /**
     * Set the max seconds for the request to complete
     * -------------------------------------------------------------------------
     * @param   float  $value  A new value
     *
     * @return \TCorp\WebApi\Client
     */
    public function setTimeout(float $value) : Client
    {
        $this->timeout = $value;
        return $this;
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
     * Set the request to be sent to the API
     * -------------------------------------------------------------------------
     * @param \TCorp\WebApi\Request     $value  An API Request
     *
     * @return \TCorp\WebApi\Client
     */
    public function setRequest(Request $value) : Client
    {
        $this->request = $value;
        return $this;
    }


    /**
     * Get the request to be sent to the API
     * -------------------------------------------------------------------------
     * @return  \TCorp\WebApi\Request   The API Request
     */
    public function getRequest() : Request
    {
        return $this->request;
    }


    /**
     * Set the response returned from the API
     * -------------------------------------------------------------------------
     * @param \TCorp\WebApi\Response    $value  An API Response
     *
     * @return \TCorp\WebApi\Client
     */
    public function setResponse(Response $value) : Client
    {
        $this->response = $value;
        return $this;
    }


    /**
     * Get the the response returned from the API
     * -------------------------------------------------------------------------
     * @return  \TCorp\WebApi\Response   The API Response
     */
    public function getResponse() : Response
    {
        return $this->response;
    }


    /**
     * Send the API request and return/store the Response
     *  -------------------------------------------------------------------------
     * @return \TCorp\WebApi\Response   The API Response
     */
    public function execute()
    {
        // Check that we have a valid request
        $request = $this->getRequest();
        if (empty($request)) {
            throw new \Exception("No request has been set", 500);
        }

        // Compose and execute the HTTP request
        $httpClient = \GuzzleHttp\Client([
            'base_uri'        => $this->getBaseUrl(),
            'allow_redirects' => $this->getRedirects(),
            'auth'            => [$this->getUsername(), $this->getPassword()],
            'verify'          => $this->verifySSL(),
            'timeout'         => $this->getTimeout(),
            'version'         => '1.1',
        ]);

        $httpResponse = $httpClient->request();




        // Store the API's response

        // Return the API's response
        return $this->getResponse();
    }


}
