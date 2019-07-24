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
