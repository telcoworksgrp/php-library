<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Legacy\T2;


/**
 * Helper class for working with Telecom Corp's Legacy T2 platform
 */
class Helper
{


    /**
     * Detects a T2 affilate refferal and sets the appropriate cookies so that
     * the affilate id is remebered across subsequent requests
     * -------------------------------------------------------------------------
     */
    public static function detectAffilateRefferal()
    {
        // If an "affid" URL param exists, and it's value is a valid affilate
        // id then set an "affid" cookie to remember that value across
        // subsequent requests
        if (isset($_GET['affid']) AND self::validateAffilateId(
            $_GET['affid'])) {

            setrawcookie('affid', $_GET['affid']);
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

        // If an "affid" URL param exits OR an "affid" cookie has
        // previously been set - and in any case the value is valid -
        // then consider that value as the current affilate id
        if (isset($_REQUEST['affid']) AND
            self::validateAffilateId($_REQUEST['affid'])) {

            $result = $_REQUEST['affid'];
        }

        // Return the result
        return $result;
    }


    /**
     * Check if a given T2 affilate id is valid. Valid T2 affilate ids consist
     * 8 characters including lower case letters and digits
     * -------------------------------------------------------------------------
     * @param  string   $id     An affilate id to check
     * @return bool             TRUE is valid, FALSE is invalid
     */
    protected static function validateAffilateId(string $id) : bool
    {
        return (bool) preg_match('|^[A-Za-z0-9]{8}$|', $id);
    }


}
