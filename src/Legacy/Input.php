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

namespace TCorp\Legacy;

use \KWS\Sanitisation\SanitisationHelper;


class Input
{

    /**
     * Get a the value of a given GET, POST or COOKIE variable
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the get,post or cookie variable
     * @param  mixed    $default    A default value in case none exists.
     * @param  string   $filter     Filter type for sanitization
     *
     * @return mixed    The value of the ger/post/cookie variable
     */
    public static function getValue(string $name, $default = null,
        string $filter = 'STRING')
    {
        if (isset($_REQUEST[$name])) {
            SanitisationHelper::sanitise($_REQUEST[$name], $filter);
        } else {
            return $default;
        }
    }

}
