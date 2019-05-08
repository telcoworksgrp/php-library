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
 * Class that represents a phone number's country code. In Australia this
 * is 61
 */
class NumberArea extends NumberPart
{

    /**
     * The phone number's area code
     *
     * @var string
     */
    protected $value = '61';


    /**
     * A prefix often added to the value when displayed
     *
     * @var string
     */
    protected $prefix = '+';



    /**
     * Set the current value of this number part
     * -------------------------------------------------------------------------
     * @param string    $value  A new value for this number part
     */
    public function setValue($value)
    {
        $this->value = preg_replace('|[^0-9]|', '', $value);
    }

}
