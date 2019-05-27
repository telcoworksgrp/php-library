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
class LegacyHelper
{

    /**
     * An array for holding a list of settings
     *
     * @var string[]
     */
    public static $SETTINGS = array();


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
        $data =array(), $headers = array())
    {
        $context = stream_context_create(array
        (
            'http' => array(
                'method' => $method,
                'header' => $headers,
                'content' => http_build_query($data)
            )
        ));

        return file_get_contents($url, false, $context);

    }


    /**
     * Get a list of numbers from the T3 API
     * -------------------------------------------------------------------------
     * @param  string   $prefix     Numbe prefix ('1300' or '1800')
     * @param  string   $type       Type of numbers to get ('FLASH' or 'LUCKYDIP')
     * @param  int      $minPrice   Minimum number price
     * @param  int      $maxPrice   Max number price
     * @param  int      $pageNo     Page to start at
     * @param  int      $pageSize   Max numbers per page
     * @param  bool     $showAll    Show all numbers
     * @param  string   $sortBy     Column to sort the results by
     * @param  string   $direction  Direction to sort the results by
     *
     * @return  object[]    A list of numbers with meta data
     */
    public static function getNumbers($prefix = '1300', $type = 'FLASH',
        $minPrice = 0, $maxPrice = 1000, $pageNo = 1, $pageSize = 500,
        $showAll = true, $sortBy = 'PRICE', $direction = 'ASCENDING')
    {

        // Compose an enpoint URL
        $params                       = array();
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
        $result = self::sendRequest(
            'https://portal.tbill.live/numbers-service-impl/api/Activations',
            'GET', $params, array('Content-type: application/json'));

        // Decode JSON response
        $result = jsoon_decode($result);

        // Add additional meta data
        foreach($result as $number) {

            $number->format1 = substr($number->number,0,4). substr(
                $number->number,4,3). substr($number->number,7,3);

	        $number->format2 = substr($number->number,0,4). " " . substr(
                $number->number,4,3). " " . substr($number->number,7,3);

            $number->format3 = substr($number->number,0,4) . " " . substr(
                $number->number,4,2) . " " . substr($number->number,6,2)." " .
                substr($number->number,8,2);

            $number->format4 = (!empty($number->word) ? $number->word :
                $number->format3);
        }

        // Return the result
        return $result;
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


    /**
     *  Block the user if thier IP belongs to a banned country. SecurityHelper::
     *  WORST_SPAM_COUNTRIES is a predefined list of the worst spam/bot
     *  countries according to Spamhaus. To avoid blocking Googlebot, the US is
     *  exluded from this predefined list.
     *  ------------------------------------------------------------------------
     */
    public static function blockBannedCountries()
    {
        if (SecurityHelper::checkIpLocation(
            SecurityHelper::WORST_SPAM_COUNTRIES)) {

            SecurityHelper::blockAccess();
        }
    }


    /**
     * Check the hidden honeypot form field. If it is missing or invalid then
     * the user will be blocked
     * -------------------------------------------------------------------------
     */
    public static function blockIfInvalidHoneypot()
    {
        if (!SecurityHelper::checkHoneypot()) {
            SecurityHelper::blockAccess();
        }
    }


    /**
     * Check the CSRF token. If it is missing or doesn't match the one stored
     * in the user's session then the user will be blocked
     * -------------------------------------------------------------------------
     */
    public static function blockIfInvalidCSRFToken()
    {
        if (!SecurityHelper::checkCSRFToken()) {
            SecurityHelper::blockAccess();
        }
    }


    /**
     * Check if the form ReCaptcha was successfully completed. If not, then
     * the user will be blocked
     * -------------------------------------------------------------------------
     */
    public static function blockIfInvalidReCaptcha()
    {
        if (!SecurityHelper::checkReCaptcha()) {
            SecurityHelper::blockAccess();
        }
    }


    /**
     * Start the user's session if not already started
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function startSession()
    {
        if (!isset($_SESSION)) {
            session_start();
        }
    }


    /**
     * Try to detect any affilate id's passed via the https request. If one
     * is found,then store the id in the user's session.
     * -------------------------------------------------------------------------
     * @return  bool    TRUE = An id was found, FALSE = no id was found
     */
    public function detectAffilateId()
    {
        if (isset($_REQUEST['affilate']) && !empty($_REQUEST['affilate'])) {

            $affilateId = trim($_REQUEST['affilate']);
            self::startSession();
            $_SESSION['affilate'] = $affilateId;
            return true;
        } else {
            return false;
        }
    }


}
