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
 * Class for managing configuration values
 */
class Config
{


    /**
     * Holds all configuration values
     *
     * @var \TCorp\Registry;
     */
    protected $data = null;



    /**
     * Constructor for initialising new instances of this class
     * -------------------------------------------------------------------------
     */
    public function __construct()
    {
        // Initialise some class properties
        $this->data = new Registry();
    }


    /**
     * Set a value of given configuration item
     * -------------------------------------------------------------------------
     * @param string    $key    Dot seperated key name
     * @param mixed     value   Value to set
     *
     * @return void
     */
    public function set(string $key, $value)
    {
        $this->data->set($key, $value);
    }


    /**
     * Get the value for given configuration item
     * -------------------------------------------------------------------------
     * @param string    $key        Dot seperated key name
     * @param mixed     $default    Value to return if the key is not found
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->data->get($key, $default);
    }


    /**
     * Delete an item from the configuration
     * -------------------------------------------------------------------------
     * @param  string   $key  Dot seperated key name
     *
     * @return void
     */
    public function delete(string $key)
    {
        $this->data->remove($key);
    }


    /**
     * Clear/remove all configuration values
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clear()
    {
        $this->data->reset();
    }


    /**
     * Check if a value for the given item exists
     * -------------------------------------------------------------------------
     * @param  string   $key    Dot seperated key name
     *
     * @return bool
     */
    public function exists(string $key) : bool
    {
        return $this->data->exists($key);
    }

}
