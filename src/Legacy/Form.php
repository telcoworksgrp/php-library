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
 * Legacy helper class for working with HTML Forms
 */
class Form
{


    /**
     * Gets HTML for rendering a CSRF token inside a web form
     * -------------------------------------------------------------------------
     * @return string   HTML for rendering a CSRF token inside a web form
     */
    public static function getCSRFTokenHTML() : string
    {
        // Get a CSRF token
        $token = static::getCSRFToken();

        // Compose a HTML input form field
        $result = "<input type=\"hidden\" name=\"CSRF\" value=\"$token\">";

        // Return the result
        return $result;
    }


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
     * @param  string   $secretKey    reCAPTCHA Secret Key (issued by Google)
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
     * Render a hidden input field for each POST variable. Not a good
     * practice but needed to avoid breaking some of Telecom Corp's
     * legacy websites
     * -------------------------------------------------------------------------
     * @return string   Rendered HTML
     */
    public static function renderPostParamsAsHiddenFields()
    {
        // Initialise some local variables
        $result = '';

        // Render a hidden input field for each POST variable
        foreach ($_POST as $key => $value) {
            $key     = htmlentities($key);
            $value   = htmlentities($value);
            $result .= "<input type=hidden name=$key value=\"$value\">\n";
        }

        // Return the result
        return $result;
    }

}
