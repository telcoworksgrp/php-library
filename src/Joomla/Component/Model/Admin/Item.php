<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Component\Model\Admin;

defined('_JEXEC') or die();

use \Joomla\CMS\MVC\Model\AdminModel;
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
     * @return mixed    A JForm object on success, false on failure
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Get the form
        $result = $this->loadForm($this->option . '.' . $this->name,
            $this->name, array('control' => 'jform', 'load_data' => $loadData));

        // Return the result
        return (empty($result)) ? false : $result;
    }


    /**
     * Load the data that should be injected in the form
     * -------------------------------------------------------------------------
     * @return  array|boolean   Data to be injected into the form, or an empty
     *                          array to use default data.
     */
    protected function loadFormData()
    {
        // Try to load the form data from the user state
        $key    = $this->option . '.edit.' . $this->name . '.data';
        $result = Factory::getApplication()->getUserState($key, array());

        // If no data was found,  try the getItem method
        $result = (empty($result)) ? $this->getItem() : $result;

        // If there is still no data return false
        $result = (empty($result)) ? false : $result;

        // Return the result
        return $result;
    }

}
