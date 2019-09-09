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
 * Class to manage configuration value
 */
class Config
{

    /**
     * A company name for the website
     *
     * @var string
     */
    public static $companyName = '';


    /**
     * The company's number and street name
     *
     * @var string
     */
    public static $companyAddress = '';


    /**
     * The suburb in which the company is located
     *
     * @var string
     */
    public static $companySuburb = '';


    /**
     * The state in which the company is located
     *
     * @var string
     */
    public static $companyState = '';


    /**
     * The postcode on which the company is located
     *
     * @var string
     */
    public static $companyPostcode = '';


    /**
     * THe country in which the company is located
     *
     * @var string
     */
    public static $companyCountry = '';


    /**
     * The company's contact phone number
     *
     * @var string
     */
    public static $companyPhone = '';


    /**
     * An main email address to which email notifications
     * and other corraspondance will be sent
     *
     * @var string
     */
    public static $primaryEmail = '';


    /**
     * An additional email address to which email notifications
     * and other corraspondance will be sent
     *
     * @var string
     */
    public static $secondaryEmail = '';


    /**
     * API key to use when calling the IpGeolocation API
     *
     * @var string
     *
     * @see https://ipgeolocation.io/
     */
    public static $ipGeoApiKey = '';


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
