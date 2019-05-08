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

namespace TCorp\Joomla\Model\Site;

use \Joomla\CMS\MVC\Model\FormModel;
use \Joomla\CMS\Factory;


abstract class FormModel extends FormModel
{


    /**
     * Get a form for the model
     * -------------------------------------------------------------------------
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form with values
        $name    = $this->option . '.' . $this->name;
        $source  = $this->name;
        $options = array('control' => 'jform', 'load_data' => $loadData);
        $result  = $this->loadForm($name, $source, $options);

        // Return the result
        return $result;
    }


    /**
     * Load the data that should be injected in the form
     * -------------------------------------------------------------------------
     */
    protected function loadFormData()
    {
        // Initialise some local variables
        $application = Factory::getApplication();

        // Try to load the form data from the user state
        $key = $this->option . '.edit.' . $this->name . '.data';

        $result = $application->getUserStateFromRequest(
            $key, 'jform', array(), 'ARRAY');

        // Return the result
        return $result;
    }


}
