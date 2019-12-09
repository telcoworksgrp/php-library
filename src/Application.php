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

use \TCorp\WebApi\Client AS WebApiClient;
use \TCorp\T3\Client AS T3Client;
use \TCorp\Agent\Agent;
use \TCorp\Input\Input;
use \TCorp\Config\Config;
use \TCorp\Firewall\Firewall;
use \TCorp\Email\Email;
use \TCorp\Session\Session;
use \TCorp\Response\Response;



/**
 * Class for ecapsulating a website application. This includes various
 * factory methods for getting global objects
 */
class Application
{

    /**
     * Holds the global agent object
     *
     * @var \TCorp\Agent
     */
    protected static $agent = null;


    /**
     * Holds the global configuration object
     *
     * @var \TCorp\Config\Config
     */
    protected static $config = null;


    /**
     * Holds the global firewall object
     *
     * @var \TCorp\Firewall\Firewall
     */
    protected static $firewall = null;


    /**
     * Holds the global input object
     *
     * @var \TCorp\Input\Input
     */
    protected static $input = null;


    /**
     * Holds the global response object
     *
     * @var \TCorp\Response
     */
    protected static $response = null;


    /**
     * Holds the global sanitiser object
     *
     * @var \TCorp\Sanitiser
     */
    protected static $sanitiser = null;


    /**
     * Holds the global session object
     *
     * @var \TCorp\Session
     */
    protected static $session = null;


    /**
     * Holds the global t3 api object
     *
     * @var \TCorp\T3Api
     */
    protected static $t3api = null;


    /**
     * Holds the global web api object
     *
     * @var \TCorp\WebApi
     */
    protected static $webapi = null;


    /**
     * Gets a global agent object, creating it if necessary
     * -------------------------------------------------------------------------
     * @return \TCorp\Agent\Agent
     */
    public static function getAgent()
    {
        if (is_null(static::$agent)) {
            static::$agent = new Agent();
        }

        return static::$agent;
    }


    /**
     * Gets a global configuration object, creating it if necessary
     * -------------------------------------------------------------------------
     * @return \TCorp\Config\Config
     */
    public static function getConfig()
    {
        if (is_null(static::$config)) {
            static::$config = new Config();
        }

        return static::$config;
    }


    /**
     * Gets a new email object
     * -------------------------------------------------------------------------
     * @return \TCorp\Email
     */
    public static function getEmail()
    {
        return new Email();
    }


    /**
     * Gets a global firewall object, creating it if necessary
     * -------------------------------------------------------------------------
     * @return \TCorp\Firewall
     */
    public static function getFirewall()
    {
        if (is_null(static::$firewall)) {
            static::$firewall = new Firewall();
        }

        return static::$firewall;
    }


    /**
     * Gets a global input object, creating it if necessary
     * -------------------------------------------------------------------------
     * @return \TCorp\Input\Input
     */
    public static function getInput()
    {
        if (is_null(static::$input)) {
            static::$input = new Input();
        }

        return static::$input;
    }


    /**
     * Gets a global response object, creating it if necessary
     * -------------------------------------------------------------------------
     * @return \TCorp\Response
     */
    public static function getResponse()
    {
        if (is_null(static::$response)) {
            static::$response = new Response();
        }

        return static::$response;
    }


    /**
     * Gets a global sanitiser object, creating it if necessary
     * -------------------------------------------------------------------------
     * @return \TCorp\Sanitiser
     */
    public static function getSanitiser()
    {
        if (is_null(static::$sanitiser)) {
            static::$sanitiser = new Sanitiser();
        }

        return static::$sanitiser;
    }


    /**
     * Gets a global session object, creating it if necessary
     * -------------------------------------------------------------------------
     * @return \TCorp\Session
     */
    public static function getSession()
    {
        if (is_null(static::$session)) {
            static::$session = new Session();
        }

        return static::$session;
    }


    /**
     * Gets a global T3 api object, creating it if necessary
     * -------------------------------------------------------------------------
     * @return \TCorp\T3\Client
     */
    public static function getT3ApiClient()
    {
        if (is_null(static::$t3api)) {
            static::t3bapi = new T3Client();
        }

        return static::$t3api;
    }


    /**
     * Gets a global web api object, creating it if necessary
     * -------------------------------------------------------------------------
     * @return \TCorp\WebApi\Client
     */
    public static function getWebApiClient()
    {
        if (is_null(static::$webapi)) {
            static::$webapi = new WebApiClient();
        }

        return static::$webapi;
    }

}
