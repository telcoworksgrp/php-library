<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Menu;

defined('_JEXEC') or die();

use \Joomla\CMS\Factory;

class Helper
{
    /**
      * Get a listof top level menu items from a given menu
      * ------------------------------------------------------------------------
      * @param  string  $menuName   The name of the menu
      *
      * @return MenuItem[]  A list of top-level menu items
      */
     public static function getTopLevelMenuItems(string $menuName)
     {
		// Intialise some local variables
		$menu = Factory::getApplication()->getMenu();

		// Get a list of top level menu items
		$result = $menu->getItems(array('menutype','level'),
            array($menuName, 1));

		// Pre-process each menu item
		$activeMenuItem = $menu->getActive();
		foreach($result as &$item) {

            if ($item->type == 'alias') {
                $item = $menu->getItem($item->params->get('aliasoptions'));
            }

            if ($item->type == 'url') {
                $item->route = $item->link;
            }

            if ($item->home) {
                $item->route = '/';
            }

            $item->active = (!empty($activeMenuItem) AND
                $item->id == $activeMenuItem->id);
		}

		// Return the result
		return $result;
	}


    /**
     *  Get the currently active menu item
     * -------------------------------------------------------------------------
     * @return  object  The currently active menu item
     */
    public static function getActive()
    {
        return Factory::getApplication()->getMenu()->getActive();
    }

}
