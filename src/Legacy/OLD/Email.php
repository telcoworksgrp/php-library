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

use PHPMailer\PHPMailer\PHPMailer;



/**
 * Class for sending emails
 */
class Email extends PHPMailer
{

    /**
     * Set the email's subject line
     * -------------------------------------------------------------------------
     * @param  string    $value     A new value
     *
     * @return PHPMailer
     */
    public function setSubject(string $value) : PHPMailer
    {
        $this->Subject = $value;
        return $this;
    }


    /**
     * Get the email's subject line
     * -------------------------------------------------------------------------
     * @return string   The email's subject line
     */
    public function getSubject() : string
    {
        return $this->Subject;
    }


    /**
     * Set the email's main body
     * -------------------------------------------------------------------------
     * @param  string    $value     A new value
     *
     * @return PHPMailer
     */
    public function setBody(string $value) : PHPMailer
    {
        $this->Body = $value;
        $this->isHtml($value != strip_tags($value));
        return $this;
    }


    /**
     * Append content to the end of the current email body
     * -------------------------------------------------------------------------
     * @param  string    $value     Content to append
     *
     * @return PHPMailer
     */
    public function appendToBody(string $value) : PHPMailer
    {
        $this->setBody($this->getBody() . $value);
        return $this;
    }


    /**
     * Get the email's main body
     * -------------------------------------------------------------------------
     * @return string   The email body
     */
    public function getBody() : string
    {
        return $this->Body;
    }

}
