<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Joomla\View\Administrator;

use \Joomla\CMS\HTML\HTMLHelper;


/**
 * Base class for creating item based back-end views
 */
class ItemView extends GenericView
{

    /**
     * Execute and display a view layout.
     * -------------------------------------------------------------------------
     * @param  string   $tpl    The name of the view layout to parse
     *
     * @return mixed            A string if successful, Error object if not
     */
    public function display($tpl = null)
    {
        // Add data to the view
        $this->item = $this->get('Item');
        $this->form = $this->get('Form');

        // Prevent the user's session from timing out
        HTMLHelper::_('behavior.keepalive');

        // Call and return the parent method
		return parent::display($tpl);
    }

}
