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
     * Base URL for all live entpoints
     *
     * @var string
     */
    protected $baseUrl = 'https://api.telecomcorp.com.au';


    /**
     * Base URL for all sandbox entpoints
     *
     * @var string
     */
    protected $sanboxBaseUrl = 'https://sandbox.api.telecomcorp.com.au';


    /**
     * Whether to operate in sandbox mode or not
     *
     * @var bool
     */
    protected $sandboxMode = false;


    /**
     * A client id/username for API authentication
     *
     * @var string
     */
    protected $clientId = '';


    /**
     * A client secret/password for API authentication
     *
     * @var string
     */
    protected $clientSecret = '';


    /**
     * Maximum number of seconds for an API request to complete
     *
     * @var int
     */
    protected $timeout = 5;


    /**
     * Whether to verify the API's SSL certificate or not
     *
     * @var bool
     */
    protected $verifySSL = true;


    /**
     * Whether to allow redirects when sending an API request or not
     *
     * @var bool
     */
    protected $redirects = true;


    /**
     * A http client for sending/receiving API requests
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient = null;


    /**
     * HTTP method to use for the next API request
     *
     * @var string
     */
    protected $method = 'GET';


    /**
     * The endpoint url for the next API request. This URL can
     * be relative to $baseUrl or  $sanboxBaseUrl
     *
     * @var string
     */
    protected $endpoint = '';


    /**
     * HTTP parameters to send with the next API request
     *
     * @var mixed[]
     */
    protected $params = [];

    /**
     * Extra HTTP request headers to send with the next API request
     *
     * @var string[]
     */
    protected $headers = []

    /**
     * A copy of the last response returned by the API
     *
     * @var \stdClass
     */
    protected $response = null;



    /**
     * Set the base URL for all live entpoints
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return $this
     */
    public function setBaseUrl(string $value) : Client
    {
        // Remove any trailing slashes
        $value = rtrim($value, '/');

        // Set the new value
        $this->baseUrl = $value;

        // Return the result
        return $this;
    }


    /**
     * Set the base URL for all sandbox entpoints
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return $this
     */
    public function setSandboxBaseUrl(string $value) : Client
    {
        // Remove any trailing slashes
        $value = rtrim($value, '/');

        // Set the new value
        $this->sanboxBaseUrl = $value;

        // Return the result
        return $this;
    }


    /**
     * Set whether to operate in sandbox mode
     * -------------------------------------------------------------------------
     * @param   bool  $value  The new value
     *
     * @return $this
     */
    public function setSandboxMode(bool $value) : Client
    {
        // Set the new value
        $this->sandboxMode = $value;

        // Return the result
        return $this;
    }


    /**
     * Set the client id/username for API authentication
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return $this
     */
    public function setClientId(string $value) : Client
    {
        // Set the new value
        $this->clientId = $value;

        // Return the result
        return $this;
    }


    /**
     * Set the client secret/password for API authentication
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return $this
     */
    public function setClientSecret(string $value) : Client
    {
        // Set the new value
        $this->clientSecret = $value;

        // Return the result
        return $this;
    }


    /**
     * Set the maximum number of seconds for an API request to complete
     * -------------------------------------------------------------------------
     * @param   int $value  The new value
     *
     * @return $this
     */
    public function setTimeout(int $value) : Client
    {
        // Set the new value
        $this->timeout = $value;

        // Return the result
        return $this;
    }


    /**
     * Set whether to verify the API's SSL certificate or not
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
     * Set whether to allow redirects when sending an API request or not
     * -------------------------------------------------------------------------
     * @param   bool    $value  The new value
     *
     * @return  $this
     */
    public function setRedirects(bool $value) : Client
    {
        // Set the new value
        $this->redirects = $value;

        // Return the result
        return $this;
    }


    /**
     * Set the HTTP method to use for the next API request
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return  $this
     */
    public function setMethod(string $value) : Client
    {
        // If valid, set the new value. Otherwise raise a warning
        if (in_array(strtoupper($value), ['GET','POST','PUT','DELETE'])) {
            $this->method = $value;
        } else {
            trigger_error("Invalid HTTP Method", E_USER_WARNING);
        }

        // Return the result
        return $this;
    }


    /**
     * Set the endpoint url for the next API request. This URL can be
     * relative to $baseUrl or  $sanboxBaseUrl
     * -------------------------------------------------------------------------
     * @param   string  $value  The new value
     *
     * @return  $this
     */
    public function setEndpoint(string $value) : Client
    {
        // Remove any trailing slashes
        $value = rtrim($value, '/');

        // Set the new value
        $this->endpoint = $value;

        // Return the result
        return $this;
    }


    /**
     * Set all HTTP parameters to send with the next API request
     * -------------------------------------------------------------------------
     * @param   mixed   $value  Object/assoc array containing params and values
     *
     * @return  $this
     */
    public function setParams(mixed $value) : Client
    {
        // Make sure the value is an array
        $value = (array) $value;

        // Set the new value
        $this->params = $value;

        // Return the result
        return $this;
    }


    /**
     * Set/add a single HTTP parameter to send with the next API request
     * -------------------------------------------------------------------------
     * @param  string       $name       The name of the parameter
     * @param  string|int   $value      A valur for the parameter
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
     * Set all extra HTTP headers to send with the next API request
     * -------------------------------------------------------------------------
     * @param   string[]   $value   An assoc array of header => value
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
     * Set/add a single extra HTTP headers to send with the next API request
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
     * Set the last response returned by the API
     * -------------------------------------------------------------------------
     * @param   mixed   $value  A new value
     *
     * @return $this
     */
    protected function setResponse($value) : Client
    {
        // Set the new value
        $this->response = $value;

        // Return the result
        return $this;
    }


    /**
     * Get the base URL for all live entpoints
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getBaseUrl() : string
    {
        // Return the result
        return $this->baseUrl;
    }


    /**
     * Get the base URL for all sandbox entpoints
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getSandboxBaseUrl() : string
    {
        // Return the result
        return $this->sanboxBaseUrl;
    }


    /**
     * Get whether to operate in sandbox mode
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function getSandboxMode() : bool
    {
        // Return the result
        return $this->sandboxMode;
    }


    /**
     * Get the client id/username for API authentication
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getClientId() : string
    {
        // Return the result
        return $this->clientId;
    }


    /**
     * Get the client secret/password for API authentication
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getClientSecret() : string
    {
        // Return the result
        return $this->setClientSecret;
    }


    /**
     * Get the maximum number of seconds for an API request to complete
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getTimeout() : int
    {
        // Return the result
        return $this->timeout;
    }


    /**
     * Get whether to verify the API's SSL certificate or not
     * -------------------------------------------------------------------------
     * @return  bool
     */
    public function getVerifySSL() : bool
    {
        // Return the result
        return $this->verifySSL;
    }


    /**
     * Get whether to allow redirects when sending an API request or not
     * -------------------------------------------------------------------------
     * @return  bool
     */
    public function getRedirects() : bool
    {
        // Return the result
        return $this->redirects;
    }


    /**
     * Get the HTTP method to use for the next API request
     * -------------------------------------------------------------------------
     * @return  string
     */
    public function getMethod() : string
    {
        // Return the result
        return $this->method;
    }


    /**
     * Get the endpoint url for the next API request.
     * -------------------------------------------------------------------------
     * @return  string
     */
    public function getEndpoint() : string
    {
        // Return the result
        return $this->endpoint;
    }


    /**
     * Get all HTTP parameters to send with the next API request
     * -------------------------------------------------------------------------
     * @return  mixed[]
     */
    public function getParams() : array
    {
        // Return the result
        return $this->params;
    }


    /**
     * Get a single HTTP parameter to send with the next API request
     * -------------------------------------------------------------------------
     * @param  string   $name       The name of the parameter
     * @param  mixed    $default    Default value in case param doesn't exist
     *
     * @return  mixed
     */
    public function getParam(string $name, $default = null) : mixed
    {
        // Return the result
        return $this->params[$name] ?? $default;
    }


    /**
     * Get all extra HTTP headers to send with the next API request
     * -------------------------------------------------------------------------
     * @return  string[]
     */
    public function getHeaders() : array
    {
        // Return the result
        return $this->headers;
    }


    /**
     * Get a single extra HTTP headers to send with the next API request
     * -------------------------------------------------------------------------
     * @param  string   $name       The HTTP header name
     * @param  mixed    $default    Default value in case header doesn't exist
     *
     * @return  mixed
     */
    public function getHeader(string $name, $default = null) : mixed
    {
        // Return the result
        return $this->headers[$name] ?? $default;
    }


    /**
     * Get the last response returned by the API
     * -------------------------------------------------------------------------
     * @return mixed
     */
    public function getResponse() : mixed
    {
        // Return the result
        return $this->response;
    }


    /**
     * Execute an API request
     * -------------------------------------------------------------------------
     * @return mixed    API payload on success, False on failure
     */
    public function execute()
    {
        // Initilise some local variables
        $clientId     = $this->getClientId();
        $clientSecret = $this->getClientSecret();
        $timeout      = $this->getTimeout();
        $verifySSL    = $this->getVerifySSL();
        $redirects    = $this->getRedirects();
        $method       = $this->getMethod();
        $endpoint     = $this->getEndpoint();
        $params       = $this->getParams();
        $headers      = $this->getHeaders();

        // Get the appropriate base URL
        $baseUrl = ($this->getSandboxMode()) ?
            $this->getSandboxBaseUrl() : $this->getBaseUrl();

        // Initilise a guzzle http client
        $httpClient = new \GuzzleHttp\Client([
            'base_uri'        => $baseUrl,
            'allow_redirects' => $redirects,
            'auth'            => [$clientId, $clientSecret],
            'headers'         => $headers,
            'verify'          => $verifySSL,
            'timeout'         => $timeout
        ]);

        // Send the API request
        if (strtoupper($method) == 'GET'){
            $response = $httpClient->request($method,
                $endpoint, ['query' => $params]);
        } else {
            $response = $httpClient->request($method,
                $endpoint, ['form_params' => $params]);
        }

        // Store the response
        $this->setResponse($response);

        // If the request was successful decode the payload. Otherwise
        // return FALSE to indicate the failure
        if ($response->getStatusCode() == 200) {
            $result = json_decode((string) $response->getBody());
        } else {
            $result = false;
        }

        // Return the final result.
        return $result;
    }


}
