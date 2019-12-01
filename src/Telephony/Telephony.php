<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Telephony;


/**
 * Helper class for working with telecommunications, phone numbers, etc
 */
class Telephony
{

    /**
     * Converts all letters in a given value to phone numbers
     * -------------------------------------------------------------------------
     * @param  string   $value  The value to digitise
     *
     * @return string   A digitised version of the value given
     */
    public static function digitise(string $value)
    {
        // Replace all phone letters with numbers
        $result = preg_replace('|[abc]|i','2', $value);
        $result = preg_replace('|[def]|i','3', $result);
        $result = preg_replace('|[ghi]|i','4', $result);
        $result = preg_replace('|[jkl]|i','5', $result);
        $result = preg_replace('|[mno]|i','6', $result);
        $result = preg_replace('|[pqrs]|i','7', $result);
        $result = preg_replace('|[tuv]|i','8', $result);
        $result = preg_replace('|[wxyz]|i','9', $result);

        // Return the result
        return $result;
    }


    /**
     * Stip all charictars that can't be converted to a phone digits (all
     * charictars other than a-z,0-1,# and *)
     * -------------------------------------------------------------------------
     * @param  string   $value  The value to strip invalid chars from
     *
     * @return string   A new value without invalid charictars
     */
    public static function stripInvalidChars(string $value) : string
    {
        return preg_replace('|[^a-z0-9#*]|i', '', $value);
    }


    /**
     * Check if a given suffix/value contains phone words/letters
     * -------------------------------------------------------------------------
     * @param  string   $value  The number suffix/value to check
     *
     * @return bool True if value contains phone words/letters, false if not.
     */
    public static function containsPhoneWords(string $value) : bool
    {
        return preg_match('|[a-z#*]|i', $value);
    }


    /**
     * Arrange a string's charictars into groups
     * -------------------------------------------------------------------------
     * @param  string   $value      The value to group
     * @param  int      $size       Max size ofo each group
     * @param  string   $seperator  Charictar to seperate groups
     *
     * @return string
     */
    public static function group(string $value, int $size = 3,
        string $seperator = ' ') : string
    {
        return implode($seperator, str_split($value, $size));
    }


    /**
     * Extracts the first phone word found in a given value
     * -------------------------------------------------------------------------
     * @param  string   $value  Value from which to extract the phone word from
     *
     * @return string
     */
    public function extractPhoneWord(string $value) : string
    {
        return preg_replace('|^.*?([a-z]+).*$|i', '$1', $value);
    }

}
