<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Component\Router\Site;

defined('_JEXEC') or die();

use \Joomla\CMS\Component\Router\RouterBase;
use \Joomla\CMS\Factory;

abstract class Generic extends RouterBase
{


    /**
     * Holds a database connector
     *
     * @var /JDatabaseDriver
     */
    protected $db = null;



    public function __construct($app = null, $menu = null)
    {
        // Initialise some class properties
        $this->db = Factory::getDbo();

        // Call the parent constructor
        parent::__construct($app, $menu);
    }

}
