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
 * Class for working with CSRF tokens to stop XSS attacks
 */
class Token
{

    /**
     * Get the CSRF token value
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getId()
    {
        // Initialise some local variables
        $session = Factory::getSession();

        // Generate and set the token if none exist in the session
        if (!$session->exists('csrf')) {
            $session->set('csrf', bin2hex(random_bytes(32)));
        }

        // Return the result
        return $session->get('csrf', '');
    }



    /**
     * Renders the CSRF Token's HTML
     * -------------------------------------------------------------------------
     * @return string
     */
    public function render() : string
    {
        $tokenId = $this->getId();
        return "<input type=\"hidden\" name=\"CSRF\" value=\"$tokenId\">";
    }


    /**
     * Checks if the CSRF token exists and is valid
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function check() : bool
    {
        // Initialise some local variables
        $input = Factory::getInput();

        // Check if the CSRF tokeb is valid
        $result = hash_equals($this->getId(), $input->get('csrf'))

        // Return the result
        return $result;
    }

}
