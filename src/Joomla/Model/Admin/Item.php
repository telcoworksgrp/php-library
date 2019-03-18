<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Model\Admin;


use \Joomla\CMS\MVC\Model\AdminModel;
use \Joomla\CMS\Form\Form;
use \Joomla\CMS\Factory;


class Item extends AdminModel
{


    /**
     * Get a form for the model
     * -------------------------------------------------------------------------
     * @param  array    $data       Data for the form.
     * @param  boolean  $loadData   True if the form is to load its
     *                                  own data (default case)
     *
     * @return Form    A JForm object on success, false on failure
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form
        $result = $this->loadForm($this->option . '.' . $this->name,
            $this->name, array('control' => 'jform', 'load_data' => $loadData));

        // If no form was found/loaded then return false
        if (empty($result)) {
            $result = false;
        }

        // Return the result
        return $result;
    }


    /**
     * Load the data that should be injected in the form
     * -------------------------------------------------------------------------
     * @return  array|boolean   Data to be injected into the form, or an empty
     *                          array to use default data.
     */
    protected function loadFormData()
    {
        // Initialise some local variables
        $application = Factory::getApplication();

        // Try to load the form data from the user state
        $result = $application->getUserState($this->option . '.edit.' .
            $this->name .'.data', array());

        // If no data was found,  try the getItem method
        if (empty($result)) {
            $result = $this->getItem();
        }

        // If there is still no data return false
        $result = (empty($result)) ? false : $result;

        // Return the result
        return $result;
    }


}
