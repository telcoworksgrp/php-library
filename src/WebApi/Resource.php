<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\WebApi;


/**
 * Base class for all API resources
 */
class Resource
{


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
     * Clear all current data
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clear()
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
    public function bind($data)
    {
    }


    /**
     * Check if all the current data is valid
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function validate() : bool
    {
    }

    /**
     * Sanitise all the current data
     * -------------------------------------------------------------------------
     * @return void
     */
    public function sanitise()
    {
    }


    /**
     * Save the current data. If the current data contains an id then the item
     * will be updated. If not the item will be created
     * -------------------------------------------------------------------------
     * @return void
     */
    public function save()
    {
    }


    /**
     * Get the current data as a plain object
     * -------------------------------------------------------------------------
     * @return \stdClass
     */
    public function toObject() : \stdClass
    {
    }


    /**
     * Get the current data as JSON
     * -------------------------------------------------------------------------
     * @return string
     */
    public function toJson()
    {
    }


    /**
     * Send a request to the APi and return the result as an object
     * -------------------------------------------------------------------------
     * @param  string $method   HTTP method to use when sending the request
     * @param  string $url      Relative URL to send the request to
     * @param  array  $params   Assoc array of HTTP parameters
     *
     * @return false|stdClass
     */
    protected function call(string $method, string $url, array $params = [])
    {
    }

}
