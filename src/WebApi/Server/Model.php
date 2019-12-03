<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\WebApi\Server;


/**
 * Base class for creating FuelPHP models
 */
class Model extends \Orm\Model
{


    public function hydrateFromInput()
    {
        $properties = array_keys($this->properties());

        foreach ($properties as $name) {

            $value = \Input::param($name, null);

            if (!is_null($value)) {
                $this->set($name, $value);
            }
        }

    }

}
