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

use TCorp\Registry\Registry;


/**
 * Class for working with session data
 */
class Session
{

    /**
     * Starts a session if not already started
     * -------------------------------------------------------------------------
     * @return void
     */
    public function start()
    {
        if (!$this->active()) {
            session_start();
            $_SESSION['session'] = new Registry();
        }
    }


    /**
     * Checks if a session has already being started
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function active()
    {
        return !session_status() == PHP_SESSION_NONE;
    }


    /**
     * Get the value of a given key from the current session
     * -------------------------------------------------------------------------
     * @param  string   $key        Dot seperated key associated with the value
     * @param  mixed    $default    Value to return if key is not found
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $_SESSION['session']->get($key, $default);
    }


    /**
     * Set the value for a given key in the current session
     * -------------------------------------------------------------------------
     * @param string    $key    Dot seperated key associated with the value
     * @param mixed     $value  The new value
     *
     * @return void
     */
    public function set(string $key, $value)
    {
        $_SESSION['session']->set($key, $value);
    }


    /**
     * Check if a value for a given key exists
     * -------------------------------------------------------------------------
     * @param  string   $key    Dot seperated key associated with the value
     *
     * @return bool
     */
    public function exists(string $key) : bool
    {
        return $_SESSION['session']->exists($key);
    }


    /**
     * Unset/remove a given key and value from the session
     * -------------------------------------------------------------------------
     * @param string    $key    Dot seperated key associated with the value
     *
     * @return void
     */
    public function unset(string $key)
    {
        $_SESSION['session']->remove($key);
    }


    /**
     * Clear all session data
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clear()
    {
        $_SESSION['session']->reset();
    }

}
