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
 * Legacy helper class for implimenting a ver basic firewall
 */
class Firewall
{

    /**
      * Block access to the site with a given HTTP response code and message
      * ------------------------------------------------------------------------
      * @param integer $httpCode        HTTP response code to send
      * @param string  $httpMessage     Message to send with the response code
      */
    public static function block(int $httpCode = 403, string
        $httpMessage = 'Forbidden') : void
    {
        header("HTTP/1.0 $httpCode $httpMessage");
        die();
    }
    

}
