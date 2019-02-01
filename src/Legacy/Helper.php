<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
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
     * Detects a T2 affilate refferal and sets the appropriate cookies so that
     * the affilate id is remebered across subsequent requests
     * -------------------------------------------------------------------------
     */
    public static function detectT2AffilateRefferal()
    {
        // If an "affid" URL param exists, and it's value is a valid affilate
        // id then set an "affid" cookie to remember that value across
        // subsequent requests
        if (isset($_GET['affid']) AND self::validateT2AffilateId(
            $_GET['affid'])) {

            setrawcookie('affid', $_GET['affid']);
        }
    }


    /**
     * Check if a given T2 affilate id is valid. Valid T2 affilate ids consist
     * 8 characters including lower case letters and digits
     * -------------------------------------------------------------------------
     * @param  string   $id     An affilate id to check
     * @return bool             TRUE is valid, FALSE is invalid
     */
    public static function validateT2AffilateId(string $id) : bool
    {
        return (bool) preg_match('|^[A-Za-z0-9]{8}$|', $id);
    }


    /**
     * Send an email
     * -------------------------------------------------------------------------
     * @param  string $to           Receiver, or receivers of the mail.
     * @param  string $subject      Subject of the email to be sent.
     * @param  string $message      Message to be sent.
     * @param  string $headers      Additional headers to be inserted
     * @return bool                 TRUE if successfully sent, FALSE otherwise
     */
    public static function sendEmail(string $to, string $subject,
        string $message, mixed $headers = '')
    {
        return mail($to, $subject, $message, $headers);
    }


}
