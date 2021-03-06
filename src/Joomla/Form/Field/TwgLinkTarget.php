<?php
/**
 * =============================================================================
 * @package     Telcoworks Group PHP Library
 * @author      David Plath <webmaster@telcoworksgrp.com.au>
 * @copyright   Copyright (c) 2020 Telcoworks Group. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TelcoworksGrp\Joomla\Form\Field;

use \Joomla\CMS\Factory;
use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Form\FormHelper;


// Load the parent FormField class
FormHelper::loadFieldClass('list');


/**
 * Custom Form field for selecting a link target
 */
class TwgLinkTarget extends \JFormFieldList
{

    protected $type = 'TwgLinkTarget';


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
        $options[]= HTMLHelper::_('select.option', '_blank', 'Blank');
        $options[]= HTMLHelper::_('select.option', '_self', 'Self');
        $options[]= HTMLHelper::_('select.option', '_parent', 'Parent');
        $options[]= HTMLHelper::_('select.option', '_top', 'Top');

		// Return the resulting options (as html)
		return $options;
	}


}
