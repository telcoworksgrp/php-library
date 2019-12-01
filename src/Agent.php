<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp;


/**
 * Class for getting information about the user agent
 */
class Agent
{
    /**
     * Check if the current user agent is  googlebot
     *-------------------------------------------------------------------------
     * @return bool
     */
    public function isGooglebot() : bool
    {
        return (bool) preg_match("/Google(bot)?/", $_SERVER['HTTP_USER_AGENT']);
    }

}
