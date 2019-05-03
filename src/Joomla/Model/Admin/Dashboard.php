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

namespace TCorp\Joomla\Model\Admin;


use \TCorp\Joomla\Model\Admin\Generic;
use \Joomla\CMS\Factory;


class Dashboard extends Generic
{


    /**
       * Get information about server hosting the website
       * -------------------------------------------------------------------------
       * @return  object  The information
       */
      public function getServerInfo()
      {
          //  Initalize some local variables
          $result   = new \stdClass;
          $input    = Factory::getApplication()->input;

          // Add data to the result
          $result->ipaddress        = $input->server->get('SERVER_ADDR', '');
          $result->name             = $input->server->get('SERVER_NAME', '');
          $result->software         = $input->server->get('SERVER_SOFTWARE', '');
          $result->protocol         = $input->server->get('SERVER_PROTOCOL', '');
          $result->docroot          = $input->server->get('DOCUMENT_ROOT', '', 'raw');
          $result->os               = php_uname();
          $result->php_version      = PHP_VERSION;
          $result->php_extensions   = get_loaded_extensions();

          // Return the server data
          return $result;
      }


}
