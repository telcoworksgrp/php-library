<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Legacy\Form;

use \KWS\Security\SecurityHelper;
use \TCorp\Legacy\Helper;
use \PHPMailer\PHPMailer\PHPMailer;


/**
 * Base class for all other legacy forms
 */
class BaseForm
{
    /**
     * The IP address from which the form was submitted
     *
     * @var string
     */
    public $ip = '';


    /**
     * The user agent used to submit the form\
     *
     * @var string
     */
    public $useragent  = '';


    /**
     * When the form was submitted
     *
     * @var string
     */
    public $submited = '';


    /**
     * An affiliate referal id for T3
     *
     * @var string
     */
    public $refferalId = '';


    /**
     * The domain name at which the form was submitted
     *
     * @var string
     */
    public $domain = '';


    /**
     * A notification email
     *
     * @var \PHPMailer\PHPMailer\PHPMailer
     */
    public $notification = null;


    /**
     * A confirmation email
     *
     * @var \PHPMailer\PHPMailer\PHPMailer
     */
    public $confirmation = null;



    /**
     * Constructor method for Initialising new instances of this class
     * -------------------------------------------------------------------------
     */
    public function __construct()
    {
        // Initialise some class properties
        $this->notification = new PHPMailer();
        $this->confirmation = new PHPMailer();

        // Load the curretn form state
        $this->loadState();
    }


    /**
     * Load the current state of the form
     * -------------------------------------------------------------------------
     * @return void
     */
    public function loadState()
    {
        $this->ip         = Helper::getRemoteIpAddress();
        $this->useragent  = Helper::getRemoteUserAgent();
        $this->submited   = Helper::getDateTime();
        $this->refferalId = Helper::getAffiliateReferralId();
        $this->domain     = Helper::getDomainName();
    }


    /**
     * Processes the submission of a single form step
     * -------------------------------------------------------------------------
     * @return void
     */
    public function processStep()
    {
        // If the current request is a form submission then process
        // the submission and then reload the page
        if (Helper::isFormSubmission()) {

            // Block access if the honeypot is missing or invalid
            Helper::blockIfInvalidHoneypot();

            // Block access if the CSRF token is missing or doesn't match
            Helper::blockIfInvalidCSRFToken();

            // Reload the page without the form submission
            Helper::redirect();
        }
    }


    /**
     * Proxy for the SecurityHelper::getHoneypotHtml() method
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a hidden honeypot text field
     */
    public function getHoneypotHtml()
    {
        return Helper::getHoneypotHtml();
    }


    /**
     * Proxy for the SecurityHelper::getCSRFTokenHtml() method
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a CSRF token inside a web form
     */
    public function getCSRFTokenHtml()
    {
        return Helper::getCSRFTokenHtml();
    }


    /**
     * Proxy for the SecurityHelper::getReCaptchaHtml() method
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a CSRF token inside a web form
     */
    public function getReCaptchaHtml()
    {
        return Helper::getReCaptchaHtml();
    }


    /**
     * Check if the form ReCaptcha was successfully completed. If not, then
     * the user will be redirected
     * -------------------------------------------------------------------------
     * @return void
     */
    public function redirectIfInvalidReCaptcha(string $redirectUrl) : void
    {
        Helper::redirectIfInvalidReCaptcha($redirectUrl);
    }

}
