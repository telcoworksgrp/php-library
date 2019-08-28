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


class Session
{


    /**
     * Start a new session if none has already been started
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function start() : void
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }


    /**
     * Sets a session variable to a given value
     * -------------------------------------------------------------------------
     * @param string    $key    Name of the session variable
     * @param mixed     $value  New value for the session variable
     *
     * @return void
     */
    public static function setValue(string $key, $value) : void
    {
        $_SESSION[$key] = $value;
    }


    /**
     * Get a the value of a given session variable
     * -------------------------------------------------------------------------
     * @param  string   $key        Name of the session variable
     * @param  mixed    $default    A default value in case none exists.
     *
     * @return mixed    The value of the session variable, or the default value
     */
    public static function getValue(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }

}
