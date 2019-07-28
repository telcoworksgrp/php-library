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

    

}
