<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Legacy\T2;

/**
 * Helper class for working with Telecom Corporate's Legacy T2 system
 */
class Helper
{

    /**
     * Detect if this request includes a T2 affilate refferal and set the
     * approipiate cookies/session vars.
     * -------------------------------------------------------------------------
     */
    public static function detectAffliateRefferal()
    {
        $affilateId = (isset($_GET['affid'])) ? $_GET['affid'] : FALSE;

        if (!empty($affilateId) AND self::validateAffilateId($affilateId)) {
            setrawcookie('affid', $affilateId);
        }

    }


    /**
     * Check if a given T2 affilate id is valid. Valid T2 affilate ids consist
     * 8 characters including lower case letters and digits
     * -------------------------------------------------------------------------
     * @param  string   $id     An affilate id to check
     * @return bool             TRUE is valid, FALSE is invalid
     */
    public static function validateAffilateId(string $id)
    {
        return (bool) preg_match('|^[A-Za-z0-9]{8}$|', $id);
    }

}
