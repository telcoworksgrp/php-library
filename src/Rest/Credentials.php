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
 * Class containing all the credentials a REST client needs to authenticate
 *
 * @todo Add support for OAuth
 */
class Credentials
{

    /**
     * An API key for API authorisation
     *
     * @var string
     */
    protected $apiKey = '';


    /**
     * Name of the HTTP parameter to use when providing
     * the API key
     *
     * @var string
     */
    protected $apiKeyName = 'key';



    /**
     * Set the API key for API authorisation
     * -------------------------------------------------------------------------
     * @param  string      $value   A new value
     *
     * @return Credentials
     */
    public function setApiKey(string $value) : Credentials
    {
        $this->apiKey = trim($value);
        return $this;
    }


    /**
     * Get the API key for API authorisation
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getApiKey() : string
    {
        return $this->apiKey;
    }


    /**
     * Set the name of the HTTP parameter to use when providing the api key
     * -------------------------------------------------------------------------
     * @param  string      $value   A HTTP param name
     *
     * @return Credentials
     */
    public function setApiKeyname(string $value) : Credentials
    {
        $this->apiKeyName = trim($value);
        return $this;
    }


    /**
     * Get the name of the HTTP parameter to use when providing the api key
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getApiKeyName() : string
    {
        return $this->apiKeyName;
    }

}
