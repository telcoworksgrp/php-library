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

use \TCorp\Registry\Registry;


/**
 * Class for working with the current session
 */
class Session
{


    /**
     * Starts/resumes a PHP session
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function start()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['registry'])) {
            $_SESSION['registry'] = new Registry();
        }
    }


    /**
     * Get a value from the current session
     * -------------------------------------------------------------------------
     * @param  string   $key        A corrosponding key name
     * @param  mixed    $default    Value to return if not found
     *
     * @return mixed
     */
    public static function get(string $key, $default = null)
    {
        return $_SESSION['registry']->get($key, $default);
    }


    /**
     * Set a value in the current session
     * -------------------------------------------------------------------------
     * @param string    $key    A corrosponding key name
     * @param mixed     $value  The value to store in the session
     *
     * @return void
     */
    public static function set(string $key, $value)
    {
        $_SESSION['registry']->set($key, $value);
    }


    /**
     * Check if a value exists for a given key name in the current session
     * -------------------------------------------------------------------------
     * @param string    $key    The key name to check
     *
     * @return bool
     */
    public static function exists(string $key)
    {
        return $_SESSION['registry']->exists($key);
    }


    /**
     * Clear all data that is managed by this class
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function clear()
    {
        $_SESSION['registry']->reset();
    }


}
