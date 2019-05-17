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

namespace TCorp\Joomla\Module\Site;

use \Joomla\CMS\Helper\ModuleHelper AS JoomlaModuleHelper;


class GenericModule
{

    /**
     * The module's ID
     *
     * @var int
     */
    public $moduleId = 0;


    /**
     * The module's title, as displayed in module manager
     *
     * @var string
     */
    public $moduleTitle = '';


    /**
     * The type of module (eg: mod_menu)
     *
     * @var string
     */
    public $moduleType = '';


    /**
     * The position at which the module is to be displayed
     *
     * @var string
     */
    public $modulePosition = '';


    /**
     * Base path for hte module
     * -------------------------------------------------------------------------
     * @var string
     */
    public $basePath = '';


    /**
     * An id that can be added to the module's container element
     *
     * @var string
     */
    public $containerId = '';


    /**
     * A CSS class name to that can be added to the module's container element
     *
     * @var string
     */
    public $containerClass = '';



    /**
      * Constructor method for initialising new instances of this class
      * ------------------------------------------------------------------------
      * @param  mixed   $module Module info to base the new instance on
      */
    public function __construct($module)
    {
        // Initialise some class properties
        $this->moduleId       = $module->id;
        $this->moduleTitle    = $module->title;
        $this->moduleType     = $module->module;
        $this->modulePosition = $module->position;
        $this->basePath       = JPATH_BASE . "/modules/{$this->moduleType}/";
        $this->containerId    = "module-{$this->moduleId}";
        $this->containerClass = $this->moduleType;
    }



    /**
     * Get a path to a given layout for the module
     * -------------------------------------------------------------------------
     * @param  string $layout The name of the module layout
     *
     * @return string   Path to the layout file
     */
    public function getLayoutPath(string $layout = 'default')
    {
        return JoomlaModuleHelper::getLayoutPath($this->moduleType, $layout);
    }

}
