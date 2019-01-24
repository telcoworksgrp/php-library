<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Legacy\HTTP;

class Request
{

    /**
     * Send a very basic HTTP request and return the response body
     * -------------------------------------------------------------------------
     * @param  string   $url        The URL to send the quest to
     * @param  string   $method     The HTTP verb/type of request to use
     * @param  array    $data       Data to send with the request
     * @param  string[] $headers    Data to send with the request
     * @return string               The reponse body
     */
    public static function send(string $url, string $method = 'GET', $data =
    array(), $headers = array('Content-type: application/x-www-form-urlencoded'))
    {
        $context = stream_context_create(array
        (
            'http' => array(
                'method' => $method,
                'header' => $headers,
                'content' => http_build_query( $data )
            )
        ));

        return file_get_contents($url, false, $context);

    }


}
