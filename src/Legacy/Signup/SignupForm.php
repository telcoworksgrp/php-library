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

use \TCorp\Legacy\Input;
use \TCorp\Legacy\Session;
use \TCorp\Legacy\Email;
use \TCorp\Legacy\Helper;


/**
 * Base class for all signup forms
 */
class SignupForm
{

    protected $notificationEmail = null;
    protected $confirmationEmail = null;

    public $ipaddress = '';
    public $useragent = '';
    public $submitted = '';
    public $referralId = '';
    public $domain = '';



    /**
     * Constructor emthod for initalising new instances of this class
     * -------------------------------------------------------------------------
     */
    public function __construct()
    {
        // Initialise the form's notification and confirmation emails
        $this->notificationEmail = new Email(true);
        $this->confirmationEmail = new Email(true);

        // Initalise some form meta data
        $this->ipaddress  = Helper::getRemoteIPAddress();
        $this->useragent  = Helper::getRemoteUserAgent();
        $this->submitted  = date('r');
        $this->referralId = Helper::getAffiliateReferralId();
        $this->domain     = Helper::getCurrentDomainName();

    }


    /**
     * Set the notification email's sender/from address
     * -------------------------------------------------------------------------
     * @param string    $address    An email address
     * @param string    $name       A name for the address
     */
    public function setNotificationSender(string $address,
        string $name = '')
    {
        $this->notificationEmail->setFrom($address, $name);
    }


    /**
     * Add a regular recipient to the notification email
     * -------------------------------------------------------------------------
     * @param string    $address   An email address
     * @param string    $name      A name for the address
     */
    public function addNotificationRecipient(string $address,
        string $name = '')
    {
        $this->notificationEmail->addAddress($address, $name);
    }


    /**
     * Add a carbon copy (CC) recipient to the notification email
     * -------------------------------------------------------------------------
     * @param string    $address   An email address
     * @param string    $name      A name for the address
     */
    public function addNotificationCc(string $address, string $name = '')
    {
        $this->notificationEmail->addCC($address, $name);
    }


    /**
     * Add a blind carbon copy (BCC) recipient to the notification email
     * -------------------------------------------------------------------------
     * @param string    $address   An email address
     * @param string    $name      A name for the address
     */
    public function addNotificationBcc(string $address, string $name = '')
    {
        $this->notificationEmail->addBCC($address, $name);
    }


    /**
     * Set the notification email's subject
     * -------------------------------------------------------------------------
     * @param string    $subject   A new email subject
     */
    public function setNotificationSubject(string $subject)
    {
        $this->notificationEmail->setSubject($subject);
    }


    /**
     * Set the notification email's body
     * -------------------------------------------------------------------------
     * @param string    $body   A new email subject
     */
    public function setNotificationBody(string $body)
    {
        $this->notificationEmail->setBody($body);
    }


    /**
     * Set the notification email's body based on a PHP script that
     * contains template
     * -------------------------------------------------------------------------
     * @param string    $template   Path to PHP script containing the template
     */
    public function setNotificationBodyFromTemplate(string $template)
    {
        ob_start();
        require($template);
        $this->setNotificationEmailBody(ob_get_clean());
    }


    /**
     * Sends the notification email
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function sendNotification()
    {
        return $this->notificationEmail->send();
    }



    /**
     * Set the notification email's sender/from address
     * -------------------------------------------------------------------------
     * @param string    $address    An email address
     * @param string    $name       A name for the address
     */
    public function setConfirmationSender(string $address,
        string $name = '')
    {
        $this->confirmationEmail->setFrom($address, $name);
    }


    /**
     * Add a regular recipient to the notification email
     * -------------------------------------------------------------------------
     * @param string    $address   An email address
     * @param string    $name      A name for the address
     */
    public function addConfirmationRecipient(string $address,
        string $name = '')
    {
        $this->confirmationEmail->addAddress($address, $name);
    }


    /**
     * Add a carbon copy (CC) recipient to the notification email
     * -------------------------------------------------------------------------
     * @param string    $address   An email address
     * @param string    $name      A name for the address
     */
    public function addConfirmationCc(string $address, string $name = '')
    {
        $this->confirmationEmail->addCC($address, $name);
    }


    /**
     * Add a blind carbon copy (BCC) recipient to the notification email
     * -------------------------------------------------------------------------
     * @param string    $address   An email address
     * @param string    $name      A name for the address
     */
    public function addConfirmationBcc(string $address, string $name = '')
    {
        $this->confirmationEmail->addBCC($address, $name);
    }


    /**
     * Set the notification email's subject
     * -------------------------------------------------------------------------
     * @param string    $subject   A new email subject
     */
    public function setConfirmationSubject(string $subject)
    {
        $this->confirmationEmail->setSubject($subject);
    }


    /**
     * Set the notification email's body
     * -------------------------------------------------------------------------
     * @param string    $body   A new email subject
     */
    public function setConfirmationBody(string $body)
    {
        $this->confirmationEmail->setBody($body);
    }


    /**
     * Set the notification email's body based on a PHP script that
     * contains template
     * -------------------------------------------------------------------------
     * @param string    $template   Path to PHP script containing the template
     */
    public function setConfirmationBodyFromTemplate(string $template)
    {
        ob_start();
        require($template);
        $this->setConfirmationEmailBody(ob_get_clean());
    }


    /**
     * Sends the notification email
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function sendConfirmation()
    {
        return $this->confirmationEmail->send();
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


    /**
     * Proxy method for blocking a user if thier IP belongs to a banned country
     * -------------------------------------------------------------------------
     * @return void
     */
    public function blockBannedCountries()
    {
        Helper::blockBannedCountries();
    }


    /**
     * Proxy method for rendering a hidden honeypot text field
     * -------------------------------------------------------------------------
     * @return string   HTML for rendering a hidden honeypot text field
     */
    public function getHoneypotHtml()
    {
        return Helper::getHoneypotHtml();
    }


    /**
     * Proxy method for rendering a CSRF token inside a web form
     * -------------------------------------------------------------------------
     * @return string   HTML for rendering a CSRF token inside a web form
     */
    public function getCSRFTokenHtml()
    {
        return Helper::getHoneypotHtml();
    }


}
