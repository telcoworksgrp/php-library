<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Legacy;


/**
 * Factory class for working with Telecom Corp's Legacy sites/projects
 */
class Factory
{

    /**
     * Holds a global configuration object
     *
     * @var \TCorp\Legacy\Config
     */
    protected static $config   = null;



    /**
     * Holds a global email object
     *
     * @var \TCorp\Legacy\Email
     */
    protected static $email    = null;



    /**
     * Halds a global firewall object
     *
     * @var \TCorp\Legacy\Firewall
     */
    protected static $firewall = null;



    /**
     * Holds alist of forms
     *
     * @var \TCorp\Legacy\Form[]
     */
    protected static $forms    = [];



    /**
     * Holds a global input object
     *
     * @var \TCorp\Legacy\Input
     */
    protected static $input    = null;



    /**
     * Holds a global request object
     *
     * @var \TCorp\Legacy\Request
     */
    protected static $request  = null;



    /**
     * Holds a global session object
     *
     * @var \TCorp\Legacy\Session
     */
    protected static $session  = null;



    /**
     * Holds a gloabl T3Api object
     *
     * @var \TCorp\Legacy\T3Api
     */
    protected static $t3api    = null;



    /**
     * Holds a global WebApi object
     *
     * @var \TCorp\Legacy\WebApi
     */
    protected static $webapi   = null;



    /**
     * Holds a global debugger object
     *
     * @var \TCorp\Legacy\Debugger
     */
    protected static $debugger   = null;




    /**
     * Get the global configuration object
     * -------------------------------------------------------------------------
     * @return Config
     */
    public static function getConfig() : Config
    {
        if (!static::$config) {
            static::$config = new Config();
        }

        return static::$config;
    }



    /**
     * Get the global email object
     * -------------------------------------------------------------------------
     * @return Email
     */
    public static function getEmail() : Email
    {
        if (!static::$email) {
            static::$email = new Email();
        }

        return static::$email;
    }



    /**
     * Get the global firewall object
     * -------------------------------------------------------------------------
     * @return Firewall
     */
    public static function getFirewall() : Firewall
    {
        if (!static::$firewall) {
            static::$firewall = new Firewall();
        }

        return static::$firewall;
    }



    /**
     * Get the global instance of a named form
     * -------------------------------------------------------------------------
     * @param  string   $name   Name of the form to get/create
     *
     * @return Form
     */
    public static function getForm(string $name) : Form
    {
        if (!static::$forms[$name]) {
            static::$forms[$name] = new Form();
        }

        return static::$forms[$name];
    }



    /**
     * Get the gloabl input object
     * -------------------------------------------------------------------------
     * @return Input
     */
    public static function getInput() : Input
    {
        if (!static::$input) {
            static::$input = new Input();
        }

        return static::$input;
    }



    /**
     * Get the global request instance
     * -------------------------------------------------------------------------
     * @return Request
     */
    public static function getRequest() : Request
    {
        if (!static::$request) {
            static::$request = new Request();
        }

        return static::$request;
    }



    /**
     * Get the global session object
     * -------------------------------------------------------------------------
     * @return Session
     */
    public static function getSession() : Session
    {
        if (!static::$session) {
            static::$session = new Session();
        }

        return static::$session;
    }



    /**
     * Get the global T3 Api object
     * -------------------------------------------------------------------------
     * @return T3Api
     */
    public static function getT3Api() : T3Api
    {
        if (!static::$t3api) {
            static::$t3api = new T3Api();
        }

        return static::$t3api;
    }



    /**
     * Get the global Web Api object
     * -------------------------------------------------------------------------
     * @return WebApi
     */
    public static function getWebApi() : WebApi
    {
        if (!static::$webapi) {
            static::$webapi = new WebApi();
        }

        return static::$webapi;
    }



    /**
     * Get the global debugger object
     * -------------------------------------------------------------------------
     * @return Debugger
     */
    public static function getDebugger() : Debugger
    {
        if (!static::$debugger) {
            static::$debugger = new Debugger();
        }

        return static::$debugger;
    }




    /**
     * Redirect the user's browser to another URL, preserving the current
     * URL parameters.
     * -------------------------------------------------------------------------
     * @param  string   $url             URL to redirect the user to
     * @param  bool     $preserveParams  Pass existing URL params to the redirect
     * @param  int      $statusCode      HTTP status code (usually 301 or 303)
     *
     * @return  void
     */
    public static function redirect(string $url, bool $preserveParams = TRUE,
        int $statusCode = 301) : void
    {
        \KWS\Utils::redirect($url, $preserveParams, $statusCode);
    }


    /**
     * Disable browser caching of this request
     * -------------------------------------------------------------------------
     * @return  void
     */
    public static function disableCache() : void
    {
        \KWS\Utils::disableCache();
    }


    /**
     * Render a hidden input field for each POST variable. Not a good
     * practice but needed to avoid breaking some of Telecom Corp's
     * legacy websites
     * -------------------------------------------------------------------------
     * @return string   Rendered HTML
     */
    public static function renderPostParamsAsHiddenFields()
    {
        // Initialise some local variables
        $result = '';

        // Render a hidden input field for each POST variable
        foreach ($_POST as $key => $value) {
            $key     = htmlentities($key);
            $value   = htmlentities($value);
            $result .= "<input type=hidden name=$key value=\"$value\">\n";
        }

        // Return the result
        return $result;
    }

}
