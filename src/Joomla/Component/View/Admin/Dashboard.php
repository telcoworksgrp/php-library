<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Component\View\Admin;

defined('_JEXEC') or die();

use \TCorp\Joomla\Component\View\Admin\Generic;
use \TCorp\Joomla\Component\Helper AS ComponentHelper;
use \Joomla\CMS\Factory;

class Dashboard extends Generic
{

    /**
     * Execute and display a view layout.
     * -------------------------------------------------------------------------
     * @param  string   $tpl    The name of the view layout to parse
     * @return mixed    A string if successful, otherwise an Error object
     */
    public function display($tpl = null)
    {
        // Add data to the view
        $this->server   = $this->get('ServerInfo');
        $this->database = $this->get('DatabaseInfo');
        $this->config   = ComponentHelper::getComponentConfig();
        $this->menuitem = Factory::getApplication()->getMenu()->getActive();

        // Call and return the parent method
		return parent::display($tpl);
    }
}
