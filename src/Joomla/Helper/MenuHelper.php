<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Helper;


use \Joomla\CMS\Factory;
use \Joomla\CMS\Router\Route;


class MenuHelper
{


    /**
     * Perform additional preparations on a list of menu items
     * -------------------------------------------------------------------------
     * @param  object[]     $menuItemList   A list of menu items
     *
     * @return object[]     A list of prepared menu items
     */
    public static function prepareMenuItemList(array $menuItemList)
    {
        // Initialise some local variables
        $result = $menuItemList;

        // Perform additional preparations on each menu item
        foreach ($result as &$item) {
            $item = self::prepareMenuItem($item);
        }

        // Return the result
        return $result;
    }



    /**
     * Perform additional preparations on a menu item
     * -------------------------------------------------------------------------
     * @param  object   $menuItem   The menu item to prepare
     *
     * @return object   A prepared menu item
     */
    public static function prepareMenuItem($menuItem)
    {
        // Initialise some local variables
        $application = Factory::getApplication();
        $menu        = $application->getMenu();
        $default     = $menu->getDefault();
        $active      = $menu->getActive();
        $active      = (empty($active)) ? $default : $active ;
        $result      = $menuItem;

        // Add a property to indicate that the menu item currently
        // is/is not active
        $result->active = $result->id == $active->id;

        // Add a property to indicate that the menu item the site's
        // default menu item
        $result->default = (bool) $result->home;

        // If the menu item is an alias then set the route
        // to the targets route
        if ($result->type == 'alias') {
            $result->route = $result->flink;
        }

        // If the menu item is a URL menu item set the route
        if ($result->type == 'url') {
            $result->route = ($result->link == '#')
                ? '#' : Route::_($result->link);
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
