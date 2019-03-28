<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Telephony\Number;



/**
 * Class that represents a phone number's area code. In Australia this
 * would be 02,03,04,07 or 08
 */
class NumberArea extends NumberPart
{

    /**
     * A prefix often added to the value when displayed
     *
     * @var string
     */
    protected $prefix = '(';


    /**
     * A suffix often added to the value when displayed
     *
     * @var string
     */
    protected $suffix = ')';



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
