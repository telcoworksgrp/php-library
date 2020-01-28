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

namespace TCorp\Legacy\Form;


/**
 * Class for working with CSRF tokens to stop XSS attacks
 */
class CsrfToken
{


    /**
     * Get the CSRF token value
     * -------------------------------------------------------------------------
     * @return string
     */
    public function get()
    {
        // Start the session if not already started
        if (!isset($_SESSION)) {
            session_start();
        }

        // Generate and set the token if none exist in the session
        if (empty($_SESSION['CSRF'])) {
            $_SESSION['CSRF'] = bin2hex(random_bytes(32));
        }

        // Return the result
        return $_SESSION['CSRF'];
    }



    /**
     * Renders the CSRF Token's HTML
     * -------------------------------------------------------------------------
     * @return string
     */
    public function render() : string
    {
        $token = $this->get();
        return "<input type=\"hidden\" name=\"CSRF\" value=\"$token\">";
    }


    /**
     * Checks if the CSRF token exists and is valid
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function check() : bool
    {
        $token = $_REQUEST['CSRF'] ?? '';
        return hash_equals($this->get(), $token);
    }

}
