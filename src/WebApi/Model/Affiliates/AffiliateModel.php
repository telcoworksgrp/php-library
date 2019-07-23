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

namespace TCorp\WebApi\Model\Affiliates;

use \TCorp\WebApi\Model\ItemModel;


class AffiliateModel extends ItemModel
{

    protected static $endpoint = 'affiliates/';

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
    	't3code',
    	'published',
    	'featured',
    	'created',
    	'note'
    ];

}
