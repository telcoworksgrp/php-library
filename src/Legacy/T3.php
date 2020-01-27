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
 * Class for working with the T3 Api
 */
class T3
{


    /**
     * Base URI for all API endpoints
     *
     * @var string
     */
    public $baseUri = 'https://portal.tbill.live/numbers-service-impl/api/';



    /**
     * Get a list of numbers from the T3 API
     * -------------------------------------------------------------------------
     * @param  string   $prefix     Numbe prefix ('1300' or '1800')
     * @param  string   $type       Type of numbers to get ('FLASH' or 'LUCKYDIP')
     * @param  int      $minPrice   Minimum number price
     * @param  int      $maxPrice   Max number price
     * @param  int      $page       Page to start at
     * @param  int      $limit      Max numbers per page
     * @param  string   $sortBy     Column to sort the results by
     * @param  string   $direction  Direction to sort the results by
     *
     * @return  object[]    A list of numbers with meta data
     */
    public function getNumbers($prefix = '1300', $type = 'FLASH', $minPrice = 0,
        $maxPrice = 1000, $page = 1, $limit = 500, $sortBy = 'PRICE',
        $direction = 'ASCENDING')
    {

        // Compose a HTTP request
        $client                       = new \GuzzleHttp\Client();
        $url                          = "{$this->baseUri}Activations";
        $params                       = [];
        $params['query']              = $prefix;
        $params['numberTypes']        = 'SERVICE_NUMBER';
        $params['serviceNumberTypes'] = $type;
        $params['minPriceDollars']    = $minPrice;
        $params['maxPriceDollars']    = $maxPrice;
        $params['pageNum']            = $page;
        $params['pageSize']           = $limit;
        $params['sortBy']             = $sortBy;
        $params['sortDirection']      = $direction;
        $headers                      = ['Content-type: application/json'];
        $options                      = ['query' => $params, 'headers' => $headers];
        $response                     = $client->get($url, $options);

        // Decode JSON response
        $result = json_decode($response->getBody());

        // Add additional meta data
        foreach($result as $number) {
            $number = $this->addAltNumberFormats($number);
        }

        // Return the result
        return $result;
    }


    /**
     * Add alternate number display formats to a number returned by the API
     * -------------------------------------------------------------------------
     * @param  \stdClass   $number     A number returned by the T3 API
     *
     * @return \stdClass
     */
    private function addAltNumberFormats($number)
    {
        $number->format1 = preg_replace('|^(\d{4})(\d{6})$|i', '$1 $2', $number->number);
        $number->format2 = preg_replace('|^(\d{4})(\d{3})(\d{3})$|i', '$1 $2 $3', $number->number);
        $number->format3 = preg_replace('|^(\d{4})(\d{2})(\d{2})(\d{2})$|i', '$1 $2 $3 $4', $number->number);
        $number->format4 = (!empty($number->word) ? $number->word : $number->format3);

        // Return the result
        return $number;
    }    

}
