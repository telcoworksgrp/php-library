<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\T3;

use \TCorp\Legacy\Helper AS LegacyHelper;


/**
 * Helper class for working with Telecom Corp's T3 platform
 */
class Helper
{


    /**
     * Detects a T3 affilate refferal and sets the appropriate cookies so that
     * the affilate id is remebered across subsequent requests
     * -------------------------------------------------------------------------
     */
    public static function detectAffilateRefferal()
    {
        // If an "affilate" URL param exists, and it's value is a valid
        // affilate id then set an "affilate" cookie to remember that value
        // across subsequent requests
        if (isset($_GET['affilate']) AND self::validateAffilateId(
            $_GET['affilate'])) {

            setrawcookie('affilate', $_GET['affilate']);
        }
    }


    /**
     * Get the affilate id that has been last detected
     * -------------------------------------------------------------------------
     * @return string|bool  A affilate id on success, FALSE if none is found
     */
    public static function getAffilateRefferalId()
    {
        // Initialise some local variables
        $result = FALSE;

        // If an "affilate" URL param exits OR an "affilate" cookie has
        // previously been set - and in any case the value is valid -
        // then consider that value as the current affilate id
        if (isset($_REQUEST['affilate']) AND
            self::validateAffilateId($_REQUEST['affilate'])) {

            $result = $_REQUEST['affilate'];
        }

        // Return the result
        return $result;
    }


    /**
     * Check if a given T3 affilate id is valid. Valid T3 affilate ids consist
     * of 12 uppercase letters (new signups in T3); or 8 characters including
     * lower case letters and digits (T2 customers migrated to T3)
     * -------------------------------------------------------------------------
     * @param  string   $id     An affilate id to check
     * @return bool             TRUE is valid, FALSE is invalid
     */
    protected static function validateAffilateId(string $id) : bool
    {
        return (bool) preg_match('|^[A-Z]{12}$|', $id) OR
            LegacyHelper::validateT2AffilateId($id);
    }


}
