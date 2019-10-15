<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\WebApi\Client;


class Model
{

    /**
     * The base endpoint to send requests to
     *
     * @var string
     */
    protected static $endpoint = '';


    /**
     * A list of property names for the item
     *
     * @var string[]
     */
    protected static $properties = [];


    /**
     * A list of values for each property
     *
     * @var mixed[]
     */
    protected $data = [];



    /**
     * Create a new item using the current data
     * -------------------------------------------------------------------------
     * @return void
     */
    public function create()
    {
    }


    /**
     * Read and bind the data from an existing item
     * -------------------------------------------------------------------------
     * @param  mixed    $id Value of the item's id/primary key
     *
     * @return void
     */
    public function read($id)
    {
    }


    /**
     * Update an existing item using the current id and data
     * -------------------------------------------------------------------------
     * @return void
     */
    public function update()
    {
    }


    /**
     * Delete an existing item based on the current id
     * -------------------------------------------------------------------------
     * @return void
     */
    public function delete()
    {
    }


    /**
     * Check that the current data is valid.
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function validate()
    {
        return $true;
    }


    /**
     * Perform any sanitisation on the current data.
     * -------------------------------------------------------------------------
     * @return void
     */
    public function sanitise()
    {
    }


    /**
     * Set the current data to values found in an object, associative
     * array or JSON string.
     * -------------------------------------------------------------------------
     * @param  mixed    $data   Object, array or json string containing values
     *
     * @return void
     */
    public function bind($newData)
    {
        if (is_string($data)) {
            $newData = json_decode($newData);
        }

        if (is_object($newData)) {
            $newData = (array) $newData;
        }

        foreach(static::$properties as $name) {
            if (isset($newData[$name])) {
                $this->data[$name] = $newData[$name];
            }
        }

        $this->sanitise();
    }


    /**
     * Save the current data. If the current data contains a value for the
     * item's ID then the item will be updated. If not, the item will be
     * created and then the item's ID will be automatically updated.
     * -------------------------------------------------------------------------
     * @return void
     */
    public function save()
    {
        if (is_null($this->id)) {
            $this->create();
        } else {
            $this->update();
        }
    }


    /**
     * Clear all current data
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clear()
    {
        $this->data = [];
    }


    /**
     * Send a request to the APi and return the result as an object
     * -------------------------------------------------------------------------
     * @param  string   $method     HTTP method to use
     * @param  string   $endpoint   Absolute endpoint url to send request to
     * @param  array    $params     Params to send with the request
     * @param  array    $headers    Additional headers to send with the request
     *
     * @return \stdClass
     */
    protected function send(string $method, string $endpoint, array
        $params = [], array $headers = []) : \stdClass
    {

    }


    /**
     * Get the current data as a plain object
     * -------------------------------------------------------------------------
     * @return stdClass
     */
    public function toObject()
    {
        return (object) $this->data;
    }


    /**
     * Get the current data as JSON
     * -------------------------------------------------------------------------
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->data);
    }


    /**
     * Get the value of a given property
     * -------------------------------------------------------------------------
     * @param string $name   Name of the property to get
     *
     * @return mixed
     */
    public function __get($name)
    {
        if (in_array($name, static::$properties)) {
            return $this->data[$name] ?? null;
        } else {
            return null;
        }
    }


    /**
     * Set the value of a given property
     * -------------------------------------------------------------------------
     * @param string $name      Name of the property to set
     * @param mixed  $value     New value for the property
     *
     * @return void
     */
    public function __set(string $name , $value) : void
    {
        if (in_array($name, static::$properties)) {
            $this->data[$name] = $value;
        }
    }


}
