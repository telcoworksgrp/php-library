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

namespace TCorp\String;

class Helper
{

    /**
     * Strip all non-ascii charictars from a string
     * -------------------------------------------------------------------------
     * @param  string   $str    The string to work on
     *
     * @return string   A string without non-ascii charictars
     */
    public static function stripNonAscii(string $str)
    {
        return preg_replace('|[^\x20-\x7E]|','', $str);
    }

}
