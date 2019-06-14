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


class TelephonyHelper
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
     * Compacts/ removes all whitespace the given value
     * -------------------------------------------------------------------------
     * @param  string   $value  Value to compact/remove all whitespace from
     *
     * @return string   A compacted version of the value given
     */
    public static function compact(string $value)
    {
        return preg_replace('|\s|','', $value);
    }


    /**
     * Truncates a given value.
     * -------------------------------------------------------------------------
     * @param   string   $value        The value to truncate
     * @param   int      $length       Max length the result should be
     * @param   bool     $whitspace    Include whitespace in char count
     * @param   bool     $truncLeft    TRUE=truncate left, FALSE=truncate right
     *
     * @return  string  A truncated version of the value given
     */
    public static function truncate(string $value, int $length = 0, bool
    $whitspace = false, bool $truncLeft = false)
    {
        // If the value is empty or the maximum length is 0 then
        // then is no need to continue
        if (empty($value) OR ($length == 0)) {
            return $value;
        }

        // Compose the appropriate regex
        if ($whitspace) {
            if ($truncLeft) {
                $regex = '|^(.{0,' . $length . '}).*$|i';
            } else {
                $regex = '|^.*?(.{0,' . $length . '})$|i';
            }
        } else {
            if ($truncLeft) {
                $regex = '|^((?:\s*[0-9A-Z]\s*){0,' . $length . '}).*$|i';
            } else {
                $regex = '|^.*?((?:\s*[0-9A-Z]\s*){0,' . $length . '})$|i';
            }
        }

        // Truncate the value
        $result = preg_replace($regex, '$1', $value);

        // Return the result
        return $result;
    }


    /**
     * Format a prefix, number option and suffix
     * -------------------------------------------------------------------------
     * @param  string $pattern [description]
     * @param  string $prefix  [description]
     * @param  string $numopt  [description]
     * @param  string $suffix  [description]
     *
     * @return [type]          [description]
     *
     * P = Prefix
     * O = Option
     * S = Suffix
     * X = Option + space + Suffix
     * D = Digitise (Convert to digits)
     * C = Compact (Remove all non-alphanumberic chars)
     * 0-9 = Maximum Length
     * L = Truncate left (instead of right)
     */
    public static function format(string $pattern, string $prefix,
        string $numopt, string $suffix)
    {
        // Initlise some local variables
        $result = trim($pattern);

        // Replace tokens
        $result = preg_replace_callback('|{([POSXDC0-9L]*)}|i',
            function($match) use ($prefix, $numopt, $suffix) {

            $replace = '';
            $params = str_split($match[1]);

            $replace = (in_array('P', $params)) ? $prefix : $replace;
            $replace = (in_array('O', $params)) ? $numopt : $replace;
            $replace = (in_array('S', $params)) ? $suffix : $replace;
            $replace = (in_array('X', $params)) ? $numopt . ' ' . $suffix : $replace;

            $replace = (in_array('D', $params)) ? self::digitise($replace) : $replace;
            $replace = (in_array('C', $params)) ? self::compact($replace) : $replace;

            if (preg_match('|[0-9]|', $match[1])) {
                $maxLength = (int) preg_replace('|.*?([0-9]).*|', '$1', $match[1]);
                $truncLeft = in_array('L', $params);
                $replace = self::truncate($replace, $maxLength, false, !$truncLeft);
            }

            return $replace;

        }, $result);

        // Return the result
        return $result;
    }


    public static function format2($prefix, $suffix)
    {

    }



}
