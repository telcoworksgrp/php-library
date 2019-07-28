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

use \KWS\Google\GoogleHelper;
use \KWS\Helper\ArrayHelper;


/**
 * A general helper class for Telecom Corporate projects
 */
class TCorpHelper
{

    /**
     * Get Google's tracking code snippit.
     * -------------------------------------------------------------------------
     * @param  string   $tackingId  A tracking id obtained from Google Analytics
     *
     * @return string   Tracking code snippet
     */
    public static function getAnalyticsTrackingCode(string $tackingId)
    {
        return GoogleHelper::getAnalyticsTrackingCode($tackingId);
    }


    /**
     * Convert an associtive array into a CSS rule. Keys are treated as CSS
     * property names and values are treated as values for the corrasponding
     * property.
     * ------------------------------------------------------------------------
     * @param  string  $selector       A CSS selector for the CSS rule
     * @param  array   $properties     A list of CSS property => value pairs
     *
     * @return string  A CSS rule
     */
     public static function arrayToCSSRule(string $selector, array $properties) : string
     {
        // Return the result
        return ArrayHelper::toCSSRule($selector, $properties);
   }



}
