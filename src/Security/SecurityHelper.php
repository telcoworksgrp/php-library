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

namespace TCorp\Security;


/**
 * Helper class for implimenting various website security
 */
class SecurityHelper
{

    /**
     * Gets the HTML for a honeypot form field
     * -------------------------------------------------------------------------
     * @return  string  Honeypot HTML
     */
    public static function getHoneyPot()
    {
        return '<input type="text" name="Lvg5RukdDoWmXF1OOWc0" value="" ' .
            'label="Name" style="display: none !important;" >';
    }


    /**
     * Checks if a honeypot field has a value. If the honeypot field is not set
     * or has a value AND the honeypot field was hidden from human users then
     * the form data was submitted by a bot
     * -------------------------------------------------------------------------
     * @return  bool    TRUE = user is human, FALSE = user is a robot
     */
    public static function checkHoneyPot()
    {
        return isset($_REQUEST['Lvg5RukdDoWmXF1OOWc0']) &&
            ($_REQUEST['Lvg5RukdDoWmXF1OOWc0'] === '');
    }


    /**
     * Block access to the site
     * -------------------------------------------------------------------------
     * @param   int     $httpCode   HTTP code to return
     * @param   string  $message    Message to display with HTTP code
     *
     * @return void
     */
    public static function blockAccess(int $httpCode = 403,
        string $message = 'Forbidden') : void
    {
        header("HTTP/1.0 $httpCode  $message");
    }

}
