<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Component\View\Site;

defined('_JEXEC') or die();

use \TCorp\Joomla\Menu\Helper AS MenuHelper;
use \Joomla\CMS\MVC\View\HtmlView;
use \Joomla\CMS\Factory;

class Item extends HtmlView
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
        $this->item     = $this->get('Item');
        $this->state    = $this->get('State');
        $this->config   = ComponentHelper::getComponentConfig();
        $this->menuitem = MenuHelper->getActive();

        // If the item has a title then use it for the document title
        if (!empty($this->item)) {
            if (property_exists($this->item, 'title')) {
                $this->setDocumentTitle($this->item->title);
            }
        }

        // Call and return the parent method
        return parent::display($tpl);
    }
}
