<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Telephony\Number;



/**
 * Class that represents a phone number's international dialing code. Within
 * Australia this is 0011
 */
class NumberIntlCode extends NumberPart
{

    /**
     * The phone number's international dialing code
     *
     * @var string
     */
    protected $value = '0011';



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
