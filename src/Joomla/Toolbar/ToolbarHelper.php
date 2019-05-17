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

}
