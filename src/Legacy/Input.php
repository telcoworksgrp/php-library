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


/**
 * Class for working with the scripts input
 */
class Input
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
        $this->data = new Registry($_REQUEST);
    }


    /**
     * Get the value of a given key from the input
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

}
