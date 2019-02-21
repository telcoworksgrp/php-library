<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Telephony;

/**
 * Class for working with telephone numbers
 */
class Number
{



    /**
     * An international dialling prefix sometimes used to dial out of a
     * country when making an international call.
     *
     * @var string
     */
    protected $intlPrefix  = '0011'


    /**
     * A country calling code for the number, exluding the prefix
     *
     * @var string
     */
    protected $ctryCode = '61';


    /**
     * An area code. In Australia this wuld be 02,03,04,07 or 08
     *
     * @var string
     */
    protected $areaCode = '';


    /**
     * The first part of a land line number  ( eg: 3268 xxxx ), OR
     * The first part of a mobile nbumber ( eg: 0405 xxx xxx ), OR
     * The first part of special number ( eg: 1800 xxx xxx , 13 xx xx )
     *
     * @var string
     */
    protected $prefix = '';


    /**
     * Remaining part of a landline number (eg:xxxx 1234), OR
     * Remaining part of a mobile number (eg: xxxx 123 456), OR
     * Remaining part of a special number (eg: xxxx 122 )
     *
     * May contain phone letters/words (eg: xxxx CARS4U )
     *
     * @var string
     */
    protected $suffix = '';



    /**
     * Get the number's international dialling prefix which is sometimes used
     * to dial out of a country when making an international call.
     * -------------------------------------------------------------------------
     * @return  string  The number's international dialling prefix
     */
    public function getIntlPrefix()
    {
        return $this->intlPrefix;
    }


    /**
     * Get the number's country calling code for the number (without prefix)
     * -------------------------------------------------------------------------
     * @return  string  The number's country calling code
     */
    public function getCtryCode()
    {
        return $this->ctryCode;
    }


    /**
     * Get the number's area code - without brackets,etc - and optionally
     * without leading zeros.
     * -------------------------------------------------------------------------
     * @param   bool    $trim  Trim any leading zeros (eg 07 => 7)
     * @return  string  The number's area code
     */
    public function getAreaCode(bool $trim = false)
    {
        $result = ($trim) ? ltrim($result, '0') : $result ;
        return $this->areaCode;
    }


    /**
     * Get the number's prefix
     * -------------------------------------------------------------------------
     * @return  string  The number's prefix
     */
    public function getPrefix()
    {
        return $this->prefix;
    }


    /**
     * Get the number's prefix
     * -------------------------------------------------------------------------
     * @return  string  The number's prefix
     */
    public function getSuffix()
    {
        return $this->suffix;
    }


    /**
     * Set the number's international dialling prefix.
     * -------------------------------------------------------------------------
     * @param string    $value     A new value
     */
    public function setIntlPrefix(string $value)
    {
        $this->intlPrefix = preg_replace('|[^0-9]|', '', $value);
    }


    /**
     * Set the number's country code
     * -------------------------------------------------------------------------
     * @param string    $value     A new value
     */
    public function setCtryCode(string $value)
    {
        $this->ctryCode = preg_replace('|[^0-9]|', '', $value);
    }


    /**
     * Set the number's area code
     * -------------------------------------------------------------------------
     * @param string    $value     A new value
     */
    public function setAreaCode(string $value)
    {
        $this->areaCode = preg_replace('|[^0-9]|', '', $value);
    }


    /**
     * Set the number's prefix
     * -------------------------------------------------------------------------
     * @param string    $value     A new value
     */
    public function setPrefix(string $value)
    {
        $this->prefix = preg_replace('|[^0-9]|', '', $value);
    }


    /**
     * Set the number's suffix
     * -------------------------------------------------------------------------
     * @param string    $value     A new value
     */
    public function setSuffix(string $value)
    {
        $value = strtoupper($value);
        $this->suffix = preg_replace('|[^0-9A-Z]|', '', $value);
    }

}
