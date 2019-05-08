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

namespace TCorp\T3\Api;


class Request
{

    /**
     * Relative URL that represents the API action to execute
     *
     * @var string
     */
    protected $action = '';


    /**
     * Parameters to send with the request
     *
     * @var string[]
     */
    protected $params = array();



    /**
     * Get the relative URL that represents the API action to execute
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }


    /**
     * Get the value of one or all parameters
     * -------------------------------------------------------------------------
     * @param string    $name   The name of the parameter
     *
     * @return mixed    If param exists: the value of the param.
     *                  If param doesn't exist: null
     *                  If no $name is given: Assoc array containing all params
     */
    public function getParam(string $name = '')
    {
        if (empty($name)) {

            return $this->params;

        } elseif (isset($this->params[$name])) {

            return $this->params[$name];

        } else {

            return null;

        }
    }


    /**
     * Sets the value for a given parameter, with overwrite option
     * -------------------------------------------------------------------------
     * @param string    $name       Name of the parameter
     * @param mixed     $value      Value for the parameter
     * @param bool      $overwrite  Overwrite value if param already exists
     */
    public function setParam(string $name, $value, bool $overwrite = true)
    {
        if (isset($this->params[$name]) && $overwrite == false) {
            return;
        }

        $this->params[$name] = $value;
    }


}
