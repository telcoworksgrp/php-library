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
 * Base class for creating FuelPHP controllers
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
    }


    /**
     * Create a new item
     * -------------------------------------------------------------------------
     * @return \Response
     */
    public function post_create()
    {
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
    }

}
