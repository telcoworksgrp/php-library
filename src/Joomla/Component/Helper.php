<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Component;

defined('_JEXEC') or die();

use \Joomla\CMS\Factory;
use \Joomla\CMS\Component\ComponentHelper;


class Helper
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

        return ComponentHelper::getParams($name)->toObject();
    }

}