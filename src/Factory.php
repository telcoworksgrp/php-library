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
 * Factory class for creating and/or getting global class instances
 */
class Factory
{

    /**
     * Holds the global input object
     *
     * @var \TCorp\Input
     */
    protected static $input = null;


    /**
     * Holds the global session object
     *
     * @var \TCorp\Session
     */
    protected static $session = null;


    /**
     * Holds the global sanitiser object
     *
     * @var \TCorp\Sanitiser
     */
    protected static $sanitiser = null;


    /**
     * Holds the global web api object
     *
     * @var \TCorp\WebApi
     */
    protected static $webapi = null;



    /**
     * Gets a global input object, creating it if necessary
     * -------------------------------------------------------------------------
     * @return \TCorp\Input
     */
    public static function getInput()
    {
        if (is_null(static::$input)) {
            static::$input = new Input();
        }

        return static::$input;
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
     * Gets a new email object
     * -------------------------------------------------------------------------
     * @return \TCorp\Email
     */
    public static function getEmail()
    {
        return new Email();
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
     * Gets a global web api object, creating it if necessary
     * -------------------------------------------------------------------------
     * @return \TCorp\WebApi
     */
    public static function getWebApiClient()
    {
        if (is_null(static::$webapi)) {
            static::$webapi = new WebApi();
        }

        return static::$webapi;
    }

}
