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

use \TCorp\Rest\RestClient;


/**
 * A basic client for sending API requests to Telecom Corporates T3 system
 */
class T3Client extends RestClient
{

    /**
     * Base URL for all API resources
     *
     * @var string
     */
    protected $baseUrl = 'https://portal.tbill.live/numbers-service-impl/api/';

}
