<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Model\Site;


use \Joomla\CMS\MVC\Model\FormModel;


abstract class Form extends FormModel
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

        // Return the result
        return $result;
    }


}
