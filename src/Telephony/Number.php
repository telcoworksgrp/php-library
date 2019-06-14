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
    protected $overdial = "";


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
    public function setIntlCode(string $value) : void
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
    public function setCountryCode(string $value) : void
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
    public function setCountryCodePrefix(string $value) : void
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
    public function setAreaCode(string $value) : void
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
            $result = $this->getAreaCodePadChar() . $result;
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
    public function setAreaCodePadChar(string $value) : void
    {
        $this->areaCodePadChar = trim($value);
    }


    /**
     * Get the number's area code prefix
     * -------------------------------------------------------------------------
     * @return string   The number's area code prefix
     */
    public function getAreaCodePadChar() : string
    {
        return $this->areaCodePadChar;
    }


    /**
     * Set the number's prefix
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     *
     * @return void
     */
    public function setPrefix(string $value) : void
    {
        $this->prefix = preg_replace('|\D|i', '', $value);

        // Set the max suffix length for known number prefixes
        switch ($this->prefix) {
            case "1300":
            case "1800":
                $this->setMaxSuffixLength(6);
                break;

            case "13":
                $this->setMaxSuffixLength(4);
        }
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
    public function setSuffix(string $value, bool $setOverdial = true) : void
    {
        $value = preg_replace('|[^0-9A-Z]|i', '', $value);
        $maxSuffixLength = $this->getMaxSuffixLength();

        $this->suffix = substr($value, 0, $maxSuffixLength);

        if (strlen($value) > $maxSuffixLength){
            $this->setOverdial(substr($value, $maxSuffixLength));
        }
    }


    /**
     * Get the number's suffix
     * -------------------------------------------------------------------------
     * @param  boolean $asDigits        Convert all letters to digits
     * @param  integer $grpLength       Group size/length to seperate chars into
     * @param  string  $grpSeperator    String to seperate chars with
     *
     * @return string   The number's suffix
     */
    public function getSuffix(bool $asDigits = false, int $grpLength = 0,
        string $grpSeperator = ' ') : string
    {
        $result = $this->suffix;

        if ($asDigits) {
            $result = TelephonyHelper::digitise($result);
        }

        if ($grpLength) {
            $result = implode($grpSeperator, str_split($result, $grpLength));
        }

        return $result;
    }


    /**
     * Set the maximum suffix length. The number's suffix and overdial
     * is automatically adjusted according to the new maximum suffix length.
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     *
     * @return void
     */
    public function setMaxSuffixLength(int $value) : void
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
    public function setOverdial(string $value) : void
    {
        $this->overdial = preg_replace('|[^0-9A-Z]|i', '', $value);
    }


    /**
     * Get the number's overdial
     * -------------------------------------------------------------------------
     * @param  boolean $asDigits        Convert all letters to digits
     * @param  integer $grpLength       Group size/length to seperate chars into
     * @param  string  $grpSeperator    String to seperate chars with
     *
     * @return string   The number's overdial
     */
    public function getOverdial(bool $asDigits = false, int $grpLength = 0,
        string $grpSeperator = ' ') : string
    {
        $result = $this->overdial;

        if ($asDigits) {
            $result = TelephonyHelper::digitise($result);
        }

        if ($grpLength) {
            $result = implode($grpSeperator, str_split($result, $grpLength));
        }

        return $result;
    }


    /**
     * Set the number's extension
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     *
     * @return void
     */
    public function setExtension(string $value) : void
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


    /**
     * Composes a number based on a custom pattern
     * -------------------------------------------------------------------------
     * @param  string   $pattern    Pattern to format the number to. Tokens:
     *                              I - International Code
     *                              C - Country Code (with prefix)
     *                              c - Country Code (without prefix)
     *                              A - Area Code (with padding)
     *                              a - Area Code (without Padding)
     *                              P - Prefix
     *                              S - Suffix
     *                              s - Suffix (as Digits)
     *                              T - Suffix (in 2 char groups)
     *                              U - Suffix (in 3 char groups)
     *                              V - Suffix (as Digits, 2 char groups)
     *                              W - Suffix (as Digits, 3 char groups)
     *                              O - Overdial
     *                              o - Overdial (as Digits)
     *                              Q - Overdial (in 2 char groups)
     *                              R - Overdial (in 3 char groups)
     *                              X - Overdial (as Digits, 2 char groups)
     *                              Y - Overdial (as Digits, 3 char groups)
     *                              E - Extension
     *
     *                              Escape any of the above charictars with "\".
     *                              eg: "\The \Prefix i\s P"
     *
     *
     * @return string   A custom formatted number
     */
    public function format(string $pattern = "") : string
    {
        // Intialise some local variables
        $tokens = "ICcAaPSsTUVWOoQRXYE";
        $result = $pattern;

        // Replace tokens with the corrasponding values
        $result = preg_replace_callback("|(?<!\\\\)[$tokens]|",
        function($match) {

            switch ($match[0]) {
                case 'I': return $this->getIntlCode();
                case 'C': return $this->getCountryCode();
                case 'c': return $this->getCountryCode(false);
                case 'A': return $this->getAreaCode();
                case 'a': return $this->getAreaCode(false);
                case 'P': return $this->getPrefix();
                case 'S': return $this->getSuffix();
                case 's': return $this->getSuffix(true);
                case 'T': return $this->getSuffix(false, 2);
                case 'U': return $this->getSuffix(false, 3);
                case 'V': return $this->getSuffix(true, 2);
                case 'W': return $this->getSuffix(true, 3);
                case 'O': return $this->getOverdial();
                case 'o': return $this->getOverdial(true);
                case 'Q': return $this->getOverdial(false, 2);
                case 'R': return $this->getOverdial(false, 3);
                case 'X': return $this->getOverdial(true, 2);
                case 'Y': return $this->getOverdial(true, 3);
                case 'E': return $this->getExtension();
            }

        }, $result);

        // Replace any escaped charictars
        $result = preg_replace("|\\\\([$tokens])|", '$1', $result);

        // Clean up the result
        $result = trim($result);

        // Return the result
        return $result;
    }


}
