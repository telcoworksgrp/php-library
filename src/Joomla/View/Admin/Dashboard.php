<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\View\Admin;

defined('_JEXEC') or die();

use \TCorp\Joomla\View\Admin\Generic;

class Dashboard extends Generic
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
        $this->server   = $this->get('ServerInfo');

        // Call and return the parent method
		return parent::display($tpl);
    }
}
