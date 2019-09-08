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
 * Base class for working with forms
 */
class Form
{


    /**
     * A name/id for the form
     *
     * @var string
     */
    protected $name = 'form';


    /**
     * A list of form field names
     *
     * @var string[]
     */
    protected $fields = [];


    /**
     * Values for the form's fields
     *
     * @var mixed
     */
    protected $data = null;



    /**
     * Constructor method for initialising new instances of this class
     * -------------------------------------------------------------------------
     */
    public function __construct()
    {
        // Initialise some class properties
        $this->data = new Registry();
    }


    /**
     * Load the form's field values from the current session
     * -------------------------------------------------------------------------
     * @return void
     */
    public function load()
    {
        $this->clear();
        $this->data->loadString(Session::get("$this->name.data", "{}"));
    }


    /**
     * Update the form's field values from the request
     * -------------------------------------------------------------------------
     * @return void
     */
    public function update()
    {
        foreach ($_REQUEST as $name => $value) {
            $this->set($name, $value);
        }
    }


    /**
     * Clear all the form's field values
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clear()
    {
        $this->data->reset();
    }


    /**
     * Save the form's field values
     * -------------------------------------------------------------------------
     * @return void
     */
    public function save()
    {
        Session::set("$this->name.data", $this->data->toString());
    }


    /**
     * Validate the form's field values
     * -------------------------------------------------------------------------
     * @return  bool
     */
    public function validate() : bool
    {
        return true;
    }

    /**
     * Sanitise the form's field values
     * -------------------------------------------------------------------------
     * @return void
     */
    public function sanitise()
    {
    }


    /**
     * Set the value of a given form field
     * -------------------------------------------------------------------------
     * @param string    $name   Name of the form field
     * @param mixed     $value  Value to set the form field to
     *
     * @return void
     */
    public function set(string $name, $value)
    {
        if (in_array($name, $this->fields)) {
            $this->data->set("$this->name.data.$name", $value);
        }
    }


    /**
     * Get the value of a given form field
     * -------------------------------------------------------------------------
     * @param  string   $key        Name of the form field to get
     * @param  mixed    $default    Value to return if not found
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        $this->data->get("$this->name.data.$name", $default);
    }


    /**
     * Send a notification for this form
     * -------------------------------------------------------------------------
     * @return void
     */
    public function notify()
    {
    }


    /**
     * Send a confirmation for this email
     * -------------------------------------------------------------------------
     * @return void
     */
    public function confirm()
    {
    }

}
