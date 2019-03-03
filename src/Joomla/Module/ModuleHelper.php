<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Module;

defined('_JEXEC') or die();

class ModuleHelper
{
    /**
     * A copy of the module originally passed to the constructor
     *
     * @var \stdClass
     */
    protected $module = null;


    /**
     * Constructor method for initialising new instances
     * -------------------------------------------------------------------------
     * @param  \stdClass  $module    Module information
     */
    public function __construct($module)
    {
        // Store a copy of the module for later use
        $this->module = $module;
        $this->module->params = json_decode($this->module->params);
    }


    /**
     * Get all data needed to render the module's layout
     * -------------------------------------------------------------------------
     * @return object   Data for rendering the module's layout
     */
    public function getData()
    {
        // Return the modules params
        return $this->module->params;
    }
}
