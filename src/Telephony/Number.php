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

namespace TCorp\Telephony;


/**
 * Class for working with telephone numbers
 */
class Number
{

    /**
     * An international dialling prefix for the number
     *
     * @var string
     */
    protected $intlCode = "0011";


    /**
     * A country calling code for the phone number
     *
     * @var string
     */
    protected $countryCode = "61";


    /**
     * A charictar often used to prefix the country code
     *
     * @var string
     */
    protected $countryCodePrefix = "+";


    /**
     * An area code for the phone number.
     *
     * @var string
     */
    protected $areaCode = "7";


    /**
     * A charictar for padding the number's area code
     *
     * @var string
     */
    protected $areaCodePadChar = "0";


    /**
     * A prefix for the number. This is usually something like 3268 (landline),
     * 1300 (premium), 1800 (free call), 0405 (mobile), etc. Prefixes contain
     * 1-4 digits only.
     *
     * @var string
     */
    protected $prefix = "";


    /**
     * A suffix for the number. Suffixes can contain both digits and/or letters
     * (which often spell out a word). The maximum number of chars stored in
     * this property is determined by $maxSuffixLength. Addtional chars are
     * consider to be overdial chars and thus stored in the $ovedial property.
     *
     * @var string
     */
    protected $suffix = "";


    /**
     * The maximum number of chars that the suffix should contain
     *
     * @var int
     */
    protected $maxSuffixLength = 6;


    /**
     * An overdial for the number's suffix. An overdial can contain both
     * digits and/or letters (which can spell out a word).
     *
     * @var string
     * @see Number::$suffix     For more info about suffixes and overdial
     */
    protected $overdial = ""


    /**
     * An extension for the number. Extensions contain digits only.
     *
     * @var string
     */
    protected $extension = "";


    /**
     * Set the number's international calling code
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     *
     * @return void
     */
    public function setIntlCode(string $value = '') : void
    {
        $this->intlCode = preg_replace('|\D|i', '', $value);
    }


    /**
     * Get the number's international calling code
     * -------------------------------------------------------------------------
     * @return string   The number's international calling code
     */
    public function getIntlCode() : string
    {
        return $this->intlCode;
    }


    /**
     * Set the number's country code
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     *
     * @return void
     */
    public function setCountryCode(string $value = '') : void
    {
        $this->countryCode = preg_replace('|\D|i', '', $value);
    }


    /**
     * Get the number's country code
     * -------------------------------------------------------------------------
     * @param  bool     $withPrefix     Prepend the country code prefix
     *
     * @return string   The number's country code
     */
    public function getCountryCode(bool $withPrefix = true) : string
    {
        $result = $this->countryCode;

        if ($withPrefix) {
            $result = $this->getCountryCodePrefix() . $result;
        }

        return $result;
    }


    /**
     * Set the number's country code prefix
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     *
     * @return void
     */
    public function setCountryCodePrefix(string $value = '') : void
    {
        $this->countryCodePrefix = trim($value);
    }


    /**
     * Get the number's country code prefix
     * -------------------------------------------------------------------------
     * @return string   The number's country code prefix
     */
    public function getCountryCodePrefix() : string
    {
        return $this->countryCodePrefix;
    }


    /**
     * Set the number's area code
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     *
     * @return void
     */
    public function setAreaCode(string $value = '') : void
    {
        $this->areaCode = preg_replace('|\D|i', '', $value);
    }


    /**
     * Get the number's area code
     * -------------------------------------------------------------------------
     * @param bool  $withPadding    Prepend the area code pad char
     *
     * @return string   The number's area code
     */
    public function getAreaCode(bool $withPadding = true) : string
    {
        $result = $this->areaCode;

        if ($withPadding) {
            $result = $this->getAreaCodePrefix() . $result;
        }

        return $result;
    }


    /**
     * Set the number's area code prefix
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     *
     * @return void
     */
    public function setAreaCodePrefix(string $value = '') : void
    {
        $this->areaCodePrefix = trim($value);
    }


    /**
     * Get the number's area code prefix
     * -------------------------------------------------------------------------
     * @return string   The number's area code prefix
     */
    public function getAreaCodePrefix() : string
    {
        return $this->areaCodePrefix;
    }


    /**
     * Set the number's prefix
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     *
     * @return void
     */
    public function setPrefix(string $value = '') : void
    {
        $this->prefix = preg_replace('|\D|i', '', $value);
        $this->prefix = substr($this->prefix, 0, 4);
    }


    /**
     * Get the number's prefix
     * -------------------------------------------------------------------------
     * @return string   The number's prefix
     */
    public function getPrefix() : string
    {
        return $this->prefix;
    }


    /**
     * Set the number's suffix to first $maxSuffixLength chars of the given
     * value. By default, all additional chars are set as the overdial.
     * -------------------------------------------------------------------------
     * @param string    $value          A new value
     * @param bool      $setOverdial    Set the number's overdial the value
     *                                  exceeds the maximum suffix length
     *
     * @return void
     */
    public function setSuffix(string $value = '', bool $setOverdial = true) : void
    {
        $value           = preg_replace('|[^0-9A-Z]|i', '', $value);
        $maxSuffixLength = $this->getMaxSuffixLength();

        $this->suffix = substr($value, 0, $maxSuffixLength);

        if (strlen($value) > $maxSuffixLength){
            $this->setOverdial(substr($value, $maxSuffixLength));
        }
    }


    /**
     * Get the number's suffix
     * -------------------------------------------------------------------------
     * @return string   The number's suffix
     */
    public function getSuffix() : string
    {
        return $this->suffix;
    }


    /**
     * Set the maximum suffix length. The number's prefix, suffix and overdial
     * is automatically adjusted according to the new maximum suffix length.
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     *
     * @return void
     */
    public function setMaxSuffixLength(int $value = '') : void
    {
        $this->maxSuffixLength = $value;
        $this->setSuffix($this->getSuffix() . $this->getOverdial(), true);
    }


    /**
     * Get the maximum suffix length
     * -------------------------------------------------------------------------
     * @return string   The maximum suffix length
     */
    public function getMaxSuffixLength() : string
    {
        return $this->maxSuffixLength;
    }


    /**
     * Set the number's overdial
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     *
     * @return void
     */
    public function setOverdial(string $value = '') : void
    {
        $this->overdial = preg_replace('|[^0-9A-Z]|i', '', $value);
    }


    /**
     * Get the number's overdial
     * -------------------------------------------------------------------------
     * @return string   The number's overdial
     */
    public function getOverdial() : string
    {
        return $this->overdial;
    }


    /**
     * Set the number's extension
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     *
     * @return void
     */
    public function setExtension(string $value = '') : void
    {
        $this->extension = preg_replace('|\D|i', '', $value);
    }


    /**
     * Get the number's extension
     * -------------------------------------------------------------------------
     * @return string   The number's extension
     */
    public function getExtension() : string
    {
        return $this->extension;
    }


}
