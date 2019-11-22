<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp;


/**
 * Class for sanitising various types of values
 */
class Sanitiser
{

    /**
     * Sanitise a given value
     * -------------------------------------------------------------------------
     * @param  mixed    $value      The value to sanitise
     * @param  string   $type       Expected data type (for sanitisation)
     *
     * @return mixed
     */
    public static function sanitise($value, $type = 'string')
    {
        switch (strtolower($type)) {

            case 'int':
                $result = preg_replace('|[^0-9-]|i', '', $value);
                break;

            case 'hex':
                $result = preg_replace('|[^0-9A-F]|i', '', $value);
                break;

            case 'float':
                $result = preg_replace('|[^0-9.-]|i', '', $value);
                break;

            case 'base64':
                $result = preg_replace('|[^0-9A-Z+\/=]|i', '', $value);
                break;

            case 'tel':
                $result = preg_replace('|[^0-9A-Z+)( ]|i', '', $value);
                break;

            case 'raw':
                $result = $value;
                break;

            default:
                $result = htmlspecialchars($value);
                break;
        }

        return $result;
    }

}
