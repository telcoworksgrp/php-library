<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Firewall;


/**
 * Class for controlling website traffic
 */
class Firewall
{

    /**
     * Block the user by sending a 403 http response
     * -------------------------------------------------------------------------
     * @param  string  $message A HTTP response message
     * @param  int     $code    A HTTP reponse code
     *
     * @return void
     */
    public function block(string $message = 'Forbidden', int $code = 403)
    {
        header("HTTP/1.0 $code $message");
        die();
    }

}
