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
 * Class for working with the request's input values
 */
class Input
{

    /**
     * Get the value of a GET request parameter
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the GET var/parameter
     * @param  mixed    $default    Value to return if no value is found
     * @param  string   $type       Expected data type (for sanitisation)
     *
     * @return mixed
     */
    public function get(string $name, $default = null, $type = 'string')
    {
        return $this->sanitise($_GET[$name] ?? $default, $type);
    }


    /**
     * Get the value of a POST request parameter
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the GET var/parameter
     * @param  mixed    $default    Value to return if no value is found
     * @param  string   $type       Expected data type (for sanitisation)
     *
     * @return mixed
     */
    public function post(string $name, $default = null, $type = 'string')
    {
        return $this->sanitise($_POST[$name] ?? $default, $type);
    }


    /**
     * Get the value of a PUT request parameter
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the GET var/parameter
     * @param  mixed    $default    Value to return if no value is found
     * @param  string   $type       Expected data type (for sanitisation)
     *
     * @return mixed
     */
    public function put(string $name, $default = null, $type = 'string')
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            parse_str(file_get_contents("php://input"), $params);
            $result = $params[$name] ?? $default;
        } else {
            $result = $default;
        }

        return $this->sanitise($result, $type);
    }


    /**
     * Get the value of a PATCH request parameter
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the GET var/parameter
     * @param  mixed    $default    Value to return if no value is found
     * @param  string   $type       Expected data type (for sanitisation)
     *
     * @return mixed
     */
    public function patch(string $name, $default = null, $type = 'string')
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            parse_str(file_get_contents("php://input"), $params);
            $result = $params[$name] ?? $default;
        } else {
            $result = $default;
        }

        return $this->sanitise($result, $type);
    }


    /**
     * Get the value of a DELETE request parameter
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the GET var/parameter
     * @param  mixed    $default    Value to return if no value is found
     * @param  string   $type       Expected data type (for sanitisation)
     *
     * @return mixed
     */
    public function delete(string $name, $default = null, $type = 'string')
    {
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            parse_str(file_get_contents("php://input"), $params);
            $result = $params[$name] ?? $default;
        } else {
            $result = $default;
        }

        return $this->sanitise($result, $type);
    }


    /**
     * Get the value from a GET,POST or COOKIE request parameter
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the GET var/parameter
     * @param  mixed    $default    Value to return if no value is found
     * @param  string   $type       Expected data type (for sanitisation)
     *
     * @return mixed
     */
    public function request(string $name, $default = null, $type = 'string')
    {
        return $this->sanitise($_REQUEST[$name] ?? $default, $type);
    }


    /**
     * Get information about an uploaded file
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the GET var/parameter
     * @param  mixed    $default    Value to return if no value is found
     * @param  string   $type       Expected data type (for sanitisation)
     *
     * @return mixed
     */
    public function file(string $name, $default = null, $type = 'string')
    {
        return $this->sanitise($_FILES[$name] ?? $default, $type);
    }


    /**
     * Get a value from a cookie
     * -------------------------------------------------------------------------
     * @param  string   $name       Name of the GET var/parameter
     * @param  mixed    $default    Value to return if no value is found
     * @param  string   $type       Expected data type (for sanitisation)
     *
     * @return mixed
     */
    public function cookie(string $name, $default = null, $type = 'string')
    {
        return $this->sanitise($_COOKIE[$name] ?? $default, $type);
    }


    /**
     * Sanitise a given value
     * -------------------------------------------------------------------------
     * @param  mixed    $value      The value to sanitise
     * @param  string   $type       Expected data type (for sanitisation)
     *
     * @return mixed
     */
    protected function sanitise($value, $type = 'string')
    {
        return Sanitiser::sanitise($value, $type);
    }

}
