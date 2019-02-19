<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Google;

/**
 * Class for working with Google Analytics
 */
class Analytics
{

    /**
     * Get Google's tracking code snippit.
     * -------------------------------------------------------------------------
     * @param  string   $tackingId  A tracking id obtained from Google Analytics
     * @return string   Tracking code snippet
     */
    public static function getTrackingCode(string $tackingId)
    {
        return "<script async src=""https://www.googletagmanager.com/gtag/" .
            "js?id=$trackingId""></script><script>window.dataLayer = window.".
            "dataLayer || []; function gtag(){dataLayer.push(arguments);} ".
            "gtag('js',new Date()); gtag('config','$trackingId'); </script>";
    }

}
