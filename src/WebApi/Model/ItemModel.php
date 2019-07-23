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

namespace TCorp\WebApi\Model;


/**
 * Base class for working with single API items
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
     * A list of property values for the item
     *
     * @var mixed[]
     */
    protected $data = [];



    /**
     * Load data from the API
     * -------------------------------------------------------------------------
     * @param  string|int   $id     Id of the item
     *
     * @return bool     True on success, False on failure
     */
    public function load($id) : bool
    {
        echo "Load\n";
    }


    /**
     * Set the current data using an object or array.
     * -------------------------------------------------------------------------
     * @param  mixed    $data   Object or associative array containing values
     *
     * @return void
     */
    public function bind(mixed $data) : void
    {
        if (is_object($data)) {
            $data = (array) $data;
        }

        foreach(self::$properties as $name) {
            if (isset($data[$name])) {
                $this->values[$name] = $data[$name];
            }
        }
    }


    /**
     * Check that the current data valid. By default, this method is called
     * when saving the item
     * -------------------------------------------------------------------------
     * @return  bool    True if all values are valid, False if not
     */
    public function validate() : bool
    {
        echo "Validate\n";
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
        echo "Sanitise\n";
    }


    /**
     * Save the current data to the API. If no value has been set for the item's
     * id, then a new item will be created. Otherwise the existing item will
     * be updated
     * -------------------------------------------------------------------------
     * @param  bool  $validate   Validate current data before saving
     * @param  bool  $sanitise   Sanitise current data before saving
     *
     * @return bool    True on success, False on failure
     */
    public function save(bool $validate = true, bool $sanitise = true) : bool
    {
        // Validate the item before creating/updating
        if ($validate) {
            if ($this->validate() == false) {
                return false;
            }
        }

        // Sanitise the item before creating/updating
        if ($sanitise) {
            $this->sanitise();
        }

        // Create or update the item with the current data
        if (empty($this->id)) {
            return $this->create();
        } else {
            return $this->update();
        }
    }


    /**
     * Create a new item with the current data
     * -------------------------------------------------------------------------
     * @return  bool    True on success, False on failure
     */
    protected function create()
    {
        echo "Create\n";
    }


    /**
     * Update an existing item with the current data
     * -------------------------------------------------------------------------
     * @return  bool    True on success, False on failure
     */
    protected function update()
    {
        echo "Update\n";
    }


    /**
     * Delete the item from the API
     * -------------------------------------------------------------------------
     * @return  bool    True on success, False on failure
     */
    public function delete()
    {
        echo "Delete\n";
    }


    /**
     * Clear the current data without updating the API
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clear()
    {
        $this->values = [];
    }


    /**
     *
     * -------------------------------------------------------------------------
     * @param string $name   Name of the property to get
     *
     * @return mixed    Value of the given property
     */
    public function __get($name)
    {
        if (in_array($name, self::$properties)) {
            return $this->values[$name] ?? null;
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
    public function __set(string $name , mixed $value) : void
    {
        if (in_array($name, self::$properties)) {
            $this->values[$name] = $value;
        }
    }

}
