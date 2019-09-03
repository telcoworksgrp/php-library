<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Legacy\Signup;

use \TCorp\Legacy\Session;
use \TCorp\Legacy\Input;
use \TCorp\Legacy\Helper;


/**
 * Base class for all other signup forms
 */
class SignupForm
{

    public $ipaddress = '';
    public $useragent = '';
    public $submitted = '';
    public $refferalId = '';
    public $domain = '';



    /**
     * Constructor for initialising new instances of this class
     * -------------------------------------------------------------------------
     */
    public function __construct()
    {
        // Update the current state
        $this->updateState();
    }


    /**
     * Update class properies to represent the current state of the form. This
     * takes into consideration form field values stored in the current session
     * and form field values passed in the http request. Values in the http
     * request override and replace values stored in the current session.
     * -------------------------------------------------------------------------
     * @return void
     */
    public function updateState()
    {
        $this->ipaddress  = Helper::getRemoteIPAddress();
        $this->useragent  = Helper::getRemoteUserAgent();
        $this->submitted  = date('r');
        $this->refferalId = Helper::getAffiliateReferralId();
        $this->domain     = Helper::getCurrentDomainName();
    }


    /**
     *  Proxy method for \TCorp\Legacy\Helper::blockBannedCountries()
     *  ------------------------------------------------------------------------
     *  @return void
     */
    public static function blockBannedCountries() : void
    {
        return Helper::blockBannedCountries();
    }


    /**
     * Proxy for the SecurityHelper::getHoneypotHtml() method
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a hidden honeypot text field
     */
    public static function getHoneypotHtml()
    {
        return SecurityHelper::getHoneypotHtml();
    }



    /**
     * Check the hidden honeypot form field. If it is missing or invalid then
     * the user will be blocked
     * -------------------------------------------------------------------------
     * @return  void
     */
    public static function blockIfInvalidHoneypot() : void
    {
        if (!SecurityHelper::checkHoneypot()) {
            SecurityHelper::blockAccess();
        }
    }



    /**
     * Proxy for the SecurityHelper::getCSRFTokenHtml() method
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a CSRF token inside a web form
     */
    public static function getCSRFTokenHtml()
    {
        return SecurityHelper::getCSRFTokenHtml();
    }



    /**
     * Check the CSRF token. If it is missing or doesn't match the one stored
     * in the user's session then the user will be blocked
     * -------------------------------------------------------------------------
     * @return  void
     */
    public static function blockIfInvalidCSRFToken() : void
    {
        if (!SecurityHelper::checkCSRFToken()) {
            SecurityHelper::blockAccess();
        }
    }



    /**
     * Proxy for the SecurityHelper::getReCaptchaHtml() method
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a CSRF token inside a web form
     */
    public static function getReCaptchaHtml()
    {
        return SecurityHelper::getReCaptchaHtml(static::$recaptchaSiteKey);
    }



    /**
     * Check if the form ReCaptcha was successfully completed. If not, then
     * the user will be redirected
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function redirectIfInvalidReCaptcha(string $redirectUrl) : void
    {
        if (!SecurityHelper::checkReCaptcha(static::$recaptchaSecret)) {
            self::redirect($redirectUrl, false, 303);
        }
    }


    /**
     * Get the current state of a given form field's value. Values in the
     * request replace values in the current session. If a value can't be
     * found in the request or the current session a default value can
     * be returned.
     * -------------------------------------------------------------------------
     * @param  string   $key        Session variable  name
     * @param  string   $name       Input variable name
     * @param  mixed    $default    Default value if no value can be found
     * @param  string   $filter     Filter type for sanitization
     *
     * @return mixed    The current value f the form field, as per the
     *                  request and session
     */
    public static function getFormFieldState(string $key, string $name,
        $default = null, string $filter = 'STRING')
    {
        // Try to get the form field's value from the request.
        $result = Input::getValue($name, false, $filter);

        // If a value from the request has been found, set/update
        // the corrsponding session variable
        if ($result !== false) {
            Session:setValue($key, $result);
        }

        // Get the new/existing value from the session.
        $result = Session::getValue($key, false);

        // If we still don't have a value return the default value.
        if ($result === false) {
            $result = $default;
        }

        // Return the result
        return $result;
    }





}
