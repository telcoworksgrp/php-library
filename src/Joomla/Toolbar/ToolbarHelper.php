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

use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Toolbar\ToolbarHelper AS JoomlaToolbarHelper;


/**
 * Helper class for workjing with Joomla's admin toolbar
 */
class ToolbarHelper
{

    /**
     * Set the title of the administration toolbar
     * -------------------------------------------------------------------------
     * @param string    $title  A new title
     */
    public static function setTitle(string $title)
    {
        JoomlaToolBarHelper::title(Text::_($title));
    }


    /**
     * Add a create/new button to the toolbar
     * -------------------------------------------------------------------------
     * @param   string    $component     The component the controller belongs to
     * @param   string    $controller    The sub-controller to run
     */
    public static function addCreateBtn(string $component, string $controller)
    {
        if (UserHelper::isAuthorised('core.create', $component)) {
            JoomlaToolBarHelper::addNew($controller . '.add');
        }
    }


    /**
     * Add a edit button to the toolbar
     * -------------------------------------------------------------------------
     * @param   string    $component     The component the controller belongs to
     * @param   string    $controller    The sub-controller to run
     */
    public static function addCreateBtn(string $component, string $controller)
    {
        if (UserHelper::isAuthorised('core.edit', $component)) {
            JoomlaToolBarHelper::editList($controller . '.add');
        }
    }


    /**
     * Add a publich and unpublish button to the toolbar
     * -------------------------------------------------------------------------
     * @param   string    $component     The component the controller belongs to
     * @param   string    $controller    The sub-controller to run
     */
    public static function addPublishBtns(string $component, string $controller)
    {
        if (UserHelper::isAuthorised('core.edit.state', $component)) {
            JoomlaToolBarHelper::publish($controller . '.publish',
                'JTOOLBAR_PUBLISH', true);
            JoomlaToolBarHelper::unpublish($controller . '.unpublish',
                'JTOOLBAR_UNPUBLISH', true);
        }
    }


    /**
     * Add a delete button to the toolbar
     * -------------------------------------------------------------------------
     * @param   string    $component     The component the controller belongs to
     * @param   string    $controller    The sub-controller to run
     */
    public static function addDeleteBtn(string $component, string $controller)
    {
        if (UserHelper::isAuthorised('core.delete', $component)) {
            JoomlaToolBarHelper::deleteList('', $listController . '.delete');
        }
    }


    /**
     * Add a component options button to the toolbar
     * -------------------------------------------------------------------------
     * @param   string    $component     The component name
     */
    public static function addOptionsBtn(string $component)
    {
        if (UserHelper::isAuthorised('core.admin', $component)) {
            JoomlaToolBarHelper::preferences($component);
        }
    }


}
