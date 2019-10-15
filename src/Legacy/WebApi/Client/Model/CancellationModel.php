<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Legacy\WebApi\Client\Model;


class CancellationModel extends BaseModel
{

    protected static $endpoint = 'cancellations';

    protected static $properties = array(
        'id',
        'created',
        'updated',
        'note'
    );

}
