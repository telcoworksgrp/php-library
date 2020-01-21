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

namespace TCorp\Legacy;



/**
 * Legacy helper class for working with the T3 API
 */
class T3Api
{

    /**
     * Get a list of numbers from the T3 API
     * -------------------------------------------------------------------------
     * @param  string   $prefix     Numbe prefix ('1300' or '1800')
     * @param  string   $type       Type of numbers to get ('FLASH' or 'LUCKYDIP')
     * @param  int      $minPrice   Minimum number price
     * @param  int      $maxPrice   Max number price
     * @param  int      $pageNo     Page to start at
     * @param  int      $pageSize   Max numbers per page
     * @param  string   $sortBy     Column to sort the results by
     * @param  string   $direction  Direction to sort the results by
     *
     * @return  object[]    A list of numbers with meta data
     */
    public static function getNumbers($prefix = '1300', $type = 'FLASH',
        $minPrice = 0, $maxPrice = 1000, $pageNo = 1, $pageSize = 500,
        $sortBy = 'PRICE', $direction = 'ASCENDING')
    {

        // Compose an enpoint URL
        $params                       = [];
        $params['query']              = $prefix;
        $params['numberTypes']        = 'SERVICE_NUMBER';
        $params['serviceNumberTypes'] = $type;
        $params['minPriceDollars']    = $minPrice;
        $params['maxPriceDollars']    = $maxPrice;
        $params['pageNum']            = $pageNo;
        $params['pageSize']           = $pageSize;
        $params['sortBy']             = $sortBy;
        $params['sortDirection']      = $direction;


        // Get the data from the API
        $result = Utils::sendRequest(
            'https://portal.tbill.live/numbers-service-impl/api/Activations',
            'GET', $params, ['Content-type: application/json']);

        // Decode JSON response
        $result = json_decode($result);

        // Add additional meta data
        foreach($result as $number) {
            $number->format1 = preg_replace('|^(\d{4})(\d{6})$|i', '$1 $2', $number->number);
	        $number->format2 = preg_replace('|^(\d{4})(\d{3})(\d{3})$|i', '$1 $2 $3', $number->number);
            $number->format3 = preg_replace('|^(\d{4})(\d{2})(\d{2})(\d{2})$|i', '$1 $2 $3 $4', $number->number);
            $number->format4 = (!empty($number->word) ? $number->word : $number->format3);
        }

        // Return the result
        return $result;
    }

}
