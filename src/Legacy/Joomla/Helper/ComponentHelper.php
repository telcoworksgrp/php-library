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

namespace TCorp\Legacy\Joomla\Helper;


use \Joomla\CMS\Component\ComponentHelper AS JoomlaComponentHelper;
use \Joomla\CMS\Factory;


class ComponentHelper
{

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

        return JoomlaComponentHelper::getParams($name)->toObject();
    }

}
