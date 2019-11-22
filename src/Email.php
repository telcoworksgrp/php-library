<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp;

use \PHPMailer\PHPMailer\PHPMailer;


/**
 * Class for sending emails
 */
class Email
{

    /**
     * Holds the email that will sent
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
        $this->email = new PHPMailer();
    }


    /**
     * Set the email's from address and name
     * -------------------------------------------------------------------------
     * @param  string   $address    An email address
     * @param  string   $name       A name for the email address
     *
     * @return Email
     */
    public function setFrom(string $address, string $name = '') : Email
    {
        $this->email->setFrom($address, $name);
        return $this;
    }


    /**
     * Add a regular recipient to the email
     * -------------------------------------------------------------------------
     * @param  string   $address    An email address
     * @param  string   $name       A name for the email address
     *
     * @return Email
     */
    public function addRecipient(string $address, string $name = '') : Email
    {
        $this->email->addAddress($address, $name);
        return $this;
    }


    /**
     * Add a CC recipient to the email
     * -------------------------------------------------------------------------
     * @param  string   $address    An email address
     * @param  string   $name       A name for the email address
     *
     * @return Email
     */
    public function addCC(string $address, string $name = '') : Email
    {
        $this->email->addCC($address, $name);
        return $this;
    }


    /**
     * Add a BCC recipient to the email
     * -------------------------------------------------------------------------
     * @param  string   $address    An email address
     * @param  string   $name       A name for the email address
     *
     * @return Email
     */
    public function addBCC(string $address, string $name = '') : Email
    {
        $this->email->addBCC($address, $name);
        return $this;
    }


    /**
     * Add a replyto recipient to the email
     * -------------------------------------------------------------------------
     * @param  string   $address    An email address
     * @param  string   $name       A name for the email address
     *
     * @return Email
     */
    public function addReplyTo(string $address, string $name = '') : Email
    {
        $this->email->addReplyTo($address, $name);
        return $this;
    }


    /**
     * Set the emails subject line
     * -------------------------------------------------------------------------
     * @param  string   $subject    An email subject line
     *
     * @return Email
     */
    public function setSubject(string $subject) : Email
    {
        $this->email->Subject = $subject;
        return $this;
    }


    /**
     * Set the email's main body/content. HTML will automatically be detected
     * -------------------------------------------------------------------------
     * @param  string   $body   Plain text or HTML
     *
     * @return Email
     */
    public function setBody(string $body) : Email
    {
        $this->email->isHTML(Utils::containsHTML($body));
        $this->email->Body = $body;
        return $this;
    }


    /**
     * Set the email's main body/content using a template and some data.
     * -------------------------------------------------------------------------
     * @param  string   $template   Path to a PHP script that renders a template
     * @param  mixed    $data       Data to pass to the template
     *
     * @return Email
     */
    public function setBodyFromTemplate(string $template, $data = null) : Email
    {
        ob_start();
        include($template);
        $this->setBody(ob_get_clean());
        return $this;
    }


    /**
     * Add a custom header to the email
     * -------------------------------------------------------------------------
     * @param  string   $name   Name of the header
     * @param  string   $value  Value for the header
     *
     * @return Email
     */
    public function addHeader(string $name, string $value): Email
    {
        $this->email->addCustomHeader($name, $value);
        return $this;
    }


    /**
     * Send the email
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function send() : bool
    {
        try {
            $this->email->send();
        } catch (\Exception $e) {
            echo "Message could not be sent. Mailer Error: {$this->email->ErrorInfo}";
        }
    }

}
