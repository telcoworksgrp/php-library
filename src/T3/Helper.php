<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\T3;

use \TCorp\T3\Client AS T3Client;


/**
 * Helper class for working with Telecom Corporate's T3 system
 */
class Helper
{


     /**
      * Get a list of number from the T3 API
      * ------------------------------------------------------------------------
      * @param  string  $prefix     Number prefix ('1300' or '1800')
      * @param  string  $type       Type of numbers ('FLASH' or 'LUCKY_DIP')
      * @param  int     $minPrice   Minimum price (in dollars)
      * @param  int     $maxPrice   Max price (in dollars)
      * @param  int     $pageNo     Page to start at
      * @param  int     $pageSize   Max numbers per page
      * @param  string  $sortBy     Column to sort the results by
      * @param  string  $direction  Direction to sort the results by
      *
      * @return stdClass[]
      */
    public static function getNumberList($prefix = '1300', $type = 'FLASH',
        $minPrice = 0, $maxPrice = 1000, $pageNo = 1, $pageSize = 500,
        $sortBy = 'PRICE', $direction = 'ASCENDING')
    {
        // Query the T3 API and get the results
        $client = new T3Client();
        $client->setResource("Activations");
        $client->setParam("query", $prefix);
        $client->setParam("numberTypes", "SERVICE_NUMBER");
        $client->setParam("serviceNumberTypes", $type);
        $client->setParam("minPriceDollars", $minPrice);
        $client->setParam("maxPriceDollars", $maxPrice);
        $client->setParam("pageNum", $pageNo);
        $client->setParam("pageSize", $pageSize);
        $client->setParam("sortBy", $sortBy);
        $client->setParam("sortDirection", $direction);
        $result = $client->execute();

        // Return the final result
        return $result;
    }

}
