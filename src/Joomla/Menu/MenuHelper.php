<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Menu;


defined('_JEXEC') or die();


use \Joomla\CMS\Factory;
use \Joomla\CMS\Menu\MenuHelper AS JoomlaMenuHelper;


class MenuHelper
{

    /**
     * Get a hierarchy of menu items
     * -------------------------------------------------------------------------
     * @param  string   $menuType   The name of the menu
     * @param  int      $maxLevel   Max depth of menu item hierarchy, 0 = All
     *
     * @return array    An list menu items arranged into a hierarchy of objects
     */
    public static function getItems(string $menuType, int $maxLevel = 0)
    {
        // Initialise some local variables
        $application = Factory::getApplication();
		$menu        = $application->getMenu();
        $result      = array();

        // Get a list of menu items
        $result = $menu->getItems('menutype', $menuType);

        // Remove all menu items that are above the max level
        if ($maxLevel > 0) {
            foreach ($result AS $key => $item) {
                if ($item->level > $maxLevel) {
                    unset($result[$key]);
                }
            }
        }

        // Pre-process each menu item
		$activeMenuItem = $menu->getActive();
		foreach($result as &$item) {

            if ($item->type == 'alias') {
                $target = $menu->getItem($item->params->get('aliasoptions'));
                $item->route =  $target->route;
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

        // Turn the flat list of menu items into a hierarchy of menu item
        // objects
        if ($maxLevel > 1){
            $result = JoomlaMenuHelper::createLevels($result);
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
