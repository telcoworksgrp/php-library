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

use TCorp\Registry\Registry;
use TCorp\Registry\Format;


/**
 * Class for managing configuration values
 */
class Config
{

    /**
     * Holds all the input data
     *
     * @var \TCorp\Registry\Registry
     */
    protected $data = null;



    /**
     * Construtor method for initiailing new instances of this class
     * -------------------------------------------------------------------------
     * @return void
     */
    public function __construct()
    {
        // Initialise some class properties
        $this->data = new Registry();
    }


    /**
     * Get the value of a given key from the configuration
     * -------------------------------------------------------------------------
     * @param  string   $key        Dot seperated key associated with the value
     * @param  mixed    $default    Value to return if key is not found
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->data->get($key, $default);
    }


    /**
     * Set the value for a given key in the configuration
     * -------------------------------------------------------------------------
     * @param string    $key    Dot seperated key associated with the value
     * @param mixed     $value  The new value
     *
     * @return void
     */
    public function set(string $key, $value)
    {
        $this->data->set($key, $value);
    }


    /**
     * Check if a value for a given key exists
     * -------------------------------------------------------------------------
     * @param  string   $key    Dot seperated key associated with the value
     *
     * @return bool
     */
    public function exists(string $key) : bool
    {
        return $this->data->exists($key);
    }


    /**
     * Unset/remove a given key and value from the configuration
     * -------------------------------------------------------------------------
     * @param string    $key    Dot seperated key associated with the value
     *
     * @return void
     */
    public function unset(string $key)
    {
        $this->data->remove($key);
    }


    /**
     * Clear all configuration data
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clear()
    {
        $this->data->reset();
    }


    /**
     * Load configuration data from file
     * -------------------------------------------------------------------------
     * @param  string   $filename   Absolute path to the config file
     *
     * @return void
     */
    public function load(string $filename)
    {
        $this->data->loadFile($filename, Format::PHP);
    }

}
