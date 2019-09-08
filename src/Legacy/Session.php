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
     * Start a new session or resume and existing one
     * -------------------------------------------------------------------------
     * @return mixed
     */
    public function start()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['registry'])) {
            $_SESSION['registry'] = new Registry();
        }

    }


    /**
     * Get a session value
     * -------------------------------------------------------------------------
     * @param  string   $key      Key/name of the session value to get
     * @param  mixed    $default  Value to return if no value is found
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $_SESSION['registry']->get($key, $default);
    }


    /**
     * Set a session value
     * -------------------------------------------------------------------------
     * @param string    $key       Key/name of the session value to set
     * @param mixed     $value     Value to set the session value to
     *
     * @return void
     */
    public function set(string $key, $value)
    {
        $_SESSION['registry']->set($key, $value);
    }


    /**
     * Check if a session value exists
     * -------------------------------------------------------------------------
     * @param string    $key       Key/name of the session value to check
     *
     * @return bool
     */
    public function exists(string $key) : bool
    {
        return $_SESSION['registry']->exists($key);
    }


    /**
     * Remove all session values (managed by this object)
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clear()
    {
        $_SESSION['registry']->reset();
    }

}
