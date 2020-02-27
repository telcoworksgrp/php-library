<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Joomla\Model\Site;

use \Joomla\CMS\MVC\Model\ListModel AS JListModel;


/**
 * Base class for creating list based front-end models
 */
class ListModel extends JListModel
{

    /**
     * Get the current ordering column
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getOrdering()
    {
        return $this->state->get('list.ordering');
    }


    /**
     * Get the current ordering direction
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getDirection()
    {
        return $this->state->get('list.direction');
    }

}
