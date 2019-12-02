<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp;



/**
 * A basic client for sending API requests to Telecom Corporates T3 system
 */
class T3Api
{


    /**
     * Base uri for all endpoints
     *
     * @var string;
     */
    protected $baseUri = "https://portal.tbill.live/numbers-service-impl/api";


    /**
     * Endpoint Uri (relative to the Base Uri)
     *
     * @var string
     */
    protected $endpoint = "";


    /**
     * HTTP method to use when sending the request
     *
     * @var string
     */
    protected $method = 'GET';


    /**
     * Parameters to send with the request
     *
     * @var string[]
     */
    protected $params = [];


    /**
     * Username for basic HTTP authentication
     *
     * @var string
     */
    protected $username = '';


    /**
     * Password for HTTP authentication
     *
     * @var string
     */
    protected $password = '';



    /**
     * Get the base uri for all endpoints
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getBaseUri() : string
    {
        return $this->baseUri;
    }


    /**
     * Get the current endpoint uri (relative to the base uri)
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getEndpoint() : string
    {
        return $this->endpoint;
    }


    /**
     * Get the HTTP method to use when sending the request
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getMethod() : string
    {
        return $this->method;
    }


    /**
     * Get the parameters to send with the request
     * -------------------------------------------------------------------------
     * @return string[]
     */
    public function getParams()
    {
        return $this->params;
    }


    /**
     * Get a single parameters to be sent with the request
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the param
     * @param  mixed    $default    Value to return if param is not found
     *
     * @return string
     */
    public function getParam(string $name, $default = null) : string
    {
        return $this->params[$name] ?? $default;
    }


    /**
     * Get the username for basic HTTP authentication
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getUsername() : string
    {
        return $this->username;
    }


    /**
     * Get the password for basic HTTP authentication
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getPassword() : string
    {
        return $this->password;
    }


    /**
     * Set the base uri for all endpoint
     * -------------------------------------------------------------------------
     * @param  string   $value  A new asbolute base uri
     *
     * @return T3Api
     */
    public function setBaseUri(string $value) : T3Api
    {
        $this->baseUri = $value;
        return $this;
    }


    /**
     * Get the current endpoint uri (relative to the base uri)
     * -------------------------------------------------------------------------
     * @param  string   $value  A new relative enpoint uri
     *
     * @return T3Api
     */
    public function setEndpoint(string $value) : T3Api
    {
        $this->endpoint = $value;
        return $this;
    }



    /**
     * Get the HTTP method to use when sending the request
     * -------------------------------------------------------------------------
     * @param  string   $value  A HTTP method (eg: GET,POST,PUT,PATCH,DELETE)
     *
     * @return T3Api
     */
    public function setMethod(string $value) : T3Api
    {
        $this->method = strtoupper($value);
        return $this;
    }


    /**
     * Get the parameters to send with the request
     * -------------------------------------------------------------------------
     * @param  string[]     $value  Assoc array of parameters
     *
     * @return T3Api
     */
    public function setParams($value) : T3Api
    {
        $this->params = $value;
        return $this;
    }


    /**
     * Get a single parameters to be sent with the request
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the parameter
     * @param  mixed    $value      A value for the parameter
     * @param  bool     $array      Treat parameter as an array of values
     *
     * @return T3Api
     */
    public function setParam(string $name, $value, bool $array = false) : T3Api
    {
        if ($array) {
            $this->params[$name]   = (array) $this->getParam($name, []);
            $this->params[$name][] = $value;
        } else {
            $this->params[$name] = $value;
        }

        return $this;
    }


    /**
     * Get the username for basic HTTP authentication
     * -------------------------------------------------------------------------
     * @param  string   $value  A new username
     *
     * @return T3Api
     */
    public function setUsername(string $value) : T3Api
    {
        $this->username = $value;
        return $this;
    }


    /**
     * Get the password for basic HTTP authentication
     * -------------------------------------------------------------------------
     * @param  string   $value  A new password
     *
     * @return T3Api
     */
    public function setPassword(string $value) : T3Api
    {
        $this->password = $value;
        return $this;
    }


    /**
     * Send an API request and return the result
     * -------------------------------------------------------------------------
     * @return stdClass
     */
    public function execute()
    {
        // Initialise some local variables
        $baseUri  = $this->getBaseUri();
        $endpoint = $this->getEndpoint();
        $method   = $this->getMethod();
        $username = $this->getUsername();
        $password = $this->getPassword();
        $params   = $this->getParams();

        // Send the api request and the result
        $client  = new \GuzzleHttp\Client(['base_uri' => $baseUri]);
        $result  = $client->request($method, $endpoint, [
            'auth'  => [$username, $password],
            'query' => $params
        ]);

        // Decode JSON response
        $result = json_decode($result->getBody());

        // Return the result
        return $result;
    }





    /**
     * Get a list of numbers from the T3 API
     * -------------------------------------------------------------------------
     * @param  string   $prefix     Numbe prefix ('1300' or '1800')
     * @param  string   $type       Type of numbers to get ('FLASH' or 'LUCKYDIP')
     * @param  int      $minPrice   Minimum number price
     * @param  int      $maxPrice   Max number price
     * @param  int      $pageNo     Page to start at
     * @param  int      $pageSize   Max numbers per page
     * @param  string   $sortBy     Column to sort the results by
     * @param  string   $direction  Direction to sort the results by
     *
     * @return  object[]    A list of numbers with meta data
     */
    public function getNumbers($prefix = '1300', $type = 'FLASH',
        $minPrice = 0, $maxPrice = 1000, $pageNo = 1, $pageSize = 500,
        $sortBy = 'PRICE', $direction = 'ASCENDING')
    {

        // Compose an enpoint URL
        $params                       = array();
        $params['query']              = $prefix;
        $params['numberTypes']        = 'SERVICE_NUMBER';
        $params['serviceNumberTypes'] = $type;
        $params['minPriceDollars']    = $minPrice;
        $params['maxPriceDollars']    = $maxPrice;
        $params['pageNum']            = $pageNo;
        $params['pageSize']           = $pageSize;
        $params['sortBy']             = $sortBy;
        $params['sortDirection']      = $direction;


        // Get the data from the API
        $result = Utils::sendRequest(
            'https://portal.tbill.live/numbers-service-impl/api/Activations',
            'GET', $params, array('Content-type: application/json'));

        // Decode JSON response
        $result = json_decode($result);

        // Add additional meta data
        foreach($result as $number) {
            $number->format1 = preg_replace('|^(\d{4})(\d{6})$|i', '$1 $2', $number->number);
            $number->format2 = preg_replace('|^(\d{4})(\d{3})(\d{3})$|i', '$1 $2 $3', $number->number);
            $number->format3 = preg_replace('|^(\d{4})(\d{2})(\d{2})(\d{2})$|i', '$1 $2 $3 $4', $number->number);
            $number->format4 = (!empty($number->word) ? $number->word : $number->format3);
        }

        // Return the result
        return $result;
    }


    /**
     * Get all numbers available from the T3 Api
     * -------------------------------------------------------------------------
     * @return \stdClass[]
     */
    public function getAllNumbers()
    {
        // Get the list of numbers
        $result = $this->getNumbers('1300', 'FLASH', 0, 1000, 1, 1000);
        $result = array_merge($result, $this->getNumbers('1800', 'FLASH', 0, 1000, 1, 1000));
        $result = array_merge($result, $this->getNumbers('1300', 'LUCKY_DIP', 0, 1000, 1, 1000));
        $result = array_merge($result, $this->getNumbers('1800', 'LUCKY_DIP', 0, 1000, 1, 1000));

        // Return the result
        return $result;
    }

}
