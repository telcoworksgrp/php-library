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

namespace TCorp\Joomla\Toolbar;

use \TCorp\Joomla\USer\UserHelper;
use \Joomla\CMS\Toolbar\ToolbarHelper AS JoomlaToolBarHelper;
use \Joomla\CMS\Language\Text;


/**
 * Helper class for working with Joomla's admin toolbar
 */
class ToolbarHelper
{

    /**
     * Set the title of the administration toolbar
     * -------------------------------------------------------------------------
     * @param string    $title  A new title
     *
     * @return  void
     */
    public static function setTitle(string $title) : void
    {
        JoomlaToolBarHelper::title(Text::_($title));
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
       if (UserHelper::isAuthorised('core.edit', $component)) {
           JoomlaToolbarHelper::apply($controller . '.apply');
           JoomlaToolbarHelper::save($controller . '.save');

           if (UserHelper::isAuthorised('core.create',  $component)) {
               JoomlaToolbarHelper::save2new($controller . '.save2new');
           }
       }

       // Add a cancel button
       JoomlaToolBarHelper::cancel($controller . '.cancel');
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
       if (UserHelper::isAuthorised('core.create', $component)) {
           JoomlaToolBarHelper::addNew($itemController . '.add');
       }

       // Add an Edit" button
       if (UserHelper::isAuthorised('core.edit', $component)) {
           JoomlaToolBarHelper::editList($itemController . '.edit');
       }

       // Add an publish and unpublish button
       if (UserHelper::isAuthorised('core.edit.state', $component)) {

           JoomlaToolBarHelper::publish($listController . '.publish',
                'JTOOLBAR_PUBLISH', true);

           JoomlaToolBarHelper::unpublish($listController . '.unpublish',
                'JTOOLBAR_UNPUBLISH', true);
       }

       // Add a delete button
       if (UserHelper::isAuthorised('core.delete', $component)) {
           JoomlaToolBarHelper::deleteList('', $listController . '.delete');
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
    public static function addOptionsBtn(string $component) : void
    {
        if (UserHelper::isAuthorised('core.admin', $component)) {
          JoomlaToolBarHelper::preferences($component);
      }
    }

}
