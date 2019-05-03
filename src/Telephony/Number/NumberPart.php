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

namespace TCorp\Telephony\Number;



/**
 * Base class the various parts of a phone number
 */
class NumberPart
{

    /**
     * The value of the the phone number part
     *
     * @var string
     */
    protected $value = '';


    /**
     * A prefix often added to the value when displayed
     *
     * @var string
     */
    protected $prefix = '';


    /**
     * A suffix often added to the value when displayed
     *
     * @var string
     */
    protected $suffix = '';



    /**
     * Constructor method for initialising new instances of this class
     * -------------------------------------------------------------------------
     */
    public function __construct(string $value = '')
    {
        // Initialise the part's number
        $this->setValue($value);
    }


    /**
     * Get the current value of this number part
     * -------------------------------------------------------------------------
     * @return string    The current value of the number part
     */
    public function getValue()
    {
        return $this->value;
    }


    /**
     * Set the current value of this number part
     * -------------------------------------------------------------------------
     * @param string    $value  A new value for this number part
     */
    public function setValue($value)
    {
        $this->value = $value;
    }


    /**
     * Get the current prefix for this number part
     * -------------------------------------------------------------------------
     * @return string    The current prefix for this number part
     */
    public function getPrefix()
    {
        return $this->prefix;
    }


    /**
     * Set the current prefix for this number part
     * -------------------------------------------------------------------------
     * @param string    $value  A new prefix for this number part
     */
    public function setPrefix($value)
    {
        $this->prefix = $value;
    }


    /**
     * Get the current suffix for this number part
     * -------------------------------------------------------------------------
     * @return string    The current suffix for this number part
     */
    public function getSuffix()
    {
        return $this->suffix;
    }


    /**
     * Set the current suffix for this number part
     * -------------------------------------------------------------------------
     * @param string    $value  A new suffix for this number part
     */
    public function setSuffix($value)
    {
        $this->suffix = $value;
    }


}
