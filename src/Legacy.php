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
class Legacy
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
        return Utils::sendRequest($url, $method, $data, $headers);
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

        // Query the T3 Api
        $t3api = Application::getT3ApiClient();
        $t3api->setEndpoint("Activations");
        $t3api->setParam("query", $prefix);
        $t3api->setParam("numberTypes", "SERVICE_NUMBER");
        $t3api->setParam("serviceNumberTypes", $type);
        $t3api->setParam("minPriceDollars", $minPrice);
        $t3api->setParam("maxPriceDollars", $maxPrice);
        $t3api->setParam("pageNum", $pageNo);
        $t3api->setParam("pageSize", $pageSize);
        $t3api->setParam("sortBy", $sortBy);
        $t3api->setParam("sortDirection", $direction);
        $result = $t3api->execute();

        // Add additional meta data
        foreach($result as &$number) {
            $number->format1 = preg_replace('|^(\d{4})(\d{6})$|i', '$1 $2', $number->number);
            $number->format2 = preg_replace('|^(\d{4})(\d{3})(\d{3})$|i', '$1 $2 $3', $number->number);
            $number->format3 = preg_replace('|^(\d{4})(\d{2})(\d{2})(\d{2})$|i', '$1 $2 $3 $4', $number->number);
            $number->format4 = (!empty($number->word) ? $number->word : $number->format3);
        }

        // Return the final result
        return $result;
    }


    /**
     * Get all numbers available from the T3 Api
     * -------------------------------------------------------------------------
     * @return \stdClass[]
     */
    public static function getAllNumbers()
    {
        // Get the list of numbers
        $result = static::getNumbers('', 'FLASH', 0, 1000, 1, 1000);
        $result = array_merge($result, static::getNumbers('', 'LUCKY_DIP', 0, 1000, 1, 1000));

        // Return the result
        return $result;
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
        return Utils::sendEmail($to, $from, $subject, $message,
            $cc, $bcc, $headers);
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
     * Redirect the user's browser to another URL, preserving the current
     * URL parameters.
     * -------------------------------------------------------------------------
     * @param  string   $url             URL to redirect the user to
     * @param  bool     $preserveParams  Pass existing URL params to the redirect
     * @param  int      $code            HTTP status code (usually 301 or 303)
     *
     * @return  void
     */
    public static function redirect(string $url, bool $preserveParams = TRUE,
        int $code = 301) : void
    {
        $response = Application::getResponse();
        $response->redirect($url, $preserveParams, $code);
    }

    /**
     * Disable browser caching of this request
     * -------------------------------------------------------------------------
     * @return  void
     */
    public static function disableCache() : void
    {
        $response = Application::getResponse();
        $response->disableCache();
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

        // Look up the ABN details using ABR's API
        $url = "https://abr.business.gov.au/abrxmlsearch/" .
            "AbrXmlSearch.asmx/ABRSearchByABN";

        $data = self::sendRequest($url, 'GET', array(
            'searchString'             => $abn,
            'includeHistoricalDetails' => 'Y',
            'authenticationGuid'       => self::$abnLookupGuid
        ));


        // Parse the data returned by the API
        $data = new \SimpleXMLElement($data);
        $data = $data->response;

        $exception = (string) $data->exception;
        if (empty($exception)) {

            $result->statement               = (string) $data->usageStatement;
            $result->abn                     = (string) $data->businessEntity->ABN->identifierValue;
            $result->current                 = (string) $data->businessEntity->ABN->isCurrentIndicator;
            $result->asicNo                  = (string) $data->businessEntity->ASICNumber;
            $entityType                      = $data->businessEntity->entityType;
            $result->entityType              = new \stdClass;
            $result->entityType->code        = (string) $entityType->entityTypeCode;
            $result->entityType->desc        = (string) $entityType->entityDescription;
            $legalName                       = $data->businessEntity->legalName;
            $result->legalName               = new \stdClass;
            $result->legalName->firstname    = (string) $legalName->givenName;
            $result->legalName->othername    = (string) $legalName->otherGivenName;
            $result->legalName->lastname     = (string) $legalName->familyName;
            $mainName                        = $data->businessEntity->mainName;
            $result->mainName                = new \stdClass;
            $result->mainName->organisation  = (string) $mainName->organisationName;
            $result->mainName->effective     = (string) $mainName->effectiveFrom;
            $tradeName                       = $data->businessEntity->mainTradingName;
            $result->tradeName               = new \stdClass;
            $result->tradeName->organisation = (string) $tradeName->organisationName;
            $result->tradeName->effective    = (string) $tradeName->effectiveFrom;

        } else {

            $result->statement               = '';
            $result->abn                     = '';
            $result->current                 = '';
            $result->asicNo                  = '';
            $result->entityType              = new \stdClass;
            $result->entityType->code        = '';
            $result->entityType->desc        = '';
            $result->legalName               = new \stdClass;
            $result->legalName->firstname    = '';
            $result->legalName->othername    = '';
            $result->legalName->lastname     = '';
            $result->mainName                = new \stdClass;
            $result->mainName->organisation  = '';
            $result->mainName->effective     = '';
            $result->tradeName               = new \stdClass;
            $result->tradeName->organisation = '';
            $result->tradeName->effective    = '';

        }


        // Return the result
        return $result;
    }



    /**
     *  Block the user if thier IP belongs to a banned country. static::
     *  WORST_SPAM_COUNTRIES is a predefined list of the worst spam/bot
     *  countries according to Spamhaus. To avoid blocking Googlebot, the US is
     *  exluded from this predefined list.
     *  ------------------------------------------------------------------------
     *  @return void
     */
    public static function blockBannedCountries() : void
    {
        if (static::checkIpLocation(static::WORST_SPAM_COUNTRIES)) {

            Application::getFirewall()->block('Your Country Has been Banned from thi Site');
        }
    }


    /**
     * Check the hidden honeypot form field. If it is missing or invalid then
     * the user will be blocked
     * -------------------------------------------------------------------------
     * @return  void
     */
    public static function blockIfInvalidHoneypot() : void
    {
        if (!static::checkHoneypot()) {
            Application::getFirewall()->block('Invalid Honeypot');
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
        if (!static::checkCSRFToken()) {
            Application::getFirewall()->block('Invalid CSRF');
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
        if (!static::checkReCaptcha(self::$recaptchaSecret)) {
            self::redirect($redirectUrl, false, 303);
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
        return Application::getInput()->request('affiliate', '');
    }


    /**
     * Start the user's session if not already started
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function startSession()
    {
        Application::getSession()->start();
    }

    /**
     * Set a value in the user's session
     * -------------------------------------------------------------------------
     * @param string    $key    A key name for referancing the stored value
     * @param mixed     $value  The value to store
     */
    public static function setSessionVar(string $key, $value)
    {
        // Set a session variable with the given value
        Application::getSession()->set($key, $value);
    }


    /**
     * Get a value previously stored in the user's session. If a value with
     * the given key can not be found then a default can be returned
     * -------------------------------------------------------------------------
     * @param  string $key      A key name for referancing the stored value
     * @param  mixed  $default  A default value if the key doesn't exist
     *
     * @return mixed    A value for the given key, or the default value
     */
    public static function getSessionVar(string $key, $default = null)
    {
        return Application::getSession()->get($key, $default);
    }


    /**
     * Unsets/removes an existing session variable
     * -------------------------------------------------------------------------
     * @param string    $key    A key name for referancing the stored value
     *
     * @return  void
     */
    public static function unsetSessionVar(string $key)
    {
        Application::getSession()->delete($key);
    }


    /**
     * Store the value of a request variable in a session var. If the request
     * var doesn't exist then preserve the existing session var. If a session
     * var with the given key doesn't exist then set a session var with the
     * given key to a given default value.
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
        // Initialise some local variables
        $session = Application::getSession();
        $input   = Application::getInput();

        // If a value can be found in the request then set/update
        // the session to that value
        if ($input->request($var, false)) {
            $session->set($key, $input->request($var));
        }

        // Get the value from the current session. If none exists
        // then use the default given
        $result = $session->get($key, $default);

        // Return the final result
        return $result;
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
    public static function checkIpLocation(array $countryCodes) : bool
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
     * @return string   HTML/Javascript needed to render reCAPTCHA 3
     */
    public static function getReCaptchaHtml()
    {
        $sitekey = static::$recaptchaSiteKey
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


}
