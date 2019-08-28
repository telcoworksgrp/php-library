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

namespace TCorp\Legacy;


class Config
{


    /**
     * A list of configuration values
     *
     * @var mixed[]
     */
    protected static $config = [];


    /**
     * Set a configuration value
     * -------------------------------------------------------------------------
     * @param string    $key    Key to identify the configuration
     * @param mixed     $value  Value to set the configuration to
     *
     * @return void
     */
    public static function setValue(string $key, $value) : void
    {
        static::$config[$key] = $value;
    }


    /**
     * Get a configuration value
     * -------------------------------------------------------------------------
     * @param  string   $key        Key that identifies the configuration
     * @param  mixed    $default    A default value in no value exists
     *
     * @return mixed    A configuration value, or the given default value
     */
    public static function getValue(string $key, $default = null)
    {
        return static::$config[$key] ?? $default;
    }

}
