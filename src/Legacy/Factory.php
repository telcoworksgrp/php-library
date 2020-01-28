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

namespace TCorp\Legacy;


/**
 * Factory class for creating new objects
 */
class Factory
{

    /**
     * Holds the global session object
     *
     * @var \TCorp\Legacy\Session
     */
    protected static $session =  null;


    /**
     * Holds the global form object
     *
     * @var \TCorp\Legacy\Form
     */
    protected static $form =  null;


    /**
     * Holds the global T3 client object
     *
     * @var \TCorp\Legacy\T3
     */
    protected static $t3 =  null;


    /**
     * Holds the global firewall object
     *
     * @var \TCorp\Legacy\Firewall
     */
    protected static $firewall =  null;



    /**
     * Get the global session object, creating it if nessary
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Session
     */
    public static function getSession()
    {
        if (is_null(static::$session)) {
            static::$session = new Session();
        }

        return static::$session;
    }


    /**
     * Get the global form object, creating it if nessary
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Form
     */
    public static function getForm()
    {
        if (is_null(static::$form)) {
            static::$form = new Form();
        }

        return static::$form;
    }


    /**
     * Get the global T3 client, creating it if nessary
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\T3
     */
    public static function getT3Client()
    {
        if (is_null(static::$t3)) {
            static::$t3 = new T3();
        }

        return static::$t3;
    }


    /**
     * Get the global firewall object, creating it if nessary
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Firewall
     */
    public static function getFirewall()
    {
        if (is_null(static::$firewall)) {
            static::$firewall = new Firewall();
        }

        return static::$firewall;
    }

}
