<?php
/**
 * =============================================================================
 * @package     Telcoworks Group PHP Library
 * @author      David Plath <webmaster@telcoworksgrp.com.au>
 * @copyright   Copyright (c) 2020 Telcoworks Group. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TelcoworksGrp\WebApi\Server;


/**
 * Base class for creating ORM models
 */
class Model extends \Orm\Model
{

    /**
     * Hydrate the ORM model with values from the script's input
     * -------------------------------------------------------------------------
     * @return void
     */
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
