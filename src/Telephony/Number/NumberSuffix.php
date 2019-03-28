<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Telephony\Number;



/**
 * Class that represents ..
 * Remaining part of a landline number (eg:xxxx 1234), OR
 * Remaining part of a mobile number (eg: xxxx 123 456), OR
 * Remaining part of a special number (eg: xxxx 122 )
 *
 * May contain phone letters/words (eg: xxxx CARS4U )
 */
class NumberSuffix extends NumberPart
{
    /**
     * Set the current value of this number part
     * -------------------------------------------------------------------------
     * @param string    $value  A new value for this number part
     */
    public function setValue($value)
    {
        $this->value = preg_replace('|[^0-9A-Z]|i', '', $value);
        $this->value = strtoupper($this->value);
    }

}
