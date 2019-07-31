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

namespace TCorp\Joomla\Helper;

use \TCorp\Joomla\Menu\MenuHelper;
use \TCorp\Joomla\Component\ComponentHelper;
use \TCorp\Joomla\User\UserHelper;
use \TCorp\Joomla\Toolbar\ToolbarHelper;
use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Router\Route;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Language\Text;


/**
 * Generic helper class fpr working with Joomla
 */
class JoomlaHelper
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
     *
     * @deprecated  Use \TCorp\Joomla\Component\ComponentHelper::getConfig() instead
     */
    public static function getComponentConfig(string $name = '')
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return ComponentHelper::getConfig($name);
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
     *
     * @deprecated  Use \TCorp\Joomla\Menu\MenuHelper::getMenuItems() instead
     */
    public static function getMenuItems(string $menuType)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return MenuHelper::getMenuItems($menuType);
    }



    /**
     * Arrange a flat list of menu items into a hierarchy of menu item objects
     * -------------------------------------------------------------------------
     * @param  array    $items  A flat list of menu items
     *
     * @return  array   The same list of menu items arranged into a hierarchy
     *
     * @deprecated  Use \TCorp\Joomla\Menu\MenuHelper::createMenuItemHierarchy() instead
     */
    public static function createMenuItemHierarchy(array $items)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return MenuHelper::createMenuItemHierarchy($menuType);
    }


    /**
     *  Get the currently active menu item
     * -------------------------------------------------------------------------
     * @return  object  The currently active menu item
     *
     * @deprecated  Use \TCorp\Joomla\Menu\MenuHelper::getActiveMenuItem() instead
     */
    public static function getActiveMenuItem()
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return MenuHelper::getActiveMenuItem();
    }


    /**
     * Check if the a user is authorised to perform an action on a given asset
     * -------------------------------------------------------------------------
     * @param  string   $action     The action requested to perform
     * @param  string   $asset      The asset on which the action to be performed
     * @param  mixed    $userId     Id of the user, or null for the current user
     *
     * @return bool     TRUE if authorised, FALSE is not authorised
     *
     * @deprecated  Use \TCorp\Joomla\User\UserHelper::isAuthorised() instead
     */
    public static function isAuthorised(string $action, string $asset, $userId = null)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return UserHelper::isAuthorised($action, $asset, $userId);
    }


    /**
     * Get the full name (as opposed to username) of given user id
     * -------------------------------------------------------------------------
     * @param   int     $userId     The id of the user
     * @param   string  $default    A value to return if unsucessful
     *
     * @return  string The full name of the given user0
     *
     * @deprecated  Use \TCorp\Joomla\User\UserHelper::getFullName() instead
     */
    public static function getFullName($userId = 0, string $default = '-')
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        return UserHelper::getFullName($userId, $default);
    }



    /**
     * Set the title of the administration toolbar
     * -------------------------------------------------------------------------
     * @param string    $title  A new title
     *
     * @deprecated  Use \TCorp\Joomla\Toolbar\ToolbarHelper::setTitle instead
     */
    public static function setToolbarTitle(string $title)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        ToolBarHelper::setTitle($title);
    }



    /**
     * Adds a standard set of toolbar items while editing an item
     * -------------------------------------------------------------------------
     * @param string    $component      Component to which the item controller belongs to
     * @param string    $controller     Controller to execute actions on
     *
     *  @deprecated  Use \TCorp\Joomla\Toolbar\ToolbarHelper::addStandardItemToolbarBtns instead
     */
    public static function addStandardItemToolbarBtns(string $component,
        string $controller)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        ToolBarHelper::addStandardItemToolbarBtns($component, $controller);
    }



    /**
     * Adds a standard set of toolbar items while viewing a list of items
     * -------------------------------------------------------------------------
     * @param string    $component          Component to which the controllers belong to
     * @param string    $itemController     Controller for executing item actions
     * @param string    $listController     Controller for executing list actions
     *
     *  @deprecated  Use \TCorp\Joomla\Toolbar\ToolbarHelper::addStandardListToolbarBtns instead
     */
    public static function addStandardListToolbarBtns(string $component,
        string $itemController, string $listController)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        ToolBarHelper::addStandardListToolbarBtns($component, $itemController, $listController);
    }


    /**
     * Add a global options button for this component to the
     * administration toolbar
     * -------------------------------------------------------------------------
     * @param string    $component  Component to show the button for.
     *
     *  @deprecated  Use \TCorp\Joomla\Toolbar\ToolbarHelper::addOptionsBtn instead
     */
    public static function addToolbarOptionsBtn(string $component)
    {
        trigger_error('Method ' . __METHOD__ . ' is deprecated', E_USER_DEPRECATED);
        ToolBarHelper::addOptionsBtn($component);
    }


}
