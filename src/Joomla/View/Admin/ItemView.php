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

namespace TCorp\Joomla\View\Admin;

use \TCorp\Joomla\Helper\JoomlaHelper;
use \TCorp\Joomla\Component\ComponentHelper;
use \Joomla\CMS\MVC\View\HtmlView;
use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Factory;


class ItemView extends HtmlView
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
        $this->item     = $this->get('Item');
        $this->form     = $this->get('Form');
        $this->state    = $this->get('State');
        $this->config   = ComponentHelper::getConfig();
        $this->menuitem = JoomlaHelper::getActiveMenuItem();

        // Add component toolbar items
        $this->addAdministratonToolbar();

        // Prevent the user's session from timing out
        HTMLHelper::_('behavior.keepalive');

        // Call and return the parent method
		return parent::display($tpl);
    }

    /**
     * Add items to the administration toolbar for this view
     * -------------------------------------------------------------------------
     */
    protected function addAdministratonToolbar()
    {
    }

}
