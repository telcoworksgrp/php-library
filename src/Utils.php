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


use \Dompdf\Dompdf;
use \ScssPhp\ScssPhp\Compiler AS SCSSCompiler;



/**
 * Class for miscellanious/currently not organised utilities
 */
class Utils
{

    /**
     * Disable browser caching of this request
     * -------------------------------------------------------------------------
     * @return void
     */
    public static function disableCache() : void
    {
        header("Cache-Control: max-age=0, no-cache, no-store, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
    }



    /**
     * Redirect the user's browser to another URL, optionally preserving the
     * current URL parameters. If no url is given, the cuurent url will be
     * used.This can be useful for returning to form submission pages but be
     * careful not to create infinate redirects
     * -------------------------------------------------------------------------
     * @param string  $url              URL to redirect the user to
     * @param bool    $preserveParams   Pass existing URL params to the redirect
     * @param int     $statusCode        HTTP status code (usually 301 or 303)
     *
     * @return  void
     */
    public static function redirect(string $url = '', bool $preserveParams =
        false, int $statusCode = 301) : void
    {
        // If no url is given, use the cuurent url. This can be useful for
        // returning to form submission page
        $url = (empty($url)) ? $_SERVER['REQUEST_URI'] : $url;

        // Append the exitsing params if needed
        if (($preserveParams) && (!empty($_SERVER['QUERY_STRING']))) {
            $url = $url . ((strpos($url, '?')) ? '&' : '?') . $_SERVER['QUERY_STRING'];
        }

        // Redirect the user
        header('Location: ' . $url, true, $statusCode);
        exit();

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
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper($size, $orientation);
        $dompdf->render();
        return $dompdf->output();
    }


   /**
    * Compile SCSS code to CSS
    * -------------------------------------------------------------------------
    * @param  string   $inputFile    File containing SCSS code
    * @param  string   $outputFile   File to output the CSS to
    *
    * @return void
    */
   public static function compileSCSS(string $inputFile, string $outputFile) : void
   {
       // Load the SCSS code from file
       $scss = file_get_contents($inputFile);

       // Compile the SCSS to CSS
       $compiler = new SCSSCompiler();
       $compiler->setFormatter('ScssPhp\ScssPhp\Formatter\Compact');
       $compiler->addImportPath(dirname($inputFile));
       $css = $compiler->compile($scss);

       // save the generated CSS to file
       file_put_contents($outputFile, $css);
   }


    /**
     * Check if the given value contains HTML
     * -------------------------------------------------------------------------
     * @param  string $value    Content to be checked
     *
     * @return bool
     */
    public static function containsHTML(string $value)
    {
        return $value != strip_tags($value);
    }


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
     * Check if the current user agent is  googlebot
     *-------------------------------------------------------------------------
     * @return bool
     */
    public static function isGooglebot() : bool
    {
        return (bool) preg_match("/Google(bot)?/", $_SERVER['HTTP_USER_AGENT']);
    }


    /**
     * Check if a given EROU holder name is telecom corp
     * -------------------------------------------------------------------------
     * @param  string   $holder   An erou holder name
     *
     * @return bool
     */
    public static function erouHolderIsTelecomCorp(string $holder)
    {
        return in_array(strtoupper($holder), [
            'FYI TELCO',
            'FYI TELCO PTY LTD',
            'TELECOM CORPORATE PTY LTD'
        ]);
    }

}
