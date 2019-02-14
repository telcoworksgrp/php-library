<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Component\Model\Admin;

defined('_JEXEC') or die();

use \Joomla\CMS\MVC\Model\ListModel;

class ItemList extends ListModel
{

    /**
     * Get a table object, load it if necessary.
     * -------------------------------------------------------------------------
     * @param  string   $type       The table name.
     * @param  string   $prefix     The class prefix.
     * @param  array    $config     Configuration array for table.
     *
     * @return \JTable              A JTable object
     */
    public function getTable($type = '', $prefix = '', $config = array())
    {
        // If not given, detect type and prefix based on the class name
        $type   = (empty($type)) ? $this->getName() : $type;
        $prefix = (empty($prefix)) ? ucfirst($this->option) . 'Table' : $prefix;

        // Call and return the parent method
        return parent::getTable($type, $prefix, $config);
    }

}
