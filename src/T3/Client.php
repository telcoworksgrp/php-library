<?php
/**
 * =============================================================================
 * @package     Telcoworks Group PHP Library
 * @author      David Plath <webmaster@telcoworksgrp.com.au>
 * @copyright   Copyright (c) 2020 Telcoworks Group. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TelcoworksGrp\T3;

use \TelcoworksGrp\Rest\Client AS RestClient;


/**
 * A basic client for sending API requests to Telcoworks Group's T3 system
 */
class Client extends RestClient
{

    /**
     * Base URL for all API resources
     *
     * @var string
     */
    protected $baseUrl = 'https://portal.tbill.live/numbers-service-impl/api/';

}
