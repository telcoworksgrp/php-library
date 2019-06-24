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

namespace TCorp\Joomla\Form\Field;

use \Joomla\CMS\Factory;
use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Form\FormHelper;


// Load the parent FormField class
FormHelper::loadFieldClass('list');


/**
 * Custom Form field for selecting a day of the week
 */
class DayOfWeek extends \JFormFieldList
{

    protected $type = 'DayOfWeek';


    /**
	 * Get a list of field options.
	 * -------------------------------------------------------------------------
	 * @return 	array 	An array of options (as HTML)
	 */
	protected function getOptions()
	{
        // Call the parent method
        $options = parent::getOptions();

		// Add field options to the result
		$options[]= HTMLHelper::_('select.option', '0', 'Monday');
        $options[]= HTMLHelper::_('select.option', '1', 'Tuesday');
        $options[]= HTMLHelper::_('select.option', '2', 'Wedsnday');
        $options[]= HTMLHelper::_('select.option', '3', 'Thursday');
        $options[]= HTMLHelper::_('select.option', '4', 'Friday');
        $options[]= HTMLHelper::_('select.option', '5', 'Saturday');
        $options[]= HTMLHelper::_('select.option', '6', 'Sunday');

		// Return the resulting options (as html)
		return $options;
	}


}
