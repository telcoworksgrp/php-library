<?php
/**
 * =============================================================================
 * @package     Telcoworks Group PHP Library
 * @author      David Plath <webmaster@telcoworksgrp.com.au>
 * @copyright   Copyright (c) 2020 Telcoworks Group. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TelcoworksGrp\Joomla\View\Administrator;

use \Joomla\CMS\MVC\View\HtmlView;
use \TelcoworksGrp\Joomla\Utils;


/**
 * Base class for creating generic back-end views
 */
class GenericView extends HtmlView
{

    /**
     * Execute and display a view layout.
     * -------------------------------------------------------------------------
     * @param  string   $tpl    The name of the view layout to parse
     * @return mixed            A string if successful, Error object if not
     */
    public function display($tpl = null)
    {
        // Add data to the view
        $this->state    = $this->get('State');
        $this->config   = Utils::getComponentConfig();
        $this->menuitem = Utils::getActiveMenuItem();

        // Add component toolbar items
        $this->addAdministratonToolbar();

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
