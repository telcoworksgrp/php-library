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
 * Factory class for creating new class instances / getting global objects
 */
class Factory
{

    /**
     * Holds the global configuration object
     *
     * @var \TCorp\Legacy\Config
     */
    protected static $config = null;


    /**
     * Holds the global firewall object
     *
     * @var \TCorp\Legacy\Firewall
     */
    protected static $firewall = null;


    /**
     * Holds the global debugger object
     *
     * @var \TCorp\Legacy\Debugger
     */
    protected static $debugger = null;


    /**
     * Holds the global session object
     *
     * @var \TCorp\Legacy\Session
     */
    protected static $session = null;


    /**
     * Get the global configuration object
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Config
     */
    public static function getConfig()
    {
        if (!static::$config) {
            static::$config = new Config();
        }

        return static::$config;
    }



    /**
     * Get the global firewall object
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Firewall
     */
    public static function getFirewall()
    {
        if (!static::$firewall) {
            static::$firewall = new Firewall();
        }

        return static::$firewall;
    }



    /**
     * Get the global debugger object
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Debugger
     */
    public static function getDebugger()
    {
        if (!static::$debugger) {
            static::$debugger = new Debugger();
        }

        return static::$debugger;
    }



    /**
     * Get the global session object
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Session
     */
    public static function getSession()
    {
        if (!static::$session) {
            static::$session = new Session();
        }

        return static::$session;
    }


}
