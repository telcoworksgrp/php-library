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
 * Class for allowing/blocking traffic
 */
class Firewall
{

    /**
     * Block access to the website
     * -------------------------------------------------------------------------
     * @return void
     */
    public function block() : void
    {
        SecurityHelper::blockAccess();
    }


    /**
     * Allow access to the website
     * -------------------------------------------------------------------------
     * @return void
     */
    public function allow()
    {
    }


    /**
     * Check if the current user is allowed to access the website
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function check() : bool
    {
        // Check if the the user's ip address is a private ip adddress
        if (\KWS\Utils::isPrivateIPAddress()) {
            return true;
        }

        // Check if the user is from a banned country
        $helper = Helper::getConfig();
        $apikey = $config->get('ipgeolocation.apikey');

        if (SecurityHelper::checkIpLocation(
            SecurityHelper::WORST_SPAM_COUNTRIES, $apikey)) {
            $this->block();
        }

        // Allow access for all others
        return true;
    }


    /**
     * Perform check of the user, then block/allow accordingly
     * -------------------------------------------------------------------------
     * @return void
     */
    public function run()
    {
        if ($this->check()) {
            $this->allow();
        } else {
            $this->block();
        }
    }


}
