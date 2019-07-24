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

namespace TCorp\WebApi\Orm;



class ClientModel extends ItemModel
{

    protected static $endpoint = 'clients/';

    protected static $properties = [
        'id',
    	'company',
    	'alias',
    	'intro',
    	'description',
    	'abn',
    	'address',
    	'suburb',
    	'state',
    	'postcode',
    	'country',
    	'latitude',
    	'longitude',
    	'phone',
    	'fax',
    	'mobile',
    	'email',
    	'website',
    	'thumbnail',
    	'image',
    	'logo',
    	'video',
    	'published',
    	'featured',
    	'created',
    	'note'
    ];

}
