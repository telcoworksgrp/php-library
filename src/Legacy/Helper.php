<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Legacy;

use \KWS\Security\SecurityHelper;
use \KWS\Registry\Registry;
use \KWS\Utils;
use \TCorp\T3\Client AS T3Client;


class Helper
{

    /**
     * A list of months of the year
     */
    const MONTHS = array('January','February','March','April','May','June',
        'July','August','September','October','November','December');



    /**
     * Name of the this web site
     *
     * @var string
     */
    public static $siteName = '';


    /**
     * API key to use when calling the IpGeolocation API
     *
     * @var string
     *
     * @see https://ipgeolocation.io/
     */
    public static $ipGeolocationApiKey = '';



    /**
    * A Google ReCaptcha site key
    *
    * @var string
    *
    * @see https://www.google.com/recaptcha/intro/v3.html
    */
    public static $recaptchaSiteKey = '';



    /**
    * A Google ReCaptcha secret key to compliment the site key
    *
    * @var string
    *
    * @see https://www.google.com/recaptcha/intro/v3.html
    */
    public static $recaptchaSecret = '';



    /**
    * API key to use when calling the ABN lookup API
    *
    * @var string
    *
    * @see https://abr.business.gov.au/Tools/WebServices
    */
    public static $abnLookupGuid = '';




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
        // Compose a HTTP request using Guzzle HTTP
        $request = new \GuzzleHttp\Psr7\Request($method, $url, $headers);

        // Execute the http request with Guzzle HTTP
        $client  = new \GuzzleHttp\Client();
        $result = $client->send($request, array('query' => $data));

        // Return the result body
        return $result->getBody();
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
     * @param  string   $sortBy     Column to sort the results by
     * @param  string   $direction  Direction to sort the results by
     *
     * @return  object[]    A list of numbers with meta data
     */
    public static function getNumbers($prefix = '1300', $type = 'FLASH',
        $minPrice = 0, $maxPrice = 1000, $pageNo = 1, $pageSize = 500,
        $sortBy = 'PRICE', $direction = 'ASCENDING')
    {
        $client = new T3Client();

        return $client->getNumbers($prefix, $type, $minPrice, $maxPrice,
            $pageNo, $pageSize, $sortBy, $direction);
    }



    /**
     * Proxy for the SecurityHelper::getReCaptchaHtml() method
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a CSRF token inside a web form
     */
    public static function getReCaptchaHtml()
    {
        return SecurityHelper::getReCaptchaHtml(static::$recaptchaSiteKey);
    }


    /**
     * Proxy for the SecurityHelper::getHoneypotHtml() method
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a hidden honeypot text field
     */
    public static function getHoneypotHtml()
    {
        return SecurityHelper::getHoneypotHtml();
    }


    /**
     * Proxy for the SecurityHelper::getCSRFTokenHtml() method
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a CSRF token inside a web form
     */
    public static function getCSRFTokenHtml()
    {
        return SecurityHelper::getCSRFTokenHtml();
    }


    /**
     * Check the hidden honeypot form field. If it is missing or invalid then
     * the user will be blocked
     * -------------------------------------------------------------------------
     * @return  void
     */
    public static function blockIfInvalidHoneypot() : void
    {
        if (!SecurityHelper::checkHoneypot()) {
            SecurityHelper::blockAccess();
        }
    }


    /**
     * Check the CSRF token. If it is missing or doesn't match the one stored
     * in the user's session then the user will be blocked
     * -------------------------------------------------------------------------
     * @return  void
     */
    public static function blockIfInvalidCSRFToken() : void
    {
        if (!SecurityHelper::checkCSRFToken()) {
            SecurityHelper::blockAccess();
        }
    }


    /**
     * Check if the form ReCaptcha was successfully completed. If not, then
     * the user will be redirected
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function redirectIfInvalidReCaptcha(string $redirectUrl) : void
    {
        if (!SecurityHelper::checkReCaptcha(static::$recaptchaSecret)) {
            static::redirect($redirectUrl, false, 303);
        }
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
    public static function redirect(string $url = '', bool $preserveParams
        = TRUE, int $statusCode = 301) : void
    {
        Utils::redirect($url, $preserveParams, $statusCode);
    }


    /**
     * Get the value of a submitted form field
     * -------------------------------------------------------------------------
     * @param  string   $name     Name of the form field
     * @param  mixed    $default  Default value if no value is found
     *
     * @return mixed
     */
    public static function getFormField(string $name, $default = null)
    {
        return htmlspecialchars($_POST[$name] ?? $default);
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
        string $message, string $cc = '', string $bcc = '', $headers = array())
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
        $headers['X-WebForm-Host']       = static::getDomainName();
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
     * Get the IP address from which the user is viewing the current page.
     * -------------------------------------------------------------------------
     * @return string
     */
    public static function getRemoteIpAddress() : string
    {
        return $_SERVER['REMOTE_ADDR'];
    }


    /**
     * Get the contents of the User-Agent: header from the current request
     * -------------------------------------------------------------------------
     * @return string
     */
    public static function getRemoteUserAgent() : string
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }


    /**
     * Get the current date and time in RFC 2822 format
     * -------------------------------------------------------------------------
     * @return string
     */
    public static function getDateTime() : string
    {
        return date('r');
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
        return $_COOKIE['affiliate'] ?? '';
    }


    /**
     * Get the current domain name
     * -------------------------------------------------------------------------
     * @return  string  A domain name
     */
    public static function getDomainName()
    {
        return $_SERVER['HTTP_HOST'];
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


    /**
     * Disable browser caching of this request
     * -------------------------------------------------------------------------
     * @return  void
     */
    public static function disableCache() : void
    {
        \KWS\Utils::disableCache();
    }



    /**
     * Look up the details for a given ABN using an API
     * -------------------------------------------------------------------------
     * @param  string   $abn    The ABN to lookup
     *
     * @return object   ABN details, or False if ABN not found
     */
    public static function getABNDetails(string $abn)
    {
        // Initialise some local variables
        $result = new \stdClass();
        $config = Factory::getConfig();

        // Look up the ABN details using ABR's API
        $url = "https://abr.business.gov.au/abrxmlsearch/" .
            "AbrXmlSearch.asmx/ABRSearchByABN";

        $data = self::sendRequest($url, 'GET', array(
            'searchString'             => $abn,
            'includeHistoricalDetails' => 'Y',
            'authenticationGuid'       => static::$abnLookupGuid
        ));

        // Parse the data returned by the API
        $data = new \SimpleXMLElement($data);
        $data = $data->response;

        $result->statement = (string) $data->usageStatement;
        $result->abn       = (string) $data->businessEntity->ABN->identifierValue;
        $result->current   = (string) $data->businessEntity->ABN->isCurrentIndicator;
        $result->asicNo    = (string) $data->businessEntity->ASICNumber;

        $entityType               = $data->businessEntity->entityType;
        $result->entityType       = new \stdClass;
        $result->entityType->code = (string) $entityType->entityTypeCode;
        $result->entityType->desc = (string) $entityType->entityDescription;

        $legalName                    = $data->businessEntity->legalName;
        $result->legalName            = new \stdClass;
        $result->legalName->firstname = (string) $legalName->givenName;
        $result->legalName->othername = (string) $legalName->otherGivenName;
        $result->legalName->lastname  = (string) $legalName->familyName;

        $mainName                       = $data->businessEntity->mainName;
        $result->mainName               = new \stdClass;
        $result->mainName->organisation = (string) $mainName->organisationName;
        $result->mainName->effective    = (string) $mainName->effectiveFrom;

        $tradeName                       = $data->businessEntity->mainTradingName;
        $result->tradeName               = new \stdClass;
        $result->tradeName->organisation = (string) $tradeName->organisationName;
        $result->tradeName->effective    = (string) $tradeName->effectiveFrom;

        // Return the result
        return $result;
    }


    /**
     * Get the current state of a given form field from the request/session.
     * -------------------------------------------------------------------------
     * @param  string   $key        Session key where the value is stored
     * @param  string   $name       The form field's name
     * @param  string   $default    Value to return if no value is found
     * @param  string   $filter     Filter to sanitise the value with
     *
     * @return mixed
     */
    public static function getFormFieldState(string $key, string $name,
        $default = '', string $filter = '')
    {
        // Initialise some local variables
        $session = Factory::getSession();

        // Try to get a value from the request
        $result = $_REQUEST[$name] ?? false;

        // If we found a value in the request sanitise
        // the value, update the current session. Otherwise
        // try to get a value from the session.
        if ($result !== false) {
            $result = htmlentities($result);
            $session->set($key, $result);
        } else {
            $result = $session->get($key, $default);
        }

        // Return the result
        return $result;
    }


    /**
     * Get the HTTP method used to request the page
     * -------------------------------------------------------------------------
     * @return string
     */
    public static function getRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }


    /**
     * Check if the current request is a form submission
     * -------------------------------------------------------------------------
     * @return bool
     */
    public static function isFormSubmission()
    {
        return static::getRequestMethod() == 'POST';
    }


    /**
     * Convert HTML to PDF document
     * -------------------------------------------------------------------------
     * @param  string   $html           The HTML to convert
     * @param  string   $size           Paper size (eg: A4,A3,A5,etc)
     * @param  string   $orientation    Page orientation (portrait/landscape)
     *
     * @return mixed    A raw PDF file
     */
    public static function convertHtmlToPDF(string $html, string $size = 'A4',
        $orientation = 'portrait')
    {
        return Utils::convertHtmlToPDF($html, $size, $orientation);
    }


    /**
     * Render a template with the given data and return the output as a string
     * -------------------------------------------------------------------------
     * @param  string   $filename   Filename of of script to render
     * @param  mixed    $data       Data passed to the template
     *
     * @return string
     */
    public static function renderTemplate(string $filename, $data)
    {
        ob_start();
        require($filename);
        return ob_get_clean();
    }


    /**
     * Clear all data from the current session
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function clearAllSessionData()
    {
        $_SESSION = [];
    }


    /**
     * Enable PHP error reporting
     * -------------------------------------------------------------------------
     * @param   bool    $enable True for full error reporting, False for none
     *
     * @return void
     */
    public static function enableErrorReporting(bool $enable = true) : void
    {
        if ($enable) {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        } else {
            error_reporting(E_NONE);
            ini_set('display_errors', 0);
        }
    }


    /**
     *  Block the user if thier IP belongs to a banned country. SecurityHelper::
     *  WORST_SPAM_COUNTRIES is a predefined list of the worst spam/bot
     *  countries according to Spamhaus. To avoid blocking Googlebot, the US is
     *  exluded from this predefined list.
     *  ------------------------------------------------------------------------
     *  @return void
     */
    public static function blockBannedCountries() : void
    {
        if (SecurityHelper::checkIpLocation(SecurityHelper::
            WORST_SPAM_COUNTRIES, static::$ipGeolocationApiKey)) {

            SecurityHelper::blockAccess();
        }
    }


    /**
     * Start a new session or resume and existing one
     * -------------------------------------------------------------------------
     * @return mixed
     */
    public static function startSession()
    {
        if (!isset($_SESSION)) {
            session_start();
        }

        if (!isset($_SESSION['registry'])) {
            $_SESSION['registry'] = new Registry();
        }

    }


    /**
     * Get a session value
     * -------------------------------------------------------------------------
     * @param  string   $key      Key/name of the session value to get
     * @param  mixed    $default  Value to return if no value is found
     *
     * @return mixed
     */
    public static function getSessionValue(string $key, $default = null)
    {
        return $_SESSION['registry']->get($key, $default);
    }



    /**
     * Set a session value
     * -------------------------------------------------------------------------
     * @param string    $key       Key/name of the session value to set
     * @param mixed     $value     Value to set the session value to
     *
     * @return void
     */
    public static function setSessionValue(string $key, $value)
    {
        $_SESSION['registry']->set($key, $value);
    }



    /**
     * Store the value of a request variable in a session var. If the request
     * var doesn't exist then preserve the existing session var. If a session
     * var with the given key doesn't exist then set a session var with the
     * given key to a given default value.
     * -------------------------------------------------------------------------
     * @param string    $key        A key name for referancing the stored value
     * @param string    $var        A GET/POST variable name
     * @param string    $default    Default value if none can be found
     *
     * @return  mixed   The final value of session var
     */
    public static function setSessionValueFromRequest(string $key, string $var,
        $default = '')
    {
        if (isset($_REQUEST[$var])) {
            $this->set($key, $_REQUEST[$var]);
        } else {
            if (!isset($_SESSION[$key])) {
                $this->set($key, $default);
            }
        }

        // Return the result
        return $this->get($key);
    }

}
