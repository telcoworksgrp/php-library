<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp;


/**
 * Factory class for creating and/or getting global class instances
 */
class Factory
{

    /**
     * Holds the global input object
     *
     * @var \TCorp\Input
     */
    protected static $input = null;


    /**
     * Gets a global input object, creating it if necessary
     * -------------------------------------------------------------------------
     * @return \TCorp\Input
     */
    public static function getInput()
    {
        if (is_null(static::$input)) {
            static::$input = new Input();
        }

        return static::$input;
    }

}
