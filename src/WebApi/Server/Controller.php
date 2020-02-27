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
 * Base class for creating REST controllers
 */
class Controller extends \Controller_Rest
{

    /**
     * Holds the default output format
     *
     * @var string
     */
    protected $format = 'json';


    /**
     * Get a list of items
     * -------------------------------------------------------------------------
     * @return \Response
     */
    public function get_list()
    {
        throw new \HttpNotFoundException;
    }


    /**
     * Create a new item
     * -------------------------------------------------------------------------
     * @return \Response
     */
    public function post_create()
    {
        throw new \HttpNotFoundException;
    }


    /**
     * Get a single item
     * -------------------------------------------------------------------------
     * @param   mixed   $id     The id of the item to delete
     *
     * @return \Response
     */
    public function get_read($id)
    {
        throw new \HttpNotFoundException;
    }


    /**
     * Update a single item
     * -------------------------------------------------------------------------
     * @param   mixed   $id     The id of the item to delete
     *
     * @return \Response
     */
    public function put_update($id)
    {
        throw new \HttpNotFoundException;
    }


    /**
     * Delete a single item
     * -------------------------------------------------------------------------
     * @param   mixed   $id     The id of the item to delete
     *
     * @return \Response
     */
    public function delete_delete($id)
    {
        throw new \HttpNotFoundException;
    }

}
