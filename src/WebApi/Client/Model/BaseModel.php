<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\WebApi\Client\Model;

use \TCorp\WebApi\Client\BaseClient;


/**
 * Base class for creating models that abstract the web api
 */
class BaseModel
{

    /**
     * An instance of a WebApi client for send/receiving
     * data from the API
     *
     * @var \TCorp\WebApi\BaseClient
     */
    protected $client = null;


    /**
     * Enpoint URL to send. Relative URLs are relative to the base Url
     * defined in the WebApi Client
     *
     * @var string
     */
    protected static $endpoint = '';


    /**
     * Constructor for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @param \TCorp\WebApi\BaseClient    $apiClient    An WebApi client instance
     */
    public function __construct(BaseClient $client)
    {
        // Initialise some class properties
        $this->client = $client ;
    }

}
