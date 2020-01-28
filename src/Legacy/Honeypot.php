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
 * Class for working with HTML form honeypots
 */
class Honeypot
{

    /**
     * Renders the honeypot's HTML
     * -------------------------------------------------------------------------
     * @return string
     */
    public function render() : string
    {
        return "<input type=\"text\" name=\"c67538\" value=\"\" " .
            "style=\"display: none !important;\">";
    }


    /**
     * Checks if the honeypot exists and is valid
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function check() : bool
    {
        // Initialise some local variables
        $input = Factory::getInput();

        // Check if the honeypot is valid
        $result = $input->get('c67538', '-') === '';

        // Return the result
        return $result
    }

}
