<?php
/**
 * =============================================================================
 *
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 * =============================================================================
 */

namespace TCorp\Joomla;

use \Joomla\CMS\Component\ComponentHelper;
use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Router\Route;
use \Joomla\CMS\Factory;


/**
 * Generic helper class fpr working with Joomla
 */
class Helper
{


    /**
     * Format a MySQL datetime value into a more user friendly format
     * -------------------------------------------------------------------------
     * @param  string   $dateTime   The MySQL datetime value to format
     * @param  string   $format     The output format (optional)
     * @param  string   $default    Default value if date is '0'/invalid
     *
     * @return string   A more user friendly datetime string
     */
    public static function formatMysqlDateTime($dateTime, string
        $format = 'd/m/Y h:i:s A', string $default = '-')
    {
        // If the value is '0' or invalid the return the default
        if (empty($dateTime) OR ($dateTime == '0000-00-00 00:00:00')) {
            return $default;
        }

        // Get and return the new value
        return HTMLHelper::_('date', $dateTime, $format, true);
    }



    /**
     * Get the component's global configuration
     * -------------------------------------------------------------------------
     * @param   string  $name   The name of the component (eg. com_articles).
     *                          If no name is given the name of the current/
     *                          active component is used.
     * @return  object   The components global configuration
     */
    public static function getComponentConfig(string $name = '')
    {
        if (empty($name)) {
            $name = Factory::getApplication()->input->get('option');
        }

        return ComponentHelper::getParams($name)->toObject();
    }



    /**
     * Proxy for adding an external script to the document, except a
     * little easier/cleaner when SRI or defer is needed.
     * -------------------------------------------------------------------------
     * @param string    $url           URL to the eternal javascript
     * @param string    $integrity     An SRI hash\
     * @param bool      $defer         Add a 'defer' attribute
     *
     * @return  void
     */
    public static function addScript(string $url, string $integrity = '',
    bool $defer = false)
    {
        // Initialise some local variables
        $options    = array();
        $attributes = array();

        // Add SRI hash if provoided
        if (!empty($integrity)) {
            $attributes['integrity']   = $integrity;
            $attributes['crossorigin'] = 'anonymous';
        }

        // Add the defer attribute
        if ($defer) {
            $attributes['defer'] = 'defer';
        }

        // Add the script to the document
        Factory::getDocument()->addScript($url, $options, $attributes);
    }



    /**
     * Proxy for adding an external stylesheets to the document, except a
     * little easier/cleaner when SRI hashes need to be added.
     * -------------------------------------------------------------------------
     * @param string    $url           URL to the eternal stylesheet
     * @param string    $integrity     An SRI hash
     *
     * @return  void
     */
    public static function addStylesheet(string $url, string $integrity = '')
    {
        // Initialise some local variables
        $options    = array();
        $attributes = array();

        // Add SRI hash if provoided
        if (!empty($integrity)) {
            $attributes['integrity']   = $integrity;
            $attributes['crossorigin'] = 'anonymous';
        }

        // Add the script to the document
        Factory::getDocument()->addStylesheet($url, $options, $attributes);
    }



    /**
     * Get a list of menu items from a given menu
     * -------------------------------------------------------------------------
     * @param  string   $menuType   Name of the menu to get the items from
     *
     * @return array    An array of menu item objects
     */
    public static function getMenuItems(string $menuType)
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
    public static function createMenuItemHierarchy(array $items)
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
    public static function getActiveMenuItem()
    {
        return Factory::getApplication()->getMenu()->getActive();
    }



    /**
     * Get the full name (as opposed to username) of given user id
     * -------------------------------------------------------------------------
     * @param   int     $userId     The id of the user
     * @param   string  $default    A value to return if unsucessful
     *
     * @return  string The full name of the given user
     */
    public static function getFullName($userId = 0, string $default = '-')
    {
        // Get and return the user's name
        return (empty($userId)) ? $default : Factory::getUser($userId)->name;
    }



    /**
     * Check if the a user is authorised to perform an action on a given asset
     * -------------------------------------------------------------------------
     * @param  string   $action     The action requested to perform
     * @param  string   $asset      The asset on which the action to be performed
     * @param  mixed    $userId     Id of the user, or null for the current user
     *
     * @return bool     TRUE if authorised, FALSE is not authorised
     */
    public static function isAuthorised(string $action, string $asset, $userId = null)
    {
        // Check if the user is authorised to perform the action on
        // the given asset and return the result
        return Factory::getUser($userId)->authorise($action, $asset);
    }

}
