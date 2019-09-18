<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Joomla\View\Site;

use \TCorp\Joomla\Helper\JoomlaHelper;
use \TCorp\Joomla\Helper\ComponentHelper;
use \TCorp\Joomla\Helper\MenuHelper;
use \Joomla\CMS\MVC\View\HtmlView;
use \Joomla\CMS\Factory;


class FormView extends HtmlView
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
        $this->form     = $this->get('Form');
        $this->state    = $this->get('State');
        $this->config   = ComponentHelper::getConfig();
        $this->menuitem = MenuHelper::getActiveMenuItem();

        // Call and return the parent method
        return parent::display($tpl);
    }
}
