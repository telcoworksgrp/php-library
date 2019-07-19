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

namespace TCorp\Sanitisation;


/**
 * Helper class for sanitisating various types of values
 */
class SanitisationHelper
{


    /**
     * Sanitise a given value
     * -------------------------------------------------------------------------
     * @param  mixed    $value  The value to sanitise. If an array is given
     *                          each value of the array will be sanitised
     * @param  string   $type   Data type to sanitise
     *
     * @return  mixed   The original value, but sanitised.
     */
    public static function sanitise($value, $type = 'STRING')
    {
        // If the given value is an array sanitise each element
        if (is_array($value)) {

            foreach ($value as &$element) {
                $element = self::sanitise($element, $type);
            }

            return $value;
        }

        // Sanitise the given value
        switch (strtoupper($type)) {
            case 'STRING':
                $result = strip_tags($value);
                break;

            case 'ABN':
                $result = preg_replace('|[^0-9]|i', '', $value);
                break;

            case 'EMAIL':
                $result = preg_replace('|[^\x20-\x7E]|i', '', $value);
                break;

            case 'PHONENO':
                $result = preg_replace('|[^0-9A-Z*+#)(]|i', '', $value);
                break;

            case 'IPV4':
                $result = preg_replace('|[^0-9.]|i', '', $value);
                break;

            case 'IPV6':
                $result = preg_replace('|[^0-9:]|i', '', $value);
                break;

            case 'IP':
                $result = preg_replace('|[^0-9.:]|i', '', $value);
                break;

        }

        // Return the result
        return $result;

    }


}
