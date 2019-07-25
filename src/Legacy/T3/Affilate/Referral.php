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

namespace TCorp\T3\Affilate;


/**
 * Helper class for working with T3 affilate referrals from other sites
 */
class Referral
{

    /**
     * The name of the URL parameter, which may exist - and if so, is expected
     * to contain an affilate id
     *
     * @var string
     */
    public static $urlParam = 'affilate';


    /**
     * The name of the cookie, which is responsiable
     * for storing the affilate id across page requests
     *
     * @var string
     */
    public static $cookieName = 'affilate';



    /**
     * Detect a new affilate referral and then update
     * -------------------------------------------------------------------------
     * @return  void
     */
    public static function detect()
    {
        if (isset($_GET[self::$urlParam])) {
            self::setId($_GET[self::$urlParam]);
        }
    }


    /**
     * Gets the current affilate id
     * -------------------------------------------------------------------------
     * @return mixed   The current affilate id, or FALSE in no referal has
     *                 been detected
     */
    public static function getId()
    {
        return (isset($_COOKIE[self::$cookieName])) ?
            $_COOKIE[self::$cookieName] : FALSE;
    }


    /**
     * Manually set/update the affilate id
     * -------------------------------------------------------------------------
     * @param   string    $id         A new affilate id
     * @param   bool      $validate   Check that the given value is valid
     * @return  void
     */
    public static function setId(string $id, bool $validate = TRUE)
    {
        if ($validate AND self::validateId($id)) {

            setrawcookie(self::$cookieName, $id);
            $_COOKIE[self::$cookieName] = $id;

        }
    }


    /**
     * Validate an affilate id. Valid T3 affilate ids consist of 12 uppercase
     * letters (new signups in T3); or 8 characters including lower case
     * letters and digits (T2 customers migrated to T3)
     * -------------------------------------------------------------------------
     * @return  bool   TRUE if the given id is valid, FALSE if not
     */
    protected static function validateId(string $id)
    {
        $result = preg_match('|^[A-Z]{12}$|', $id)
            OR preg_match('|^[A-Za-z0-9]{8}$|', $id);

        return (bool) $result;
    }


    /**
     * Determins if an affilate reffral has previously been detected
     * -------------------------------------------------------------------------
     * @return  bool TRUE if an affilate reffral has been detected, FALSE if not
     */
    public static function isReferral()
    {
        return self::getId() !== FALSE;
    }


    /**
     * Clear any existing affilate referal
     * -------------------------------------------------------------------------
     * @return  void
     */
    public static function clear()
    {
        setcookie(self::$cookieName, "", time()-3600);
        if (isset($_COOKIE[self::$cookieName])) {
            unset($_COOKIE[self::$cookieName]);
        }

    }


}
