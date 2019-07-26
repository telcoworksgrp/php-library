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

namespace TCorp\WebApi\Server\Controller;



class BaseController extends \Controller_Rest
{

    /**
     * Holds the default output format
     *
     * @var string
     */
    protected $format = 'json';


    /**
     * A HTTP response code that needs to be returned
     *
     * @var int
     */
    protected $status = 200;


    /**
     * Data to be included in the response
     *
     * @var \stdClass
     */
    protected $result = null;


    /**
     * Constructor method for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @param \Request  $request    The current request object
     */
    public function __construct(\Request $request)
    {
        // Call the parent constructor
        parent::__construct($request);

        // Initialise some class properties
        $this->result = new \stdClass();
    }


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


    /**
     * Compose a response from class properties after the approciate controller
     * method has being called.
     * -------------------------------------------------------------------------
     * @return \Response    The finial response to send back
     */
    public function after($response)
	{
		return parent::after($this->response($this->result, $this->status));
	}

}
