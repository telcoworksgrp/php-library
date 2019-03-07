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
     * Get a list menu items, with the option of arranging the list into
     * a nested tree of objects
     * -------------------------------------------------------------------------
     * @param  string   $menuType       The name of the menu
     * @param  int      $baseItemId     A menu item id to start from, 0 = none
     * @param  int      $maxDepth       Max depth of hierarchy, 0 = Unlimited
     * @param  bool     $nested         Arrange menu items into a nested tree
     *
     * @return \stClass[]   Menu items arranged into a hierarchy of objects
     */
    public static function getItems(string $menuType, int $baseItemId = 0,
    int $maxDepth = 0, bool $nested = true)
    {
        // Initialise some local variables
        $application    = Factory::getApplication();
        $database       = Factory::getDbo();


        // If $baseItemId is not given then use the the nested table's
        // root node (the parent of all top level menu items) - effectivly
        // returning the entire menu tree for the given menu.
        $baseItemId = ($baseItemId == 0) ? 1 : $baseItemId;


        // Build and execute a database query to get the menu items
        $query = $database->getQuery(true);
        $query->select("a.*");
        $query->from("#__menu AS a");
        $query->from("#__menu AS b");
        $query->where("b.id = $baseItemId");
        $query->where("a.lft BETWEEN b.lft AND b.rgt");
        $query->where("a.menutype = '$menuType'");
        $query->where("a.published = 1");
        $query->where("a.client_id = 0");
        $query->where("a.id <> $baseItemId");

        if ($maxDepth > 0) {
            $query->where("a.level BETWEEN b.level AND b.level + $maxDepth");
        }

        $query->order('a.lft ASC');
        $items = $database->setQuery($query)->loadObjectList();

        // Process the resulting list of menu items
        $items = self::processItems($items);

        // Turn the flat list of menu items into a hierarchy of objects
        $results = ($nested) ? self::structureItems(
            $items, $baseItemId) : $items;

        // Return the results
        return $results;
    }



    /**
     * Process a list of menu items
     * -------------------------------------------------------------------------
     * @param  array    $items  A list of menu items to process
     *
     * @return array    A list of processed menu items
     */
    protected static function processItems(array $items)
    {
        // Initialise some local variables
        $activeMenuItem = self::getActive();
        $result         = array();

        // Process each menu item
        foreach($items AS $item) {

            $item->params  = json_decode($item->params);

            $item->default = (bool) $item->home;

            $item->active = (!empty($activeMenuItem)) AND
                $item->id == $activeMenuItem->id;

            $item->route   = ($item->type == 'url') ?
                $item->link : Route::_($item->link);

            $result[$item->id] = $item;
        }

        // Return the result
        return $result;
    }



    /**
     * Structure a flat list of menu items into a hierarchy of objects
     * -------------------------------------------------------------------------
     * @param  array    $items          A list of menu items to arrange
     * @param  int      $baseItemId     ---
     *
     * @return array    Menu items arranged into a hierarchy of objects
     */
    protected static function structureItems(array $items, int $baseItemId)
    {
        // Initialise some local variables
        $results = array();

        // Declare a recusive anonymous function for adding child menu items
        $addChildren = function (&$item) use (&$addChildren, $items) {

            $item->children = array();

            foreach ($items AS $itm) {
                if ($itm->parent_id == $item->id) {
                    $item->children[] = $itm;
                }
            }

            foreach ($item->children AS $child) {
                $addChildren($child);
            }

        };

        // Process each top level item. A "top level item" is an item that has
        // a parent id of $baseItemId
        foreach ($items as &$item) {

            if ($item->parent_id == $baseItemId) {
                $addChildren($item);
                $results[$item->id] = $item;
            }

        }

        // Return the result
        return $results;
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
