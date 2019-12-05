<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Telephony;


/**
 * Class for managing/manipulating 1300 adn 1800 phone numbers, etc
 */
class Number
{

    /**
     * The prefix part of the number
     *
     * @var string
     */
    protected $prefix = '';


    /**
     * The suffix part of the number (including overflow)
     *
     * @var string
     */
    protected $suffix = '';



    /**
     * Set the prefix part of the number
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value for the prefix
     *
     * @return \TCorp\Telephony\Number
     */
    public function setPrefix(string $value): Number
    {
        $this->prefix = $value;
        return $this;
    }


    /**
     * Set the suffix part of the number
     * -------------------------------------------------------------------------
     * @param  string   $value  A new value for the suffix
     *
     * @return \TCorp\Telephony\Number
     */
    public function setSuffix(string $value): Number
    {
        $this->suffix = trim($this->suffix);
        return $this;
    }


    /**
     * Get the prefix part of the number
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getPrefix() : string
    {
        return $this->prefix;
    }


    /**
     * Get the suffix part of the number
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getSuffix(bool $digits = false, int $grouping = 0) : string
    {
        return substr($this->suffix, 0, 6);
    }


    /**
     * Get the overflow part of the number
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getOverflow(bool $digits = false, int $grouping = 0) : string
    {
        return substr($this->suffix, -6);
    }


    /**
     * Get the first phone word found in the suffix
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getPhoneword() : string
    {
        return preg_replace('|^.*?([a-z]+).*$|i', '$1', $this->suffix);
    }

}
