<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Component\View\Admin;

defined('_JEXEC') or die();

use \TCorp\Joomla\Component\Helper AS ComponentHelper;
use \TCorp\Joomla\Menu\Helper AS MenuHelper;
use \Joomla\CMS\MVC\View\HtmlView;
use \Joomla\CMS\Factory;

class Generic extends HtmlView
{

    /**
     * Execute and display a view layout.
     * -------------------------------------------------------------------------
     * @param  string   $tpl    The name of the view layout to parse
     *
     * @return mixed    A string if successful, otherwise an Error object
     */
    public function display($tpl = null)
    {
        // Add data to the view
        $this->config   = ComponentHelper::getComponentConfig();
        $this->menuitem = MenuHelper->getActive();

        // Add component toolbar items
        $this->addAdministratonToolbar();

        // Call and return the parent method
        return parent::display($tpl);
    }



    /**
     * Add items to the administration toolbar
     * -------------------------------------------------------------------------
     */
    protected function addAdministratonToolbar()
    {
    }

}
