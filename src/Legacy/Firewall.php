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

use \KWS\Security\SecurityHelper;
use \KWS\Utils;


/**
 * Class for allowing or blocking website traffic
 */
class Firewall
{

    /**
     * A list of countries who's ip addresses are banned
     *
     * @var string[]
     */
    public $bannedCountries = [];



    /**
     * Allow the user to access this website
     * -------------------------------------------------------------------------
     * @return void
     */
    public function allow() : void
    {
    }


    /**
     * BLock the user from accessing this website
     * -------------------------------------------------------------------------
     * @return void
     */
    public function block()
    {
        SecurityHelper::blockAccess();
    }


    /**
     * Check if the user is allowed to access this website
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function check() : bool
    {
        // Initialise some local variables
        $config = Factory::getConfig();
        $apikey = $config->get("ipgeo.apikey");

        // Check if the user has a private ip address
        if (Utils::isPrivateIPAddress()) {
            return true;
        }

        // Check if the user's ip is from a banned country
        if (SecurityHelper::checkIpLocation($this->bannedCountries, $apikey)){
            return false;
        }

        // By default, allow access
        return true;
    }


    /**
     * Check if the user should have access or not and then carry out
     * the appropriate action
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


    /**
     * Add an item to the list of banned countries
     * -------------------------------------------------------------------------
     * @param string    $country   A two charictar country code
     */
    public function banCountry(string $country)
    {
        $this->bannedCountries[] = $country;
    }




}
