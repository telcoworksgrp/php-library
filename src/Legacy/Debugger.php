<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Legacy;


/**
 * Class to helper debug errors, etc
 */
class Debugger
{

    /**
     * Enable PHP error reporting
     * -------------------------------------------------------------------------
     * @param   bool    $enable True for full error reporting, False for none
     *
     * @return void
     */
    public static function enableErrorReporting(bool $enable = true) : void
    {
        if ($enable) {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        } else {
            error_reporting(E_NONE);
            ini_set('display_errors', 0);
        }
    }


}
