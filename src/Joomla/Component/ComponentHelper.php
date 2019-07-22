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

namespace TCorp\Joomla\Component;

use \Joomla\CMS\Factory;
use \Joomla\CMS\Component\ComponentHelper AS JoomlaComponentHelper;
use \Joomla\CMS\Table\Table;


/**
 * Helper class for working with joomla components
 */
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
    public static function getConfig(string $name = '')
    {
        if (empty($name)) {
            $name = Factory::getApplication()->input->get('option');
        }

        return JoomlaComponentHelper::getParams($name)->toObject();
    }


    /**
     * Get an instance of a table class from a component's back-end
     * -------------------------------------------------------------------------
     * @param  string   $component  The component to which the table class
     *                              belongs ( eg: com_example )
     * @param string    $type       The type (name) of the Table class to get
     *                              an instance of
     * @param  string   $prefix     An prefix for the table class name
     * @param  array    $config     Array of config values for the Table object
     *
     * @return  Table|boolean   A Table object if found / false on failure.
     */
    public static function getAdminTable(string $component, string $type,
        string $prefix = '', $config = [])
    {
        // Add the location of the component's back-end tables
        Table::addIncludePath(JPATH_ADMINISTRATOR .
            "/components/$component/tables");

        // If no prefix has been given assume a concatenation of the component
        // name (without "com_") and "Table".
        if (empty($prefix)) {
            $prefix = ucfirst(preg_replace('|^com_(.*)$|i',
                '$1Table' , $component));
        }

        // Get an instance of the given table
        $result = Table::getInstance($type, $prefix, $config);

        // Return the final result
        return $result;
    }


}
