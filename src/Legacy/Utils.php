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
 * Legacy helper containing misc methods
 */
class Utils
{

    /**
     * Send a very basic HTTP request and return the response body
     * -------------------------------------------------------------------------
     * @param  string   $url        The URL to send the quest to
     * @param  string   $method     The HTTP verb/type of request to use
     * @param  array    $data       Data to send with the request
     * @param  string[] $headers    Data to send with the request
     *
     * @return string               The reponse body
     */
    public static function sendRequest(string $url, string $method = 'GET',
        $data = [], $headers = [])
    {

        // Initialise a HTTP client and send the request
        $client                 = new \GuzzleHttp\Client();
        $options                = [];
        $options['query']       = $data;
        $options['headers']     = $headers;
        $options['http_errors'] = true;
        $response               = $client->request($method, $url, $options);

        // Return the result body
        return $response->getBody();
    }

}
