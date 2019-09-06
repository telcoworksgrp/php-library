<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace \TCorp\Legacy;


use \TCorp\Legacy\Config\Config;



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
     * Get the global configuration object, creating it if it doesn't
     * already exist
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



}
