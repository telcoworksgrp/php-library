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

use \Joomla\CMS\MVC\Model\ItemModel AS JItemModel;
use \Joomla\CMS\Factory;


/**
 * Base class for creating item based front-end models
 */
class ItemModel extends JItemModel
{

    /**
     * Auto-populate the model state.
     * -------------------------------------------------------------------------
     * @return  void
     */
    protected function populateState()
    {
        // Initialize some local variables
        $input = Factory::getApplication()->input;

        // Set the item id in the model state
        $this->setState('id', $input->getInt('id', 0));

        // Call the parent method
        parent::populateState();
    }

}
