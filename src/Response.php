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
 * Class for managing the response sent to the user
 */
class Response
{

    /**
     * Disable browser caching of this request
     * -------------------------------------------------------------------------
     * @return void
     */
    public function disableCache() : void
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


}
