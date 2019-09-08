<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Legacy;

use \TCorp\Registry\Registry;


/**
 * Class for managing configuration values
 */
class Config
{

    /**
     * A registry to contain all configuration values
     *
     * @var \TCorp\Registry\Registry
     */
    protected $registry = null;


    /**
     * Constructor method for initialising new instances of this class
     * -------------------------------------------------------------------------
     */
    public function __construct()
    {
        // Initialise some class properties
        $this->registry = new Registry();
    }


    /**
     * Get a configuration value
     * -------------------------------------------------------------------------
     * @param  string   $key      Key/name of the configuration to get
     * @param  mixed    $default  Value to return if no value is found
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return $this->registry->get($key, $default);
    }


    /**
     * Set a configuration value
     * -------------------------------------------------------------------------
     * @param string    $key       Key/name of the configuration to set
     * @param mixed     $value     Value to set the configuration to
     *
     * @return void
     */
    public function set(string $key, $value)
    {
        $this->registry->set($key, $value);
    }


    /**
     * Check if a configuration value exists
     * -------------------------------------------------------------------------
     * @param string    $key       Key/name of the configuration to set
     *
     * @return bool
     */
    public function exists(string $key) : bool
    {
        return $this->registry->exists($key);
    }


    /**
     * Remove all configuration values
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clear()
    {
        $this->registry->reset();
    }

}
