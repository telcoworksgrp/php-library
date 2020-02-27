<?php
/**
 * =============================================================================
 * @package     Telcoworks Group PHP Library
 * @author      David Plath <webmaster@telcoworksgrp.com.au>
 * @copyright   Copyright (c) 2020 Telcoworks Group. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TelcoworksGrp\Joomla;

use \TelcoworksGrp\Utils AS MiscUtils;
use \Joomla\CMS\Component\ComponentHelper;
use \Joomla\CMS\MVC\Model\BaseDatabaseModel;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Router\Route;
use \Joomla\CMS\Table\Table;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Toolbar\ToolbarHelper;
use \Joomla\CMS\HTML\HTMLHelper;



/**
 * Utility class for useful methods for working with Joomla
 */
class Utils
{


    /**
     * Get the component's global configuration. if no component nmae is given
     * then the name of the current/active component will be used.
     * -------------------------------------------------------------------------
     * @param   string  $name   Optional name of the component (eg: com_content)
     *
     * @return  stdClass
     */
    public static function getComponentConfig(string $name = '')
    {
        // Initialise some local variables
        $input = Factory::getApplication()->input;

        // Check that we have a component name
        $name = (empty($name)) ? $input->get('option') : $name ;

        // Get the compontents golbal config
        $result = ComponentHelper::getParams($name)->toObject();

        // Return the result
        return $result;
    }


    /**
     * Get an instance of a component model
     * -------------------------------------------------------------------------
     * @param  string   $component  Component the model belongs to (eg: com_content)
     * @param  string   $name       Name/suffix of the model (eg: Articles)
     * @param  string   $admin      Look in the component's back-end
     * @param  boolean  $config     Config to pass to the model's constructor
     *
     * @return mixed
     */
    public static function getComponentModel(string $component, string $name,
        bool $admin = false, array $config = ['ignore_request' => true])
    {
        // Add the location of the model to the list of include paths
        $path   = ($admin) ? JPATH_ADMINISTRATOR : JPATH_SITE;
        $path  .= "/components/$component/models";
        $prefix = ucfirst(preg_replace('|^com_(.*)$|i', '$1Model' , $component));
        BaseDatabaseModel::addIncludePath($path, $prefix);

        // Get an instance of the given table
        $result = BaseDatabaseModel::getInstance($name, $prefix, $config);

        // Return the result
        return $result;

    }



    /**
     * Get an instance of a component table
     * -------------------------------------------------------------------------
     * @param  string   $component  Component the table belongs to (eg: com_content)
     * @param  string   $name       Name/suffix of the table (eg: Article)
     * @param  string   $admin      Look in the component's back-end
     * @param  boolean  $config     Config to pass to the table's constructor
     *
     * @return mixed
     */
    public static function getComponentTable(string $component, string $name,
        bool $admin = false, array $config = [])
    {
        // Add the location of the table to the list of include paths
        $path   = ($admin) ? JPATH_ADMINISTRATOR : JPATH_SITE;
        $path  .= "/components/$component/tables";
        $prefix = ucfirst(preg_replace('|^com_(.*)$|i', '$1Table' , $component));
        Table::addIncludePath($path, $prefix);

        // Get an instance of the given table
        $result = Table::getInstance($name, $prefix, $config);

        // Return the result
        return $result;

    }


    /**
     * Dumps a Joomla Database query with db table prefixes
     * ------------------------------------------------------------------------
     * @param  JDatabaseQuery   $query  The database query to dump
     * @param  bool             $die    Call die() after query has been dumped
     *
     * @return  void
     */
    public static function dumpDatabaseQuery($query, bool $die = true) : void
    {
        $database = Factory::getDbo();
        echo $database->replacePrefix((string) $query);

        if ($die) die();
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
     * Add an item to the administration sidebar
     * -------------------------------------------------------------------------
     * @param string    $caption    Caption for the item
     * @param string    $view       View name to which the item will link to
     * @param string    $component  Component to which the item will link to
     *
     * @return  void
     */
    public static function addSidebarItem(string $caption, string $view,
        string $component) : void
    {
        // Prepare the sidebar item
        $link    = "index.php?option=com_$component&view=$view";
        $active  = Factory::getApplication()->input->get('view') == $view;

        // Add the item to the sidebar
        \JHtmlSidebar::addEntry(Text::_($caption), $link, $active);
    }



    /**
     * Add a heading to the administration sidebar
     * -------------------------------------------------------------------------
     * @param string    $caption    A caption for the heading
     * @param string    $tagName    A HTML tag name to enclose the title in
     *
     * @return  void
     */
    public static function addSidebarHeading(string $caption,
        string $headingTag = 'h4') : void
    {
        // Prepare the sidebar heading
        $heading = Text::_($caption);
        $heading = "<$headingTag>$heading</$headingTag>";

        // Add the heading to the sidebar
        \JHtmlSidebar::addEntry($heading);
    }


    /**
     * Check if the a user is authorised to perform an action on a given asset
     * -------------------------------------------------------------------------
     * @param  string   $action     The action requested to perform
     * @param  string   $asset      The asset on which the action to be performed
     * @param  mixed    $userId     Id of the user, or null for the current user
     *
     * @return bool
     */
    public static function isAuthorised(string $action, string $asset,
        $userId = null)
    {
        // Check if the user is authorised to perform the action on
        // the given asset and return the result
        return Factory::getUser($userId)->authorise($action, $asset);
    }


    /**
     * Get the full name (as opposed to username) of given user id
     * -------------------------------------------------------------------------
     * @param   int     $userId     The id of the user
     * @param   string  $default    A value to return if unsucessful
     *
     * @return  string
     */
    public static function getFullName($userId = 0, string $default = '-')
    {
        // Get and return the user's name
        return (empty($userId)) ? $default : Factory::getUser($userId)->name;
    }



    /**
     * Set the title of the administration toolbar
     * -------------------------------------------------------------------------
     * @param string    $title  A new title
     *
     * @return  void
     */
    public static function setTitle(string $title) : void
    {
        ToolBarHelper::title(Text::_($title));
    }



    /**
     * Adds a standard set of toolbar items while editing an item
     * -------------------------------------------------------------------------
     * @param string    $component      Component the item controller belongs to
     * @param string    $controller     Controller to execute actions on
     *
     * @return  void
     */
    public static function addStandardItemToolbarBtns(string $component,
        string $controller) : void
    {
        // Add apply, save and save2new buttons
       if (static::isAuthorised('core.edit', $component)) {
           ToolBarHelper::apply($controller . '.apply');
           ToolBarHelper::save($controller . '.save');

           if (static::isAuthorised('core.create',  $component)) {
               ToolBarHelper::save2new($controller . '.save2new');
           }
       }

       // Add a cancel button
       ToolBarHelper::cancel($controller . '.cancel');
    }


    /**
     * Adds a standard set of toolbar items while viewing a list of items
     * -------------------------------------------------------------------------
     * @param string    $component          Component the controllers belong to
     * @param string    $itemController     Controller for executing item actions
     * @param string    $listController     Controller for executing list actions
     *
     * @return  void
     */
    public static function addStandardListToolbarBtns(string $component,
        string $itemController, string $listController) : void
    {

        // Add an new button
       if (static::isAuthorised('core.create', $component)) {
           ToolBarHelper::addNew($itemController . '.add');
       }

       // Add an Edit" button
       if (static::isAuthorised('core.edit', $component)) {
           ToolBarHelper::editList($itemController . '.edit');
       }

       // Add an publish and unpublish button
       if (static::isAuthorised('core.edit.state', $component)) {

           ToolBarHelper::publish($listController . '.publish',
                'JTOOLBAR_PUBLISH', true);

           ToolBarHelper::unpublish($listController . '.unpublish',
                'JTOOLBAR_UNPUBLISH', true);
       }

       // Add a delete button
       if (static::isAuthorised('core.delete', $component)) {
           ToolBarHelper::deleteList('', $listController . '.delete');
       }

    }


    /**
     * Add a global options button for this component to the
     * administration toolbar
     * -------------------------------------------------------------------------
     * @param string    $component  Component to show the button for.
     *
     * @return void
     */
    public static function addOptionsToolbarBtn(string $component) : void
    {
        if (static::isAuthorised('core.admin', $component)) {
          ToolBarHelper::preferences($component);
      }
    }


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
     * Get the current page title without a sitename prefix/suffix
     * -------------------------------------------------------------------------
     * @return string
     */
    public static function getPageTitle()
    {
        // Initialise some local variables
        $document = Factory::getDocument();
        $config   = Factory::getConfig();

        // Get the current page title
        $result = $document->getTitle();

        // Strip the sitename if it has been added
        $sitename = $config->get('sitename');
        $result = str_replace(" - $sitename", "", $result);
        $result = str_replace("$sitename - ", "", $result);

        // Return the result
        return $result;
    }


    /**
     * Add a single CSS rule to the document
     * -------------------------------------------------------------------------
     * @param string    $selector       A CSS selector for the CSS rule
     * @param array     $properties     A list of CSS property => value pairs
     *
     * @return void
     */
    public static function addStyleRule(string $selector, array $properties = [])
    {
        Factory::getDocument()->addStyleDeclaration(
            MiscUtils::arrayToCSSRule($selector, $properties));
    }

}
