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
     * Template to use for generating the notifiation email body
     *
     * @var string
     */
    public $notificationTemplate = '';


    /**
     * A confirmation email
     *
     * @var \PHPMailer\PHPMailer\PHPMailer
     */
    public $confirmation = null;


    /**
     * Template to use for generating the confirmation email body
     *
     * @var string
     */
    public $confirmationTemplate = '';



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
     * Get the current state of a given form field from the request/session.
     * -------------------------------------------------------------------------
     * @param  string   $key        Session key where the value is stored
     * @param  string   $name       The form field's name
     * @param  string   $default    Value to return if no value is found
     *
     * @return mixed
     */
    public function getFieldState(string $key, string $name, $default = '')
    {
        // Try to get a value from the request
        $result = $_REQUEST[$name] ?? false;

        // If we found a value in the request sanitise
        // the value, update the current session. Otherwise
        // try to get a value from the session.
        if ($result !== false) {
            $result = htmlentities($result);
            Helper::setSessionValue($key, $result);
        } else {
            $result = Helper::getSessionValue($key, $default);
        }

        // Return the result
        return $result;
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
     * Processes the final step of the form
     * -------------------------------------------------------------------------
     * @return void
     */
    public function processFinalStep()
    {
        // If the current request is a form submission then process
        // the submission and then reload the page
        if (Helper::isFormSubmission()) {

            // Block access if the honeypot is missing or invalid
            Helper::blockIfInvalidHoneypot();

            // Block access if the CSRF token is missing or doesn't match
            Helper::blockIfInvalidCSRFToken();

            // Redirect back to the last step if the capcha is invalid
            Helper::redirectIfInvalidReCaptcha(Helper::getReferrerUrl());

            // Reload the page without the form submission
            Helper::redirect();

        }
    }


    /**
     * Clear the form's current state
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clearState()
    {
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
     * Set the notification email's sender address and name
     * -------------------------------------------------------------------------
     * @param string    $address    The sender's email ddaress
     * @param string    $name       The name of the sender
     *
     * @return void
     */
    public function setNotificationSender(string $address, string $name = '')
    {
        $this->notification->setFrom($address, $name);
    }


    /**
     * Adds a regular recipient to the notification email
     * ------------------------------------------------------------------------
     * @param string    $address    An email address
     * @param string    $name       A name for the email address
     *
     * @return void
     */
    public function addNotificationRecipient(string $address, string $name = '')
    {
        $this->notification->addAddress($address, $name);
    }



    /**
     * Adds a CC recipient to the notification email
     * ------------------------------------------------------------------------
     * @param string    $address    An email address
     * @param string    $name       A name for the email address
     *
     * @return void;
     */
    public function addNotificationCc(string $address, string $name = '')
    {
        $this->notification->addCC($address, $name);
    }


    /**
     * Adds a BCC recipient to the notification email
     * ------------------------------------------------------------------------
     * @param string    $address    An email address
     * @param string    $name       A name for the email address
     *
     * @return void
     */
    public function addNotificationBcc(string $address, string $name = '')
    {
        $this->notification->addBCC($address, $name);
    }


    /**
     * Set the notification email's subject
     * -------------------------------------------------------------------------
     * @param string $subject   A new subject line
     *
     * @return void
     */
    public function setNotificationSubject(string $subject)
    {
        $this->notification->Subject = $subject;
    }


    /**
     * Set the notification email's body
     * -------------------------------------------------------------------------
     * @param string    $body   Content to use as the email's body
     *
     * @return void
     */
    public function setNotificationBody(string $body)
    {
        $this->notification->Body = $body;
        $this->notification->isHtml($body != strip_tags($body));
    }


    /**
     * Set a template file for the notification email's body
     * -------------------------------------------------------------------------
     * @param string    $filename   Absoulte path to PHP script
     *
     * @return string
     */
    public function setNotificationTemplate(string $filename)
    {
        if (file_exists($filename)) {
            $this->notificationTemplate = $filename;
        }
    }



    /**
     * Send the notification email
     * -------------------------------------------------------------------------
     * @return void
     */
    public function sendNotification()
    {
        // If no body has been set, but a template has , then generate
        // the email's body from the template
        if (empty($this->notifiation->Body)) {
            if (!empty($this->notificationTemplate)) {
                ob_start();
                require($this->notificationTemplate);
                $this->setNotificationBody(ob_get_clean());
            }
        }

        // Send the email
        $this->notification->send();
    }


    /**
     * Set the confirmation email's sender address and name
     * -------------------------------------------------------------------------
     * @param string    $address    The sender's email ddaress
     * @param string    $name       The name of the sender
     *
     * @return void
     */
    public function setConfirmationSender(string $address, string $name = '')
    {
        $this->confirmation->setFrom($address, $name);
    }


    /**
     * Adds a regular recipient to the confirmation email
     * ------------------------------------------------------------------------
     * @param string    $address    An email address
     * @param string    $name       A name for the email address
     *
     * @return void
     */
    public function addConfirmationRecipient(string $address, string $name = '')
    {
        $this->confirmation->addAddress($address, $name);
    }



    /**
     * Adds a CC recipient to the confirmation email
     * ------------------------------------------------------------------------
     * @param string    $address    An email address
     * @param string    $name       A name for the email address
     *
     * @return void;
     */
    public function addConfirmationCc(string $address, string $name = '')
    {
        $this->confirmation->addCC($address, $name);
    }


    /**
     * Adds a BCC recipient to the confirmation email
     * ------------------------------------------------------------------------
     * @param string    $address    An email address
     * @param string    $name       A name for the email address
     *
     * @return void
     */
    public function addConfirmationBcc(string $address, string $name = '')
    {
        $this->confirmation->addBCC($address, $name);
    }


    /**
     * Set the confirmation email's subject
     * -------------------------------------------------------------------------
     * @param string $subject   A new subject line
     *
     * @return void
     */
    public function setConfirmationSubject(string $subject)
    {
        $this->confirmation->Subject = $subject;
    }


    /**
     * Set the confirmation email's body
     * -------------------------------------------------------------------------
     * @param string    $body   Content to use as the email's body
     *
     * @return void
     */
    public function setConfirmationBody(string $body)
    {
        $this->confirmation->Body = $body;
        $this->confirmation->isHtml($body != strip_tags($body));
    }


    /**
     * Set a template file for the confirmation email's body
     * -------------------------------------------------------------------------
     * @param string    $filename   Absoulte path to PHP script
     *
     * @return string
     */
    public function setConfirmationTemplate(string $filename)
    {
        if (file_exists($filename)) {
            $this->confirmationTemplate = $filename;
        }
    }



    /**
     * Send the confirmation email
     * -------------------------------------------------------------------------
     * @return void
     */
    public function sendConfirmation()
    {
        // If no body has been set, but a template has , then generate
        // the email's body from the template
        if (empty($this->confirmation->Body)) {
            if (!empty($this->confirmationTemplate)) {
                ob_start();
                require($this->confirmationTemplate);
                $this->setConfirmationBody(ob_get_clean());
            }
        }

        // Send the email
        $this->confirmation->send();
    }




}
