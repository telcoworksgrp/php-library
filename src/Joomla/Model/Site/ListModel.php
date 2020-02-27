<?php
/**
 * =============================================================================
 * @package     Telcoworks Group PHP Library
 * @author      David Plath <webmaster@telcoworksgrp.com.au>
 * @copyright   Copyright (c) 2020 Telcoworks Group. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TelcoworksGrp\Joomla\Model\Site;

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
