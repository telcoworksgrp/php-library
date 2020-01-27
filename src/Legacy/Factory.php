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
     * Holds the global form object
     *
     * @var \Legacy\Form
     */
    protected static $form =  null;


    /**
     * Holds the global T3 client object
     *
     * @var \Legacy\T3
     */
    protected static $t3 =  null;


    /**
     * Holds the global firewall object
     *
     * @var \Legacy\Firewall
     */
    protected static $firewall =  null;



    /**
     * Get the global form object, creating it if nessary
     * -------------------------------------------------------------------------
     * @return \Legacy\Form
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
     * @return \Legacy\T3
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
     * @return \Legacy\Firewall
     */
    public static function getFirewall()
    {
        if (is_null(static::$firewall)) {
            static::$firewall = new Firewall();
        }

        return static::$firewall;
    }

}
