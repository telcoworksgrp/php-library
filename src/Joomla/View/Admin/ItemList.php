<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\View\Admin;

defined('_JEXEC') or die();

use \TCorp\Joomla\Helper\ComponentHelper;
use \TCorp\Joomla\Helper\MenuHelper;
use \Joomla\CMS\MVC\View\HtmlView;
use \Joomla\CMS\Factory;


class ItemList extends HtmlView
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
        $this->items         = $this->get('Items');
        $this->pagination    = $this->get('Pagination');
        $this->total         = $this->get('Total');
        $this->start         = $this->get('Start');
        $this->filterForm    = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->state         = $this->get('State');
        $this->ordering      = $this->escape($this->state->get('list.ordering'));
        $this->direction     = $this->escape($this->state->get('list.direction'));
        $this->config        = ComponentHelper::getComponentConfig();
        $this->menuitem      = MenuHelper::getActive();

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
