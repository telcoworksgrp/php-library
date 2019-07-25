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

namespace TCorp\Legacy\Registry;


/**
 * Class for storing values using the registry pattern
 */
class Registry
{

    /**
     * Holds all the items in the registry
     *
     * @var mixed[]
     */
    protected $items = [];



    /**
     * Set the value of an item in the registry
     * -------------------------------------------------------------------------
     * @param   string  $key        Name of the item to set
     * @param   mixed   $value      The value to set the item to
     * @param   bool    $replace    Replace any existing value
     */
    public function set(string $key, $value, bool $replace = true)
    {
        if (!($this->exists($key) && !replace)) {

            $this->items[$key] = $value;

        }
    }


    /**
     * Get an item's value from the registry
     * -------------------------------------------------------------------------
     * @param   string  $key        Name of the item to get
     * @param   mixed   $default    A default value if the item doesn't exist
     *
     * @return  mixed   The value of the item OR the default if none exists.
     */
    public function get(string $key, $default = null)
    {
        return $this->items[$key] ?? $default;
    }


    /**
     * Check if an item with a given key exists in the registry
     * -------------------------------------------------------------------------
     * @param   string  $key    Name of the item to check
     *
     * @return bool     TRUE if an item exists, FALSE if not
     */
    public function exists(string $key)
    {
        return isset($this->items[$key]);
    }


    /**
     * Clear all items from the registry
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clear()
    {
        $this->items = [];
    }

}
