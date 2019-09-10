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

use \KWS\Registry\Registry;
use \KWS\Security\SecurityHelper;
use \KWS\Utils;


class Helper
{

    /**
     * A list of months of the year
     */
    const MONTHS = array('January','February','March','April','May','June',
        'July','August','September','October','November','December');



    /**
     * Holds the global configuration object
     *
     * @var \TCorp\Legacy\Config
     */
    protected static $config = null;



    /**
     * Holds the global firewall object
     *
     * @var \TCorp\Legacy\Firewall
     */
    protected static $firewall = null;



    /**
     * Holds the global debugger object
     *
     * @var \TCorp\Legacy\Debugger
     */
    protected static $debugger = null;



    /**
     * Holds the global session object
     *
     * @var \TCorp\Legacy\Session
     */
    protected static $session = null;


    /**
     * Holds the global form objects
     *
     * @var \TCorp\Legacy\Form
     */
    protected static $forms = [];



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
        $result = json_decode($result);

        // Add additional meta data
        foreach($result as $number) {
            $number->format1 = preg_replace('|^(\d{4})(\d{6})$|i', '$1 $2', $number->number);
            $number->format2 = preg_replace('|^(\d{4})(\d{3})(\d{3})$|i', '$1 $2 $3', $number->number);
            $number->format3 = preg_replace('|^(\d{4})(\d{2})(\d{2})(\d{2})$|i', '$1 $2 $3 $4', $number->number);
            $number->format4 = (!empty($number->word) ? $number->word : $number->format3);
        }

        // Return the result
        return $result;
    }



    /**
     * Proxy for the SecurityHelper::getReCaptchaHtml() method
     * -------------------------------------------------------------------------
     * @return  string  HTML for rendering a CSRF token inside a web form
     */
    public static function getReCaptchaHtml()
    {
        $config = static::getConfig();
        $sitekey = $config->get('recaptcha.sitekey');
        return SecurityHelper::getReCaptchaHtml($sitekey);
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
        $config = static::getConfig();
        $secret = $config->get('recaptcha.secret');

        if (!SecurityHelper::checkReCaptcha($secret)) {
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
    public static function redirect(string $url, bool $preserveParams = TRUE,
        int $statusCode = 301) : void
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
        $config = static::getConfig();

        // Look up the ABN details using ABR's API
        $url = "https://abr.business.gov.au/abrxmlsearch/" .
            "AbrXmlSearch.asmx/ABRSearchByABN";

        $data = self::sendRequest($url, 'GET', array(
            'searchString'             => $abn,
            'includeHistoricalDetails' => 'Y',
            'authenticationGuid'       => $config->get('abnlookup.guid')
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

    }


    /**
     * Get the HTTP method used to request the page
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getRequestMethod()
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
     * Get the global configuration object
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Config
     */
    public static function getConfig()
    {
        if (!static::$config) {
            static::$config = new Config();
        }

        return static::$config;
    }



    /**
     * Get the global firewall object
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Firewall
     */
    public static function getFirewall()
    {
        if (!static::$firewall) {
            static::$firewall = new Firewall();
        }

        return static::$firewall;
    }



    /**
     * Get the global debugger object
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Debugger
     */
    public static function getDebugger()
    {
        if (!static::$debugger) {
            static::$debugger = new Debugger();
        }

        return static::$debugger;
    }



    /**
     * Get the global session object
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Session
     */
    public static function getSession()
    {
        if (!static::$session) {
            static::$session = new Session();
        }

        return static::$session;
    }



    /**
     * Get a global form object
     * -------------------------------------------------------------------------
     * @return \TCorp\Legacy\Form
     */
    public static function getForm(string $name)
    {
        if (!isset(static::$forms[$name])) {
            $class = '\\TCorp\\Legacy\\Form\\' . ucfirst($name) . 'Form'
            static::$forms[$name] = new $class();
        }

        return static::$form[$name];
    }

}
