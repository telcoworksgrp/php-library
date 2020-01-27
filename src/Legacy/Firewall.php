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
 * Class for allowing/disallowing website traffic
 */
class Firewall
{

    /**
      * Block access to the site with a given HTTP response code and message
      * ------------------------------------------------------------------------
      * @param   int     $status      HTTP response code to send
      * @param   string  $message     Message to send with the response code
      *
      * @return  void
      */
    public function block(int $status = 403, string $message = 'Forbidden') : void
    {
        header("HTTP/1.0 $status $message");
        die();
    }


    /**
     * Block access to the site if the form's honeypot is invalid
     * -------------------------------------------------------------------------
     * @param   int     $status      HTTP response code to send
     * @param   string  $message     Message to send with the response code
     *
     * @return  void
     */
    public function blockIfInvalidHoneypot(int $status = 403, string $message = 'Forbidden') : void
    {
        // Block user if honeypot is not valid
        if (!Factory::getForm()->honeypot->check()) {
            $this->block($status, $message);
        }
    }

}
