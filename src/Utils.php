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
        // Send the HTTP request
        $client  = new \GuzzleHttp\Client();

        $result = $client->request($method, $url,
            ['query'=> $data, 'headers' => $headers]);

        // Get the response
        $result = $result->getBody();

        // Return the final result
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
     * Convert an array to a string.
     * -------------------------------------------------------------------------
     * @param   array  $array          The array to convert.
     * @param   string $innerGlue      The glue between the key and the value.
     * @param   string $outerGlue      The glue between array elements.
     * @param   bool   $quoteChar      Charictar to surround the value with.
     * @param   bool   $finalGlue      Add the outerGlue to the last item
     *
     * @return  string
     */
     public static function arrayToString(array $array, string $innerGlue = '=',
         string $outerGlue = ' ', string $quoteChar = '"', bool $finalGlue = true)
    {
        $output = array();

        foreach ($array as $key => $item) {

            if (\is_array($item)) {

                $output[] = static::toString($item, $innerGlue,
                    $outerGlue, $quoteChar, $finalGlue);

            } else {

                $output[] = $key . $innerGlue . $quoteChar . $item . $quoteChar;

            }
        }

        $result  = implode($outerGlue, $output);
        $result .= ($finalGlue) ? $outerGlue  : '';

        return $result;
    }


    /**
     * Convert an associtive array into a CSS rule. Keys are treated as CSS
     * property names and values are treated as values for the corrasponding
     * property.
     * ------------------------------------------------------------------------
     * @param  string  $selector       A CSS selector for the CSS rule
     * @param  array   $properties     A list of CSS property => value pairs
     *
     * @return string  A CSS rule
     */
     public static function arrayToCSSRule(string $selector, array $properties) : string
     {
        $result = $selector . ' { ';
        $result .= static::arrayToString($properties, ': ', '; ', '');
        $result .= '}';

        // Return the result
        return $result;
    }



}
