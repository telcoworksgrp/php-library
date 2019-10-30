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

use \TCorp\Utils;
use \PHPMailer\PHPMailer\PHPMailer;


/**
 * Class for sending basic emails
 */
class Email
{

    /**
     * Contains the email that will be sent
     *
     * @var \PHPMailer\PHPMailer\PHPMailer
     */
    protected $email = null;


    /**
     * Constructor method for initialising new instances of this class
     * -------------------------------------------------------------------------
     */
    public function __construct()
    {
        // Initialise some class properties
        $this->email = PHPMailer(true);
    }


    /**
     * Set the email's from address
     * -------------------------------------------------------------------------
     * @param string    $address    An email address
     * @param string    $name       Name of the sender
     */
    public function setFrom(string $address, string $name = '')
    {
        $this->email->setFrom($address, $name);
    }


    /**
     * Add a regular recipient to the email
     * -------------------------------------------------------------------------
     * @param string    $address    An email address
     * @param string    $name       Name of the recipient
     */
    public function addRecipient(string $address, string $name = '')
    {
        $this->email->addAddress($address, $name);
    }


    /**
     * Add a CC recipient to the email
     * -------------------------------------------------------------------------
     * @param string    $address    An email address
     * @param string    $name       Name of the CC recipient
     */
    public function addCC(string $address, string $name = '')
    {
        $this->email->addCC($address, $name);
    }


    /**
     * Add a BCC recipient to the email
     * -------------------------------------------------------------------------
     * @param string    $address    An email address
     * @param string    $name       Name of the BCC recipient
     */
    public function addBCC(string $address, string $name = '')
    {
        $this->email->addBCC($address, $name);
    }


    /**
     * Set the email's subject
     * -------------------------------------------------------------------------
     * @param string    $subject    An email subject line
     */
    public function setSubject(string $subject)
    {
        $this->email->Subject = trim($subject);
    }


    /**
     * Set the email's body section
     * -------------------------------------------------------------------------
     * @param string    $content   Plain text or HTML content
     */
    public function setBody(string $content)
    {
        $this->email->isHTML(Utils::containsHTML($content));
        $this->email->Body = $content;
    }


    /**
     * Append content to the email's body section
     * -------------------------------------------------------------------------
     * @param string    $content   Plain text or HTML content
     */
    public function appendBody(string $content)
    {
        $this->setBody($this->email->Body . $content);
    }


    /**
     * Set the email's body using a template
     * -------------------------------------------------------------------------
     * @param string $filename  PHP script to run
     * @param mixed  $data      Data for the template to use
     */
    public function setBodyFromTemplate(string $filename, $data)
    {
        ob_start();
        require($filename);
        $this->setBody(ob_get_clean());
    }


    /**
     * Set an email header to a given value
     * -------------------------------------------------------------------------
     * @param  string   $name   Name of the email header
     * @param  string   $value  Value to set the header to
     */
    public function setHeader(string $name, string $value)
    {
        $this->email->addCustomHeader($name, $value);
    }


    /**
     * Send the email/s
     * -------------------------------------------------------------------------
     */
    public function send()
    {
        return $this->send();
    }

}
