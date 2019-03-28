<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */


namespace TCorp\T3\Api;



class Client
{

    /**
     * Base URL for the live API
     *
     * @var string
     */
    protected $baseUrl = 'https://portal.tbill.live/';


    /**
     * Base URL for the Sandbox API
     *
     * @var string
     */
    protected $sandboxUrl = 'https://portal.tbill.live/';


    /**
     * Use the API in sanbox mode
     *
     * @var bool
     */
    protected $sandBoxMode = false;


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
     * Affilate id for identifing affilates
     *
     * @var string
     */
    protected $affilateId = '';


    /**
     * A request to send to the API
     *
     * @var Request
     */
    protected $request = null;


    /**
     * The last response from the API
     *
     * @var Response
     */
    protected $response = null;



    /**
     * Get base URL for the live API
     * -------------------------------------------------------------------------
     * @return  string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }


    /**
     * Set the base URL for the live API
     * -------------------------------------------------------------------------
     * @param   string  $value  A new value
     */
    public function setBaseUrl(string $value)
    {
        $this->baseUrl = $value;
    }


    /**
     * Get the base URL for the Sandbox API
     * -------------------------------------------------------------------------
     * @return  string
     */
    public function getSandboxUrl()
    {
        return $this->sandboxUrl;
    }


    /**
     * Set the base URL for the Sandbox API
     * -------------------------------------------------------------------------
     * @param   string  $value  A new value
     */
    public function setSandboxUrl(string $value)
    {
        $this->sandboxUrl = $value;
    }


    /**
     * Get if the client is set to operate in sandbox mode or not
     * -------------------------------------------------------------------------
     * @return  bool
     */
    public function getSandBoxMode()
    {
        return $this->sandBoxMode;
    }


    /**
     * Set wether the client should operate in sandbox mode or not
     * -------------------------------------------------------------------------
     * @param   bool    $value  A new value
     */
    public function setSandBoxMode(bool $value)
    {
        $this->sandBoxMode = $value;
    }


    /**
     * Get the username for API authentication
     * -------------------------------------------------------------------------
     * @return  string
     */
    public function getUsername()
    {
        return $this->username;
    }


    /**
     * Set the username for API authentication
     * -------------------------------------------------------------------------
     * @param   string  $value  A new value
     */
    public function setUsername($value)
    {
        $this->username = $value;
    }


    /**
     * Get the password for API authentication
     * -------------------------------------------------------------------------
     * @return  string
     */
    public function getPassword()
    {
        return $this->password;
    }


    /**
     * Set the password for API authentication
     * -------------------------------------------------------------------------
     * @param   string  $value  A new value
     */
    public function setPassword($value)
    {
        $this->password = $value;
    }


    /**
     * Get the affilate id that will sent to the API
     * -------------------------------------------------------------------------
     * @return  string
     */
    public function getAffilateId()
    {
        return $this->affilateId;
    }


    /**
     * Set the affilate id that will sent to the API
     * -------------------------------------------------------------------------
     * @param   string  $value  A new value
     */
    public function setAffilateId($value)
    {
        $this->affilateId = $value;
    }


    /**
     * Get the request that will sent to the API
     * -------------------------------------------------------------------------
     * @return  Request
     */
    public function getRequest()
    {
        return $this->request;
    }


    /**
     * Set the request that will sent to the API
     * -------------------------------------------------------------------------
     * @param   Request   $value  A new value
     *
     * @return self
     */
    public function setRequest(Request $value)
    {
        $this->request = $value;
    }


    /**
     * Get the last response from the API
     * -------------------------------------------------------------------------
     * @return  Response
     */
    public function getResponse()
    {
        return $this->response;
    }


    /**
     * Send the currently set request
     * -------------------------------------------------------------------------
     */
    public function sendRequest()
    {

        // Initialise a HTTP client
        $httpClient = new \GuzzleHttp\Client([
            'base_uri'         => $this->baseUrl . '/' . $this->request->getAction(),
            'allow_redirects'  => true,
            'auth'             => [$this->username, $this->password],
            'timeout'          => 5,
            'decode_content'   => true,
            'force_ip_resolve' => 'v4',
            'query'            => $this->request->getParam(),
            'headers'          => array('User-Agent' => 'TCorp PHP Library'),
            'verify'           => false,
        ]);

        $response = $httpClient->request('GET');

        // Compose the result
        $result             = new Response();
        $result->statusCode = $response->getStatusCode();
        $result->statusStr  = $response->getReasonPhrase();
        $result->headers    = $response->getHeaders();
        $result->body       = $response->getBody()->getContents();
        $result->body       = json_decode($result->body);

        // Return the result
        return $result;
    }


}
