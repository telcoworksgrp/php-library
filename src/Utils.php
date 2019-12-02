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

}
