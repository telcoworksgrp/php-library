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
 * Class for managing the site's configuration
 */
class Config
{

    /**
     * API key to use when calling the IpGeolocation API
     *
     * @var string
     *
     * @see https://ipgeolocation.io/
     */
    public static $ipGeolocationApiKey = '';


    /**
     * A Google ReCaptcha site key
     *
     * @var string
     *
     * @see https://www.google.com/recaptcha/intro/v3.html
     */
    public static $recaptchaSiteKey = '';


    /**
     * A Google ReCaptcha secret key to compliment the site key
     *
     * @var string
     *
     * @see https://www.google.com/recaptcha/intro/v3.html
     */
    public static $recaptchaSecret = '';


    /**
     * API key to use when calling the ABN lookup API
     *
     * @var string
     *
     * @see https://abr.business.gov.au/Tools/WebServices
     */
    public static $abnLookupGuid = '';

}
