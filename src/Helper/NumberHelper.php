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

namespace TCorp\Helper;


/**
 * Helper class for working with numbers
 */
class NumberHelper
{


    /**
     * Convert a given integer into an ordial number ending is 'st', 'nd', 'rd'
     * or 'th'. (eg: 103 => '103rd')
     * -------------------------------------------------------------------------
     * @param  int    $number   Integer to convert
     *
     * @return string   An ordinal number with the appropriate suffix
     */
    public static function toOrdinal(int $number) : string
    {
        $suffixes = array('th','st','nd','rd','th','th','th','th','th','th');

        if ((($number % 100) >= 11) && (($number % 100) <= 13))
            return $number . 'th';
        else
            return $number . $suffixes[$number % 10];
    }


}
