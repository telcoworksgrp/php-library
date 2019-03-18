<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Table\Admin;


use \Joomla\CMS\Table\Table;
use \Joomla\CMS\Application\ApplicationHelper;
use \Joomla\CMS\Factory;


class Generic extends Table
{
    /**
     * Store a row in the database from the JTable instance properties
     * -------------------------------------------------------------------------
     * @param   boolean     $updateNulls  True to update fields that are null
     * @return  boolean     True if successful
     */
    public function store($updateNulls = false)
    {
        // Initialise some local variables
        $currentDate   = Factory::getDate()->toSQL();
        $currentUserId = Factory::getUser()->get('id');
        $applciation   = Factory::getApplication();
        $ipAddress     = $applciation->input->server->get('REMOTE_ADDR','');
        $isNew         = empty($this->id);
        $database      = Factory::getDbo();


        // If an alias field exists, make sure we have a valid alias.
        if (property_exists($this, 'alias')) {

            //  If the alias field is empty then generate an alias
            //  based on the title
            if (empty($this->alias)) {
                $this->alias = ApplicationHelper::stringURLSafe($this->title);
                $this->alias = trim($this->alias);
            }

            // Check that the alias doesn't already exist for another item
            $query = $database->getQuery(true);
            $query->select('id');
            $query->from($this->getTableName());
            $query->where('alias = "' . $this->alias . '"');
            $query->where('id <> ' . $this->id);
            $aliasExists = (bool) $database->setQuery($query)->loadResult();

            if ($aliasExists) {
                $this->setError('Alias Already Exists');
                return false;
            }

        }

        // If a created property exists, and we are creating a new record then
        // set the property's value to the current date and time
        if (property_exists($this, 'created') AND ($isNew))
            $this->created = $currentDate;

        // If a created_by property exists, and we are creating a new record
        // then set the property's value to the current user's id
        if (property_exists($this, 'created_by') AND ($isNew))
            $this->created_by = $currentUserId;

        // If a created_ip property exists, and we are creating a new record
        // then set the property's value to the current user's IP address
        if (property_exists($this, 'created_ip') AND ($isNew))
            $this->created_ip = $ipAddress;

        // If a modified property exists, and we are updating an existing
        // record then set the property's value to the current date and time
        if (property_exists($this, 'modified') AND (!$isNew))
            $this->modified = $currentDate;

        // If a modified_by property exists, and we are updating an existing
        // record then set the property's value to the current user's id
        if (property_exists($this, 'modified_by') AND (!$isNew))
            $this->modified_by = $currentUserId;

        // If a modified_ip property exists, and we are updating an existing
        // record then set the property's value to the current user's IP address
        if (property_exists($this, 'modified_ip') AND (!$isNew))
            $this->modified_ip = $ipAddress;

        // Call and return the parent method
        return parent::store($updateNulls);
    }
}
