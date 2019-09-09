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



/**
 * Class for working with the current user info
 */
class User
{


    /**
     * Get the IP address from which the user is viewing the current page.
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getIpAddress() : string
    {
        return $_SERVER['REMOTE_ADDR'];
    }


    /**
     * Get the contents of the User-Agent: header from the current request
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getUserAgent() : string
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }

}
