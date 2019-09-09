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
 * Class to help with debugging
 */
class Debugger
{

    /**
     * Enable PHP error reporting
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function enableReporting() : void
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    }

}
