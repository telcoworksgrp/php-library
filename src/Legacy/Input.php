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
    public function get(string $key, $default = null, string $filter = 'string')
    {
        // Get the value
        $result = $this->data->get($key, $default);

        // Sanitise the value
        switch (strtolower($filter)) {
            case 'int':
                $result = filter_var($result, FILTER_SANITIZE_NUMBER_INT);
                break;

            case 'float':
                $result = filter_var($result, FILTER_SANITIZE_NUMBER_FLOAT);
                break;

            case 'email':
                $result = filter_var($result, FILTER_SANITIZE_NUMBER_EMAIL);
                break;

            case 'url':
                $result = filter_var($result, FILTER_SANITIZE_URL);
                break;

            case 'string':
                $result = htmlspecialchars(filter_var($result, FILTER_SANITIZE_STRING));
                break;
        }

        // Return the result
        return $result;
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
