<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp;


/**
 * Helper class for implementing various security techniques
 */
class Security
{

    /**
     * Country codes for some of the worst spam and bot countries according
     * to Spamhaus.
     *
     * @var string[]
     *
     * @link https://www.spamhaus.org/statistics/countries/
     * @link  https://www.spamhaus.org/statistics/botnet-cc/
     */
    const WORST_SPAM_COUNTRIES = array('CN','RU','UA','IN','FR','JP','GB',
    'HK','DE','EG','VN','IR','BR','TH','ID','PA','GG');



    /**
     * Get a CSRF token that can used to protect the site from XSS attacks
     * -------------------------------------------------------------------------
     * @return string   A CSRF token
     */
    public static function getCSRFToken()
    {
        // Start the session if not already started
        if (!isset($_SESSION)) {
            session_start();
        }

        // Generate and set the token if none exist in the session
        if (empty($_SESSION['CSRF'])) {
            $_SESSION['CSRF'] = bin2hex(random_bytes(32));
        }

        // Return the result
        return $_SESSION['CSRF'];
    }



    /**
     * Gets HTML for rendering a CSRF token inside a web form
     * -------------------------------------------------------------------------
     * @return string   HTML for rendering a CSRF token inside a web form
     */
    public static function getCSRFTokenHTML() : string
    {
        // Get a CSRF token
        $token = self::getCSRFToken();

        // Compose a HTML input form field
        $result = "<input type=\"hidden\" name=\"CSRF\" value=\"$token\">";

        // Return the result
        return $result;
    }



    /**
     * Check if the CSRF token in the POST params is valid (the same as the
     * one previously set in the session)
     * -------------------------------------------------------------------------
     * @return  bool    TRUE = Token is valid; FALSE = Toekn is NOT valid.
     */
    public static function checkCSRFToken() : bool
    {
        // Start the session if not already started
        if (!isset($_SESSION)) {
            session_start();
        }

        // Get the token submited in the post request
        $token = $_POST['CSRF'] ?? '';

        // Rteurn the result
        return hash_equals($_SESSION['CSRF'], $token);
    }



    /**
     * Gets HTML for rendering a hidden honeypot text field inside a web form
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a hidden honeypot text field
     */
    public static function getHoneypotHtml() : string
    {
        return "<input type=\"text\" name=\"c67538\" value=\"\" " .
            "style=\"display: none !important;\">";
    }



    /**
     * Check if a honeypot is empty. If the honeypot has not been submitted or
     * contains a value then it is most likely a bot.
     * -------------------------------------------------------------------------
     * @return  bool    TRUE = honeypot is valid, FALSE = honeypot is NOT valid
     */
    public static function checkHoneypot() : bool
    {
        return ($_POST['c67538'] ?? '-') === '';
    }



    /**
     * Check if the remote user's IP is from certain countries. This method
     * uses the IP Geolocation Service for up-to-date IP to location data.
     * API keys for this service can be obtained at https://ipgeolocation.io/
     * -------------------------------------------------------------------------
     * @param   array   $countryCodes     List of 2 or 3 char country codes
     * @param   string  $apiKey           API key issued by
     *
     * @return  bool    TRUE = IP belongs to one of the countries, FALSE is not
     */
    public static function checkIpLocation(array $countryCodes,
        string $apiKey) : bool
    {
        // Get location information from the API
        $endpoint  = "https://api.ipgeolocation.io/ipgeo?apiKey=$apiKey";
        $endpoint .=  "&ip=" . $_SERVER['REMOTE_ADDR'];
        $location = file_get_contents($endpoint);
        $location = json_decode($location);

        // Check if the IP belongs to one of the given countries
        $result = in_array($location->country_code2, $countryCodes) ||
            in_array($location->country_code3, $countryCodes);

        // Return the result
        return $result;
    }


    /**
     * Get the HTML/Javascript for displaying a reCAPTCHA 3
     * -------------------------------------------------------------------------
     * @param  string   $key        reCAPTCHA Site Key (issued by Google)
     *
     * @return string   HTML/Javascript needed to render reCAPTCHA 3
     */
    public static function getReCaptchaHtml(string $siteKey)
    {
        $result  = "<script src=\"https://www.google.com/recaptcha/api.js\" async defer></script>\n";
        $result .= "<div class=\"g-recaptcha\" data-sitekey=\"$siteKey\"></div>";
        return $result;
    }


    /**
     * Check if the user was successfully completed a reCAPTCHA 3
     * -------------------------------------------------------------------------
     * @param  string   $key    reCAPTCHA Secret Key (issued by Google)
     *
     * @return  bool
     */
    public static function checkReCaptcha(string $secretKey)
    {
        // Initialise some local variables
        $response  = $_POST['g-recaptcha-response'] ?? '';

        // Send POST http request to verify the response with Google
        $client = new \GuzzleHttp\Client();
        $url    = 'https://www.google.com/recaptcha/api/siteverify';
        $params = ['secret' => $secretKey, 'response' => $response];
        $result = $client->post($url, ['form_params' => $params]);
        $result = json_decode($result->getBody());

        // Check google's response
        $result = $result->success == true;

        // Return the result
        return $result;
    }



    /**
      * Block access to the site with a given HTTP response code and message
      * ------------------------------------------------------------------------
      * @param integer $httpCode        HTTP response code to send
      * @param string  $httpMessage     Message to send with the response code
      */
    public static function blockAccess(int $httpCode = 403, string
        $httpMessage = 'Forbidden') : void
    {
        header("HTTP/1.0 $httpCode $httpMessage");
        die();
    }


}
