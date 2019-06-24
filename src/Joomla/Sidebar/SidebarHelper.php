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

namespace TCorp\Joomla\Sidebar;

use \Joomla\CMS\Factory;
use \Joomla\CMS\Language\Text;


/**
 * Helper class for working with Joomla's admin sidebar
 */
class SidebarHelper
{

    /**
     * Add an item to the administration sidebar
     * -------------------------------------------------------------------------
     * @param string $caption   A caption for the item
     * @param string $view      A view name to which the item will link to
     * @param string $component The component to which the item will link to
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

}
