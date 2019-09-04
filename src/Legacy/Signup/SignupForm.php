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
    public function updateStateAndRedirect(string $url) : void
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
            Session:setValue($key, $result);
        }

        // Get the new/existing value from the session.
        $result = Session::getValue($key, false);

        // If we still don't have a value return the default value.
        $result = ($result === false) ? $default : $result;

        // Return the result
        return $result;
    }

}
