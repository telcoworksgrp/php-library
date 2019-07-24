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

namespace TCorp\WebApi\Orm\Model;


/**
 * Base class for working with individual API items
 */
class ItemModel extends BaseModel
{

    /**
     * A list of property names for the item
     *
     * @var string[]
     */
    protected static $properties = [];


    /**
     * Holds data for the item
     *
     * @var mixed[]
     */
    protected $data = [];



    /**
     * Create a new item in the API from the current data
     * -------------------------------------------------------------------------
     * @return bool TRUE if successful, FALSE if not successful
     */
    public function create() : bool
    {
        // Compose and execute an API request
        $this->client->reset();
        $this->client->setMethod('POST');
        $this->client->setEndpoint(static::$endpoint);
        $this->client->setParams($this->data);
        $response = $this->client->execute();

        // If the request failed return false
        if ($response === false) {
            return false;
        }

        // The API will give the item a new id (and
        // perhaps other values), update the current
        // data to reflect this
        $this->bind($response->result->item);

        // Return TRUE to indicate success
        return true;
    }


    /**
     * Read data for an item from the API
     * -------------------------------------------------------------------------
     * @param  string|int   $id     The item's id
     *
     * @return bool TRUE if successful, FALSE if not successful
     */
    public function read($id) : bool
    {
        // Compose and execute an API request
        $this->client->reset();
        $this->client->setMethod('GET');
        $this->client->setEndpoint(static::$endpoint . $id);
        $response = $this->client->execute();

        // If the request failed return false
        if ($response === false) {
            return false;
        }

        // Update the current data with the data
        // received from the API
        $this->bind($response->result->item);

        // Return TRUE to indicate success
        return true;
    }


    /**
     * Update the item in the API using the current data
     * -------------------------------------------------------------------------
     * @return bool TRUE if successful, FALSE if not successful
     */
    public function update() : bool
    {
        // Compose and execute an API request
        $this->client->reset();
        $this->client->setMethod('PUT');
        $this->client->setEndpoint(static::$endpoint . $this->id);
        $this->client->setParams($this->data);
        $response = $this->client->execute();

        // If the request failed return false
        if ($response === false) {
            return false;
        }

        // The API may have sanitised or otherwise altered
        // some the data we sent it , update the current
        // data to reflect this
        $this->bind($response->result->item);

        // Return TRUE to indicate success
        return true;
    }


    /**
     * Delete the item from the API
     * -------------------------------------------------------------------------
     * @return bool TRUE if successful, FALSE if not successful
     */
    public function delete() : bool
    {
        // Compose and execute an API request
        $this->client->reset();
        $this->client->setMethod('DELETE');
        $this->client->setEndpoint(static::$endpoint . $this->id);
        $response = $this->client->execute();

        // If the request failed return false
        if ($response === false) {
            return false;
        }

        // Return TRUE to indicate success
        return true;
    }


    /**
     * Save the current data to the API. If a current id has been set, then
     * update the item with that id. If a current id has NOT been set, create
     * a new item
     * -------------------------------------------------------------------------
     * @param  bool  $validate   Validate current data before saving
     * @param  bool  $sanitise   Sanitise current data before saving
     *
     * @return bool TRUE if successful, FALSE if not successful
     */
     public function save(bool $validate = true, bool $sanitise = true) : bool
     {
         // Sanitise the item before creating/updating
         if ($sanitise) {
             $this->sanitise();
         }

         // Validate the item before creating/updating
         if ($validate) {
             if ($this->validate() == false) {
                 return false;
             }
         }

         // Create or update the item with the current data
         if ($this->id === null) {
             return $this->create();
         } else {
             return $this->update();
         }
     }


    /**
     * Clear all current data for the item
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clear() : void
    {
        $this->data = [];
    }


    /**
     * Set the current data to values found in an object or associative array.
     * -------------------------------------------------------------------------
     * @param \stdClass|array   $newData   Object/assoc array containing values
     *
     * @return void
     */
    public function bind($newData) : void
    {
        if (is_object($newData)) {
            $newData = (array) $newData;
        }

        foreach(static::$properties as $name) {
            if (isset($newData[$name])) {
                $this->data[$name] = $newData[$name];
            }
        }
    }


    /**
     * Check that the current data is valid. By default, this method is called
     * when saving the item
     * -------------------------------------------------------------------------
     * @return bool TRUE if successful, FALSE if not successful
     */
    public function validate() : bool
    {
        return true;
    }


    /**
     * Perform any sanitisation on the current data. By default, this method is
     * called when saving the item
     * -------------------------------------------------------------------------
     * @return  void
     */
    public function sanitise() : void
    {
    }


    /**
     * Get the current data as a plain object
     * -------------------------------------------------------------------------
     * @return \stdClass    The current data as an object
     */
    public function toObject() : \stdClass
    {
        return (object) $this->data;
    }


    /**
     * Get the current data as JSON
     * -------------------------------------------------------------------------
     * @return string   The current data as JSON
     */
    public function toJson() : string
    {
        return json_encode($this->data);
    }


    /**
     *
     * -------------------------------------------------------------------------
     * @param string $name   Name of the property to get
     *
     * @return mixed Value of the given property
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
     *
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
