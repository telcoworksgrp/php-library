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

    /**
     * IP address of the remote user
     *
     * @var string
     */
    public $ipaddress = '';


    /**
     * User agent of the remote user
     *
     * @var string
     */
    public $useragent = '';

    /**
     * Date and time data was last submitted
     *
     * @var string
     */
    public $submitted = '';


    /**
     * A T3 affiliate refferal id (if the user was
     * redircted from an affilate site)
     *
     * @var string
     */
    public $refferalId = '';


    /**
     * Domain name of this website
     *
     * @var string
     */
    public $domain = '';



    /**
     * Constructor for initialising new instances of this class
     * -------------------------------------------------------------------------
     */
    public function __construct()
    {
        // Initialise some class properties
        $this->ipaddress  = Helper::getRemoteIPAddress();
        $this->useragent  = Helper::getRemoteUserAgent();
        $this->submitted  = date('r');
        $this->refferalId = Helper::getAffiliateReferralId();
        $this->domain     = Helper::getCurrentDomainName();

        // Loads the current state of the signup form
        $this->loadState();
    }


    /**
     * Loads the current state of the signup form from the current session
     * -------------------------------------------------------------------------
     * @return void
     */
    public function loadState() : void
    {
    }


    /**
     * Update the current state of the signup form to include any new data
     * submitted with the current request. This will also update values in
     * current session
     * -------------------------------------------------------------------------
     * @return void
     */
    public function updateState() : void
    {
    }


    /**
     * Update the current state of the signup form to include any new
     * data and then redirect to another url
     * -------------------------------------------------------------------------
     * @param string    $url    URL to redirect the user to
     */
    public function updateStateAndRedirect(string $url = '') : void
    {
        // Update the current state of the signup form
        $this->updateState();

        // Redirect to a new URL
        Helper::redirect($url);
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
    public function getFieldState(string $key, string $name,
        $default = null, string $filter = 'STRING')
    {
        // Try to get the form field's value from the request.
        $result = Input::getValue($name, false, $filter);

        // If a value from the request has been found, set/update
        // the corrsponding session variable
        if ($result !== false) {
            Helper::setSessionValue($key, $result);
        }

        // Get the new/existing value from the session.
        $result = Helper::getSessionValue($key, false);

        // If we still don't have a value return the default value.
        $result = ($result === false) ? $default : $result;

        // Return the result
        return $result;
    }


    /**
     * Proxy for \TCorp\Legacy\Helper::getHoneypotHtml();
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a hidden honeypot text field
     */
    public function getHoneypotHtml()
    {
        return Helper::getHoneypotHtml();
    }


    /**
     * Proxy for \TCorp\Legacy\Helper::blockIfInvalidHoneypot();
     * -------------------------------------------------------------------------
     * @return  void
     */
    public function blockIfInvalidHoneypot() : void
    {
        Helper::blockIfInvalidHoneypot();
    }


    /**
     * Proxy for \TCorp\Legacy\Helper::getCSRFTokenHtml();
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a CSRF token inside a web form
     */
    public function getCSRFTokenHtml()
    {
        return Helper::getCSRFTokenHtml();
    }


    /**
     * Proxy for \TCorp\Legacy\Helper::blockIfInvalidCSRFToken();
     * -------------------------------------------------------------------------
     * @return  void
     */
    public function blockIfInvalidCSRFToken() : void
    {
        Helper::blockIfInvalidCSRFToken();
    }


    /**
     * Proxy for \TCorp\Legacy\Helper::getReCaptchaHtml();
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a CSRF token inside a web form
     */
    public function getReCaptchaHtml()
    {
        return Helper::getReCaptchaHtml();
    }


    /**
     * Proxy for \TCorp\Legacy\Helper::redirectIfInvalidReCaptcha()
     * -------------------------------------------------------------------------
     * @return void
     */
    public function redirectIfInvalidReCaptcha(string $redirectUrl) : void
    {
        Helper::redirectIfInvalidReCaptcha($redirectUrl);
    }

}
