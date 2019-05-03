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
 * Helper class for working with Telecom Corp's Legacy sites/projects
 */
class Helper
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
    public static function sendRequest(string $url, string $method = 'GET', $data =
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


    /**
     * Send an email
     * -------------------------------------------------------------------------
     * @param  string $to           Receiver, or receivers of the mail.
     * @param  string $subject      Subject of the email to be sent.
     * @param  string $message      Message to be sent.
     * @param  mixed  $headers      String/array of additional headers to add
     * @return bool                 TRUE if successfully sent, FALSE otherwise
     */
    public static function sendEmail(string $to, string $subject,
        string $message, $headers = '')
    {
        return mail($to, $subject, $message, $headers);
    }


    /**
     * Composes an email message from all POST params - plus the IP address
     * of the remote user. This is a quick and dirty way some of the older
     * sites display form data in email notifications
     * -------------------------------------------------------------------------
     * @return  stying  An email message
     */
    public static function composeMessageFromPostParams()
    {
        // Initialise some local variables
        $params       = $_POST;
        $params['ip'] = $_SERVER['REMOTE_ADDR'];
        $result       = '';

        // Add a list of key-value pairs
        foreach ($params as $key => $value){
            $k = htmlentities($key);
        	$v = htmlentities($value);
            $result .= "$k - $v\n";
        }

        // Return the result
        return $result;
    }


    /**
     * Redirect the user's browser to another URL, preserving the current
     * URL parameters.
     * -------------------------------------------------------------------------
     * @param  string   $url             URL to redirect the user to
     * @param  bool     $preserveParams  Pass existing URL params to the redirect
     * @param  int      $statusCode      HTTP status code (usually 301 or 303)
     */
    public static function redirect(string $url, bool $preserveParams = TRUE,
        int $statusCode = 301)
    {
        // Append the exitsing params if needed
        if ($preserveParams) {

            $url = $url . ((strpos($url, '?')) ? '&' : '?') .
                $_SERVER['QUERY_STRING'];

        }

        // Redirect the user
        header('Location: ' . $url, true, $statusCode);
        exit();
    }



    /**
     * Disable browser caching of this request
     * -------------------------------------------------------------------------
     */
    public static function disableCache()
    {
        header("Cache-Control: max-age=0, no-cache, no-store, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
    }

}
