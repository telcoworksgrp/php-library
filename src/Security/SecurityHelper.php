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
        return '<input type="text" name="hpot" value="" label="Name"' .
            ' style="display: none;" >';
    }


    /**
     * Checks if a honeypot field has a value. If the honeypot field has a
     * value AND the honeypot field was hidden from human users then the form
     * data was submitted by a bot
     * -------------------------------------------------------------------------
     * @return  bool    TRUE = user is human, FALSE = user is a robot
     */
    public static function checkHoneyPot()
    {
        return isset($_REQUEST['hpot']) && ($_REQUEST['hpot'] === '');
    }

}
