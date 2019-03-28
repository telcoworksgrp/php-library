<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Telephony\Number;


/**
 * Class that represents ..
 * The first part of a land line number  ( eg: 3268 xxxx ), OR
 * The first part of a mobile nbumber ( eg: 0405 xxx xxx ), OR
 * The first part of special number ( eg: 1800 xxx xxx , 13 xx xx )
 */
class NumberPrefix extends NumberPart
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
