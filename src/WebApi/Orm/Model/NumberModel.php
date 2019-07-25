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

namespace TCorp\WebApi\Orm\Model;



class NumberModel extends ItemModel
{

    protected static $endpoint = 'numbers/';

    protected static $properties = [
        'id',
        'number',
        'prefix',
        'suffix',
        'assigned',
        'allocated',
        'flashnum',
        'available',
        'reserved',
        'price',
        'allocatee',
        'alloc_date',
        'last_holder',
        'last_transfer_date',
        'erou_holder',
        'erou_assignment_date',
        'created',
        'updated',
        'note'
    ];

}
