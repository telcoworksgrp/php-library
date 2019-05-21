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

namespace TCorp\T3\Api;


class Client
{

    /**
     * Base URL for all LIVE endpoints
     *
     * @var string
     */
    protected $baseUrl = '';


    /**
     * Base URL for all SANDBOX endpoints
     *
     * @var string
     */
    protected $sandboxUrl = '';


    /**
     * Use the API in sanbox mode
     *
     * @var bool
     */
    protected $sandBoxMode = false;


    /**
     * Client ID for API authentication
     *
     * @var string
     */
    protected $clientid = ''


    /**
     * Password/secret for API authentication
     *
     * @var string
     */
    protected $password = ''


    /**
     * Endpoint URL (relative to $baseUrl / $sandboxUrl)
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
     * HTTP method to use when making the requst
     *
     * @var string
     */
    protected $method = 'GET';



    /**
     * Get the base URL for all LIVE endpoints
     * -------------------------------------------------------------------------
     * @return  string  A base url for all LIVE endpoints
     */
    public function getBaseUrl()
    {
        return $this->baseurl;
    }


    /**
     * Get the base URL for all SANDBOX endpoints
     * -------------------------------------------------------------------------
     * @return  string  A base url for all SANDBOX endpoints
     */
    public function getSandboxUrl()
    {
        return $this->sandboxUrl;
    }


    /**
     * Get the client is in live or sandbox mode
     * -------------------------------------------------------------------------
     * @return  bool    TRUE= sandbox mode, FALSE = live mode
     */
    public function getSandBoxMode()
    {
        return $this->sandBoxMode;
    }


    /**
     * Get the client ID for API authentication
     * -------------------------------------------------------------------------
     * @return string   A client id
     */
    public function getClientId()
    {
        return $this->clientid;
    }


    /**
     * Get the password/secret for API authentication
     * -------------------------------------------------------------------------
     * @return string   A password/secret
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Get the relative endpoint URL (to $baseUrl / $sandboxUrl)
     * -------------------------------------------------------------------------
     * @return string   A relative endpoint URL
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }


    /**
     * Get the asbolute endpoint URL
     * -------------------------------------------------------------------------
     * @return string   An asbolute endpoint URL
     */
    public function getAbsoluteEndpoint()
    {
        return $this->endpoint;
    }


    /**
     * Get an existing HTTP query parameter
     * -------------------------------------------------------------------------
     * @param   string  $name   $name of the parameter
     *
     * @return string   The value of the parameter
     */
    public function getParam(string $name)
    {
        return $this->param[$name];
    }


    /**
     * Get the HTTP method that will be used when making the requst
     * -------------------------------------------------------------------------
     * @return string   A HTTP method (eg: GET,POST, etc)
     */
    public function getMethod()
    {
        return $this->method;
    }


    /**
     * Set the base URL for all LIVE endpoints
     * -------------------------------------------------------------------------
     * @param   string  A new value
     */
    public function setBaseUrl(string $value)
    {
        $this->baseurl = trim($value);
    }


    /**
     * Set the base URL for all SANDBOX endpoints
     * -------------------------------------------------------------------------
     * @return  string  A base url for all SANDBOX endpoints
     */
    public function setSandboxUrl(string $value)
    {
         $this->sandboxUrl = trim($value);
    }


    /**
     * Set the client into live or sandbox mode
     * -------------------------------------------------------------------------
     * @return  bool    TRUE= sandbox mode, FALSE = live mode
     */
    public function setSandBoxMode(bool $value)
    {
        $this->sandBoxMode = $value;
    }


    /**
     * Set the client ID for API authentication
     * -------------------------------------------------------------------------
     * @return string   A client id
     */
    public function setClientId(string $value)
    {
        $this->clientid = trim($value);
    }


    /**
     * Set the password/secret for API authentication
     * -------------------------------------------------------------------------
     * @return string   A password/secret
     */
    public function setPassword(string $value)
    {
        $this->password = trim($value);
    }


    /**
     * Set the relative endpoint URL (to $baseUrl / $sandboxUrl)
     * -------------------------------------------------------------------------
     * @return string   A relative endpoint URL
     */
    public function setEndpoint(string $value)
    {
        $this->endpoint = trim($value);
    }


    /**
     * Set a HTTP query parameter
     * -------------------------------------------------------------------------
     * @param   string  $name       Name of the parameter
     *
     * @return string   The value of the parameter
     */
    public function setParam(string $name, string $value)
    {
        $this->param[$name] = trim($value);
    }


    /**
     * Set the HTTP method that will be used when making the requst
     * -------------------------------------------------------------------------
     * @return string   A HTTP method (eg: GET,POST, etc)
     */
    public function setMethod(string $value)
    {
        $this->method = trim($value);
    }


    /**
     * Make a call to the Api
     * -------------------------------------------------------------------------
     * @return  object   JSON decoded response from the API
     */
    public function call()
    {

    }


}
