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
 * Class that represents a phone number's extension code.
 */
class NumberExt extends NumberPart
{

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
