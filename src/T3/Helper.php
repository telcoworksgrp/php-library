<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\T3;


/**
 * Helper class for working with Telecom Corporate's T3 system
 */
class Helper
{


    /**
     * Detect if this request includes a T3 affilate refferal and set the
     * approipiate cookies/session vars.
     * -------------------------------------------------------------------------
     */
    public static function detectAffliateRefferal()
    {
        $affilateId = (isset($_GET['affiliate'])) ? $_GET['affiliate'] : FALSE;

        if (!empty($affilateId) AND self::validateAffilateId($affilateId)) {
            setrawcookie('affiliate', $affilateId);
        }      

    }


    /**
     * Check if a given T3 affilate id is valid. Valid T3 affilate ids consist
     * of 12 uppercase letters (new signups in T3); or 8 characters including
     * lower case letters and digits (T2 customers migrated to T3)
     * -------------------------------------------------------------------------
     * @param  string   $id     An affilate id to check
     * @return bool             TRUE is valid, FALSE is invalid
     */
    public static function validateAffilateId(string $id)
    {
        return (bool) preg_match('|^(?:[A-Z]{12}|[A-Za-z0-9]{8})$|', $id);
    }



}
