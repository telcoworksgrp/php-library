<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Legacy\Input;

use \TCorp\Registry\Registry;



/**
 * Class for managing GET, POST and COOKIE input values
 */
class Input
{


    /**
     * Registry to contain a list of input values
     *
     * @var \TCorp\Registry\Registry
     */
    protected $registry = null;



    /**
     * Constructor method to initialise new instance of this class
     * -------------------------------------------------------------------------
     */
    public function __construct()
    {
        // Initialise some class properties
        $this->registry =  new Registry($_REQUEST);
    }



    /**
     * Get the value of a given input
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the parameter
     * @param  mixed    $default    Value to return if not found
     * @param  string   $filter     Filter to apply to the value
     *
     * @return mixed
     */
    public function get(string $name, $default = null, string $filter = '')
    {
        $result = $this->sanitise($this->registry->get($name, $default));
    }    



    /**
     * Sanitise a given value based on an expected data type
     * -------------------------------------------------------------------------
     * @param  mixed    $value  The value to sanitise
     * @param  string   $type   The expected data type of the value
     *
     * @return mixed
     */
    protected function sanitise($value, string $type = '')
    {
        // Apply the appropiate sanitisation to the value
        switch (strtolower($type)) {

            case 'int':
                $result = preg_replace('|[^0-9]|i', '', $value);
                break;

            case 'float':
                $result = preg_replace('|[^0-9.]|i', '', $value);
                break;

            default:
                $result = htmlentities($value);
                break;
        }

        // Return the result
        return $result;
    }


}
