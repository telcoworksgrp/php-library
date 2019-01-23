<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Legacy;

/**
 * Helper class for TCORP legacy websites
 */
class Helper
{


    /**
     * Detect if this request includes a T2 affilate refferal and set the
     * approipiate cookies/session vars
     * -------------------------------------------------------------------------
     */
    public static function detectT2AffliateRefferal()
    {

        if (isset($_GET['affid'])) {
            $affid = preg_replace('|[^0-9A-Z]|i', '', $_GET['affid']);
            setrawcookie('affid', $affid);
        }

    }


    /**
     * Check if this or a previous request has included a T2 affilate referral
     * -------------------------------------------------------------------------
     * @return  bool     TRUE if this/previous request included a T2
     *                   affilate referral, FALSE if not
     */
    public static function isT2AffilateReferral()
    {
        return isset($_REQUEST['affid']);
    }


    /**
     * Detect if this request includes a T3 affilate refferal and set the
     * approipiate cookies/session vars
     * -------------------------------------------------------------------------
     */
    public static function detectT3AffliateRefferal()
    {

        if (isset($_GET['affiliate'])) {
            $affilate = preg_replace('|[^0-9A-Z]|i', '', $_GET['affiliate']);
            setrawcookie('affiliate', $affilate);
        }

    }


    /**
     * Check if this or a previous request has included a T3 affilate referral
     * -------------------------------------------------------------------------
     * @return  bool     TRUE if this/previous request included a T3
     *                   affilate referral, FALSE if not
     */
    public static function isT3AffilateReferral()
    {
        return isset($_REQUEST['affiliate']);
    }


    /**
     * Detect if this request includes ANY affilate refferal and set the
     * approipiate cookies/session vars
     * -------------------------------------------------------------------------
     */
    public static function detectAffliateRefferal()
    {
        self::detectT2AffliateRefferal();
        self::detectT3AffliateRefferal();
    }


    /**
     * Check if this or a previous request has included ANY affilate referral
     * -------------------------------------------------------------------------
     * @return  bool     TRUE if this/previous request included a affilate
     *                   referral, FALSE if not
     */
    public static function isAffilateReferral()
    {
        return self::isT2AffilateReferral OR self::isT3AffilateReferral;
    }

}
