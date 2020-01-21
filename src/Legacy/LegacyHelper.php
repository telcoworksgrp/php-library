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
 * Legacy helper class for working with Telecom Corp's Legacy sites/projects
 */
class LegacyHelper
{

    /**
     * A list of months of the year
     */
    const MONTHS = array('January','February','March','April','May','June',
        'July','August','September','October','November','December');


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
     * An API key issued by IP Geolocation
     *
     * @var string
     */
    public static $ipGeolocationApiKey = '';


    /**
     * A ReCaptcha v2 site key issued by Google
     *
     * @var string
     */
    public static $recaptchaSiteKey = '';


    /**
     * A ReCaptcha v2 secret issued by Google
     *
     * @var string
     */
    public static $recaptchaSecret = '';

    /**
     * GUID used for looking up ABN Details
     *
     * @var string
     */
    public static $abnLookupGuid = '';



    /**
     * Proxy for the Utils::sendRequest() method
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
        return Utils::sendRequest($url, $method, $data, $headers);
    }


    /**
     * Proxy for the T3Api::getNumbers() method.
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
        return T3Api::getNumbers($prefix, $type, $minPrice, $maxPrice,
            $pageNo, $pageSize, $sortBy, $direction);
    }


    /**
     * Send an email
     * -------------------------------------------------------------------------
     * @param  string   $to           Receiver, or receivers of the mail.
     * @param  string   $from         A From address
     * @param  string   $subject      Subject of the email to be sent.
     * @param  string   $message      Message to be sent.
     * @param  string   $cc           A CC address
     * @param  string   $bcc          A BCC address
     * @param  mixed    $headers      String/array of additional headers to add
     *
     * @return bool                 TRUE if successfully sent, FALSE otherwise
     */
    public static function sendEmail(string $to, string $from, string $subject,
        string $message, string $cc = '', string $bcc = '', $headers = [])
    {
        // Add some mime headers if the message contains HTML
        if ($message != strip_tags($message)) {
            $headers['MIME-Version']      = "1.0";
            $headers['Content-type']      = "text/html; charset=iso-8859-1";
        }

        // Add a From header
        if (!empty($from)) {
            $headers['From'] = $from;
        }

        // Add a CC header
        if (!empty($from)) {
            $headers['Cc'] = $from;
        }

        // Add a BCC header
        if (!empty($bcc)) {
            $headers['Bcc'] = $bcc;
        }

        // Add some additional metadata to headers
        $headers['X-WebForm-ServerIP']   = $_SERVER['SERVER_ADDR'];
        $headers['X-WebForm-ServerName'] = $_SERVER['SERVER_NAME'];
        $headers['X-WebForm-Host']       = static::getCurrentDomainName();
        $headers['X-WebForm-Referrer']   = $_SERVER['HTTP_REFERER'];
        $headers['X-WebForm-UserAgent']  = static::getRemoteUserAgent();
        $headers['X-WebForm-RemoteIP']   = static::getRemoteIPAddress();
        $headers['X-WebForm-URI']        = $_SERVER['REQUEST_URI'];
        $headers['X-WebForm-Script']     = $_SERVER['SCRIPT_NAME'];

        // Send the email
        $result = mail($to, $subject, $message, $headers);

        // Return the result
        return $result;
    }


    /**
     * Composes an email message from all POST params - plus the IP address
     * of the remote user. This is a quick and dirty way some of the older
     * sites display form data in email notifications
     * -------------------------------------------------------------------------
     * @return  string  An email message
     */
    public static function composeMessageFromPostParams() : string
    {
        // Initialise some local variables
        $params       = $_POST;
        $params['ip'] = static::getRemoteIPAddress();
        $result       = '';

        // Add a list of key-value pairs
        foreach ($params as $key => $value) {
            $k = htmlentities($key);
        	$v = htmlentities($value);
            $result .= "$k - $v\n";
        }

        // Return the result
        return $result;
    }


    /**
     * Proxy method for Form::renderPostParamsAsHiddenFields();
     * -------------------------------------------------------------------------
     * @return string   Rendered HTML
     */
    public static function renderPostParamsAsHiddenFields()
    {
        return Form::renderPostParamsAsHiddenFields();
    }


    /**
     * Redirect the user's browser to another URL, preserving the current
     * URL parameters.
     * -------------------------------------------------------------------------
     * @param  string   $url             URL to redirect the user to
     * @param  bool     $preserveParams  Pass existing URL params to the redirect
     * @param  int      $statusCode      HTTP status code (usually 301 or 303)
     *
     * @return  void
     */
    public static function redirect(string $url, bool $preserveParams = TRUE,
        int $statusCode = 301) : void
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
     * @return  void
     */
    public static function disableCache() : void
    {
        header("Cache-Control: max-age=0, no-cache, no-store, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
    }


    /**
     * Proxy for the AbnApi::getABNDetails() method;
     * -------------------------------------------------------------------------
     * @param  string   $abn    The ABN to lookup
     *
     * @return object   ABN details, or False if ABN not found
     */
    public static function getABNDetails(string $abn)
    {
        return AbnApi::getABNDetails($abn, static::$abnLookupGuid);
    }



    /**
     *  Block the user if thier IP belongs to a banned country. sttaic::
     *  WORST_SPAM_COUNTRIES is a predefined list of the worst spam/bot
     *  countries according to Spamhaus. To avoid blocking Googlebot, the
     *  US is exluded from this predefined list.
     *  ------------------------------------------------------------------------
     *  @return void
     */
    public static function blockBannedCountries() : void
    {
        if (static::checkIpLocation(static::WORST_SPAM_COUNTRIES,
            static::$ipGeolocationApiKey)) {

            Firewall::block();
        }
    }


    /**
     * Proxy for the Form::getHoneypotHtml() method
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a hidden honeypot text field
     */
    public static function getHoneypotHtml() : string
    {
        return Form::getHoneypotHtml();
    }


    /**
     * Proxy for the Form::checkHoneypot() method
     * -------------------------------------------------------------------------
     * @return  bool    TRUE = honeypot is valid, FALSE = honeypot is NOT valid
     */
    public static function checkHoneypot() : bool
    {
        return Form::checkHoneypot();
    }


    /**
     * Check the hidden honeypot form field. If it is missing or invalid then
     * the user will be blocked
     * -------------------------------------------------------------------------
     * @return  void
     */
    public static function blockIfInvalidHoneypot() : void
    {
        if (!Form::checkHoneypot()) {
            Firewall::block();
        }
    }


    /**
     * Proxy for the Form::getCSRFToken() method
     * -------------------------------------------------------------------------
     * @return string   A CSRF token
     */
    public static function getCSRFToken()
    {
        return Form::getCSRFToken();
    }



    /**
     * Proxy for the Form::getCSRFTokenHTML() method
     * -------------------------------------------------------------------------
     * @return string   HTML for rendering a CSRF token inside a web form
     */
    public static function getCSRFTokenHTML() : string
    {
        return Form::getCSRFTokenHTML();
    }


    /**
     * Proxy for the Form::checkCSRFToken() method
     * -------------------------------------------------------------------------
     * @return  bool    TRUE = Token is valid; FALSE = Toekn is NOT valid.
     */
    public static function checkCSRFToken() : bool
    {
        return Form::checkCSRFToken();
    }


    /**
     * Check the CSRF token. If it is missing or doesn't match the one stored
     * in the user's session then the user will be blocked
     * -------------------------------------------------------------------------
     * @return  void
     */
    public static function blockIfInvalidCSRFToken() : void
    {
        if (!Form::checkCSRFToken()) {
            Firewall::block();
        }
    }


    /**
     * Proxy for the Form::getReCaptchaHtml() method
     * -------------------------------------------------------------------------
     * @param  string   $key        reCAPTCHA Site Key (issued by Google)
     *
     * @return string   HTML/Javascript needed to render reCAPTCHA 3
     */
    public static function getReCaptchaHtml(string $siteKey)
    {
        return Form::getReCaptchaHtml($siteKey);
    }


    /**
     * Proxy for the Form::checkReCaptcha() method
     * -------------------------------------------------------------------------
     * @param  string   $secretKey    reCAPTCHA Secret Key (issued by Google)
     *
     * @return  bool
     */
    public static function checkReCaptcha(string $secretKey)
    {
        return Form::checkReCaptcha($secretKey);
    }


    /**
     * Check if the form ReCaptcha was successfully completed. If not, then
     * the user will be redirected
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function redirectIfInvalidReCaptcha(string $redirectUrl) : void
    {
        if (!Form::checkReCaptcha(static::$recaptchaSecret)) {
            static::redirect($redirectUrl, false, 303);
        }
    }


    /**
     * Get the one-time affilate referral id that is set when an affiliate
     * reffers a cutsomer to this website to make an application. This referral
     * id should not be confused with an "affiliate id" which identifies the
     * affilate not the referral.
     * -------------------------------------------------------------------------
     * @return  string  The one-time affilate refferal id.
     */
    public static function getAffiliateReferralId()
    {
        return $_REQUEST['affiliate'] ?? '';
    }


    /**
     * Proxy for the Session::start() method
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function startSession()
    {
        Session::start();
    }


    /**
     * Proxu for the Session::set(); method
     * -------------------------------------------------------------------------
     * @param string    $key    A key name for referancing the stored value
     * @param mixed     $value  The value to store
     */
    public static function setSessionVar(string $key, $value)
    {
        Session::set($key, $value);
    }


    /**
     * Proxy for the Session::get(); method
     * -------------------------------------------------------------------------
     * @param  string $key      A key name for referancing the stored value
     * @param  mixed  $default  A default value if the key doesn't exist
     *
     * @return mixed    A value for the given key, or the default value
     */
    public static function getSessionVar(string $key, $default = null)
    {
        return Session::get($key, $default);
    }


    /**
     * Proxy for the Session::unset() method
     * -------------------------------------------------------------------------
     * @param string    $key    A key name for referancing the stored value
     *
     * @return  mixed   The former value of the session var
     */
    public static function unsetSessionVar(string $key)
    {
        return Session::unset($key);
    }


    /**
     * Proxy for the Session::setFromRequest() method
     * -------------------------------------------------------------------------
     * @param string    $key        A key name for referancing the stored value
     * @param string    $var        A GET/POST variable name
     * @param string    $default    Default value if both request and session
     *                              var doesn't exist
     * @param string    $filter     Filter Type (for sanitisation)
     *
     * @return  mixed   The final value of session var
     */
    public static function setSessionVarFromRequest(string $key, string $var,
        $default = '', string $filter = 'STRING')
    {
        return Session::setFromRequest($key, $var, $default, $filter);
    }


    /**
     * Get the user's/remote IP address
     * -------------------------------------------------------------------------
     * @return  string  An IP address
     */
    public static function getRemoteIPAddress()
    {
        return $_SERVER['REMOTE_ADDR'];
    }


    /**
     * Get the user's/remote User Agent
     * -------------------------------------------------------------------------
     * @return  string  An IP address
     */
    public static function getRemoteUserAgent()
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }


    /**
     * Get the current domain name
     * -------------------------------------------------------------------------
     * @return  string  A domain name
     */
    public static function getCurrentDomainName()
    {
        return $_SERVER['HTTP_HOST'];
    }


    /**
     * Get the sanitised value of the given POST variable
     * -------------------------------------------------------------------------
     * @param  string  $name       Name of the post variable
     * @param  mixed   $default    Default value if no value is found
     *
     * @return mixed    Value of the given POST variable, or the default value
     */
    public static function getPostValue(string $name, $default = '')
    {
        return (isset($_POST[$name])) ?
            htmlspecialchars($_POST[$name]) : $default;
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

}
