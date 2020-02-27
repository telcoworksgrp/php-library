<?php
/**
 * =============================================================================
 * @package     Telcoworks Group PHP Library
 * @author      David Plath <webmaster@telcoworksgrp.com.au>
 * @copyright   Copyright (c) 2020 Telcoworks Group. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TelcoworksGrp\WebApi;

use \TelcoworksGrp\Rest\Client AS RestClient;


/**
 * Client for accessing Telcoworks Group's Web API
 */
class Client extends RestClient
{

    /**
     * Base URL for all API resources
     *
     * @var string
     */
    protected $baseUrl = 'https://api.telcoworksgroup.com.au/';

}
