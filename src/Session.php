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
 * Class for managing the current session
 */
class Session
{


    /**
     * Start a new session and initialise session data
     * -------------------------------------------------------------------------
     * @return void
     */
    public function start()
    {
        // Start the PHP session if it hasn't already.
        if (!$this->active()) {
            session_start();
        }

        // Initialise a container for all the session data
        if (!isset($_SESSION['data'])) {
            $_SESSION['data'] = new Registry();
        }
    }


    /**
     * Check if a session is currently active
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function active() : bool
    {
        return session_status() == PHP_SESSION_ACTIVE;
    }

    /**
     * Set a value for given key in the current session
     * -------------------------------------------------------------------------
     * @param string    $key    Dot seperated key name
     * @param mixed     value   Value to set
     *
     * @return void
     */
    public function set(string $key, $value)
    {
        $_SESSION['data']->set($key, $value);
    }


    /**
     * Get the value for given key in the current session
     * -------------------------------------------------------------------------
     * @param string    $key        Dot seperated key name
     * @param mixed     $default    Value to return if the key is not found
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $_SESSION['data']->get($key, $default);
    }


    /**
     * Delete a key and value from the current session
     * -------------------------------------------------------------------------
     * @param  string   $key  Dot seperated key name
     *
     * @return void
     */
    public function delete(string $key)
    {
        $_SESSION['data']->remove($key);
    }


    /**
     * Clear all data managed my this class
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clear()
    {
        $_SESSION['data']->reset();
    }


    /**
     * Check if a value for the given key exists
     * -------------------------------------------------------------------------
     * @param  string   $key    Dot seperated key name
     *
     * @return bool
     */
    public function exists(string $key) : bool
    {
        return $_SESSION['data']->exists($key);
    }

}
