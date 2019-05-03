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
 * Helper class for working with dates and times
 */
class DateTimeHelper
{

    /**
     * Convert a given number of seconds into a hour:minute:seconds string
     * -------------------------------------------------------------------------
     * @param  int      $seconds    The value to convert
     * @param  string   $separator  Charictar/string to seperate the hr,min,sec.
     *
     * @return string   A string containing hours, minutes and seconds
     */
    public static function secondsToHMS($seconds, $separator = ':')
    {
        // Compose the result
        $hrs    = str_pad(floor($seconds/3600), 2, '0', STR_PAD_LEFT);
        $min    = str_pad(($seconds/60) % 60, 2, '0', STR_PAD_LEFT);
        $sec    = str_pad($seconds % 60, 2, '0', STR_PAD_LEFT);
        $result = $hrs . $separator . $min . $separator . $sec;

        // Return the result
        return $result;
    }


}
