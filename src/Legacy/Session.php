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



/**
 * Legacy helper class for working with current session
 */
class Session
{

    /**
     * Start the user's session if not already started
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function start()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }


    /**
     * Get a value previously stored in the user's session. If a value with
     * the given key can not be found then a default can be returned
     * -------------------------------------------------------------------------
     * @param  string $key      A key name for referancing the stored value
     * @param  mixed  $default  A default value if the key doesn't exist
     *
     * @return mixed    A value for the given key, or the default value
     */
    public static function get(string $key, $default = null)
    {
        return $_SESSION[$key] ?? $default;
    }


    /**
     * Set a value in the user's session
     * -------------------------------------------------------------------------
     * @param string    $key    A key name for referancing the stored value
     * @param mixed     $value  The value to store
     */
    public static function set(string $key, $value)
    {
        // Set a session variable with the given value
        $_SESSION[$key] = $value;
    }

    /**
     * Unsets/removes an existing session variable
     * -------------------------------------------------------------------------
     * @param string    $key    A key name for referancing the stored value
     *
     * @return  mixed   The former value of the session var
     */
    public static function unset(string $key)
    {
        $result = static::get($key);
        unset($_SESSION[$key]);
        return $result;
    }


    /**
     * Store the value of a request variable in a session var. If the request
     * var doesn't exist then preserve the existing session var. If a session
     * var with the given key doesn't exist then set a session var with the
     * given key to a given default value.
     * -------------------------------------------------------------------------
     * @param string    $key        A key name for referancing the stored value
     * @param string    $var        A GET/POST variable name
     * @param string    $default    Default value if both request and session
     *                              var doesn't exist
     * @param string    $filter     Filter Type (for sanitisation)
     *
     * @return  mixed   The final value of session var
     */
    public static function setFromRequest(string $key, string $var,
        $default = '', string $filter = 'STRING')
    {
        if (isset($_REQUEST[$var])) {
            static::set($key, $_REQUEST[$var]);
        } else {
            if (!isset($_SESSION[$key])) {
                static::set($key, $default);
            }
        }

        // Return the result
        return static::get($key);
    }

}
