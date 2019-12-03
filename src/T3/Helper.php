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
      * @return \TCorp\T3\Number[]
      */
    public static function getNumberList($prefix = '', $type = '',
        $minPrice = 0, $maxPrice = 1000, $pageNo = 1, $pageSize = 1000,
        $sortBy = 'NUMBER', $direction = 'ASCENDING')
    {
        // Initialise some local variables
        $result = [];

        // Query the T3 API and get the results
        $client = new Client();
        $client->setResource("Activations");

        if (!empty($prefix)) {
            $client->setParam("query", $prefix);
        }

        if (!empty($type)) {
            $client->setParam("serviceNumberTypes", $type);
        }

        $client->setParam("numberTypes", "SERVICE_NUMBER");
        $client->setParam("minPriceDollars", $minPrice);
        $client->setParam("maxPriceDollars", $maxPrice);
        $client->setParam("pageNum", $pageNo);
        $client->setParam("pageSize", $pageSize);
        $client->setParam("sortBy", $sortBy);
        $client->setParam("sortDirection", $direction);
        $items = $client->execute();

        // Process the results
        foreach ($items AS $k => $item) {
            $result[$item->number] = new Number($item);
        }

        // Return the final result
        return $result;
    }


    /**
     * Get all available numbers from the T3 API
     * -------------------------------------------------------------------------
     * @return \TCorp\T3\Number[]
     */
    public static function getAllNumbers()
    {
        $result = static::getNumberList('1300');
        $result = array_merge($result, static::getNumberList('1800'));
        return $result;
    }


    /**
     * Get information on a specific list of numbers
     * -------------------------------------------------------------------------
     * @param  string   $numbers    An array of numbers
     *
     * @return \TCorp\T3\Number[]
     */
    public static function getNumbers($numbers)
    {

        // Initialise some local variables
        $result = [];

        // Query the T3 API and get the results
        $client = new Client();
        $client->setResource("Activations");
        $client->setParam("query", implode(',', $numbers));
        $client->setParam("numberTypes", "SERVICE_NUMBER");
        $items = $client->execute();

        // Process the result
        foreach ($items AS $k => $item) {
            $result[$item->number] = new Number($item);
        }

        // Return the result
        return $result;
    }

}
