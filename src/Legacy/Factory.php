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


use \TCorp\Legacy\Config\Config;
use \TCorp\Legacy\Input\Input;



/**
 * Factory class
 */
class Factory
{


    /**
     * Global configuration object
     *
     * @var \TCorp\Legacy\Config\Config
     */
    protected static $config = null;



    /**
     * Global input object
     *
     * @var \TCorp\Legacy\Input\Input
     */
    protected static $input = null;




    /**
     * Get the global configuration object, creating it if it doesn't
     * already exist
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Config\Config
     */
    public static function getConfig()
    {
        if (!static::$config) {
            static::$config = new Input();
        }

        return static::$config;
    }


    /**
     * Get the global input object, creating it if it doesn't already exist
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Input\Input
     */
    public static function getInput()
    {
        if (!static::$input) {
            static::$input = new Input();
        }

        return static::$input;
    }



}
