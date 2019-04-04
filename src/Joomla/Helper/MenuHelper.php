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
     * Get a list of menu items from a given menu
     * -------------------------------------------------------------------------
     * @param  string   $menuType   Name of the menu to get the items from
     *
     * @return array    An array of menu item objects
     */
    public static function getItems(string $menuType)
    {
        // Initialise some local variables
        $application = Factory::getApplication();
        $menu        = $application->getMenu();
        $default     = $menu->getDefault();
        $active      = $menu->getActive();
        $active      = (empty($active)) ? $default : $active;
        $result      = array();


        // Get the list of menu items
        $items = $menu->getItems('menutype', $menuType);


        // Process and add additional information to each item.
        foreach ($items as $k => $item) {

            // Process the item based on it's type
            switch($item->type) {

                case 'alias':
                    $item->link = 'index.php?Itemid=' . $item->params->get('aliasoptions');
                    $item->route = Route::_($item->link);
                    break;

                case 'url' :
                    break;

                case 'header' :
                    $item->route ='#';
                    break;

                case 'separator' :
                    $item->route ='#';
                    break;
            }

            // Check if the current item is the active item, or an alias of
            // the active item. If so add this information to the item
            // (for convience)
            $item->active = ($item->id == $active->id) ||
                ($item->params->get('aliasoptions') == $active->id);


            // Check if the current item is the default item. If so add this
            // information to the item (for convienance) and replace the route
            if ($item->default = $item->id == $default->id) {
                $item->route = '/';
            }

            // Add the item to the list of results
            $result[$item->id] = $item;
        }

        // Return the result;
        return $result;
    }




    /**
     * Arrange a flat list of menu items into a hierarchy of menu item objects
     * -------------------------------------------------------------------------
     * @param  array    $items  A flat list of menu items
     *
     * @return  array   The same list of menu items arranged into a hierarchy
     */
    public static function createHierarchy(array $items)
    {
        // Initialise some local variables
        $result = array();

        // Define a recusrsive ananonomous function for adding child items
        // to a menu item.
        $addChildren = function ($node, $items) use ( &$addChildren )
        {
            $result = $node;
            $result->children = array();

            foreach ($items as $item) {
                if ($item->parent_id == $result->id) {
                    $result->children[] = $item;
                }
            }

            if (!empty($result->children)) {
                foreach ($result->children as &$child) {
                    $child = $addChildren($child, $items);
                }
            }

            return $result;
        };

        // Recursively add all top level menu items
        foreach ($items as $item) {
            if (empty($item->parent_id) OR $item->parent_id == 1) {
                $result[] = $addChildren($item, $items);
            }
        }

        // Return the result;
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
