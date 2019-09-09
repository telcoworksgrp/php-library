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

use \KWS\Registry\Registry;



/**
 * Class to managing the current session
 */
class Session extends Registry
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
     * Store the value of a request variable in a session var. If the request
     * var doesn't exist then preserve the existing session var. If a session
     * var with the given key doesn't exist then set a session var with the
     * given key to a given default value.
     * -------------------------------------------------------------------------
     * @param string    $key        A key name for referancing the stored value
     * @param string    $var        A GET/POST variable name
     * @param string    $default    Default value if none can be found
     *
     * @return  mixed   The final value of session var
     */
    public function setFromRequest(string $key, string $var, $default = '')
    {
        if (isset($_REQUEST[$var])) {
            $this->set($key, $_REQUEST[$var]);
        } else {
            if (!isset($_SESSION[$key])) {
                $this->set($key, $default);
            }
        }

        // Return the result
        return $this->get($key);
    }

}
