<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Rest;


/**
 * Class containing configuration values that may be needed by a REST client
 */
class Config
{

    /**
     * Timeout of all requests in seconds
     *
     * @var float
     */
    protected $timeout = 0;


    /**
     * Varify the API's SSL certificate
     *
     * @var bool
     */
    protected $verifySSL = true;


    /**
     * Additional HTTP headers to send with ALL requests
     *
     * @var string[]
     */
    protected $headers = [];


    /**
     * Number of milliseconds to delay before sending requests.
     *
     * @var float
     */
    protected $delay = 0;


}
