<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */


namespace TCorp\Legacy\MVC;

use \TCorp\Legacy\Input;


/**
 * Minimalist base class for creating MVC controllers
 */
class Controller
{

    /**
     * Execute the appropriate controller action
     * -------------------------------------------------------------------------
     * @return mixed    HTML Output
     */
    public function execute()
    {
        // Get the requested action
        $action = Input::getValue('action','display','STRING');

        // Check if we have a method to handle the action
        if (!is_callable([$this, $action])) {
            throw new \Exception("Invalid Controller Action \"$action\"", 500);
        }

        // Call the action handler method
        $result = $this->$action;

        // Return the final result
        return $result;
    }


    /**
     * Default action handler for this controller
     * -------------------------------------------------------------------------
     * @return mixed HTML Output
     */
    public function display()
    {
        return '';
    }

}
