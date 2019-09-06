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



/**
 * Class for working with the current request
 */
class Request
{

    /**
     * Get the request method was used to access the page; e.g. 'GET',
     * 'HEAD', 'POST', 'PUT', etc
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getMethod() : string
    {
        return $_SERVER['REQUEST_METHOD'];
    }


    /**
     * Get The IP address of the server under which the current script
     * is executing
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getServerIp() : string
    {
        return $_SERVER['SERVER_ADDR'];
    }


    /**
     * Get the TCP port on which the server is hosting this request
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getServerPort() : int
    {
        return $_SERVER['SERVER_PORT'];
    }


    /**
     * Get the IP address from which the user is viewing the current page.
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getRemoteIp() : string
    {
        return $_SERVER['REMOTE_ADDR'];
    }


    /**
     * Get the TCP port on which the user is viewing the current page.
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getRemotePort() : int
    {
        return $_SERVER['REMOTE_PORT'];
    }


    /**
     * Get the contents of the User-Agent: header from the current request
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getUserAgent() : string
    {
        return $_SERVER['HTTP_USER_AGENT'];
    }


    /**
     * Get the address of the page (if any) which referred the user agent
     * to the current page
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getRefererUrl() : string
    {
        return $_SERVER['HTTP_REFERER'];
    }


    /**
     * Determins if the HTTPS protocol was used for the current request
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function isHttps() : bool
    {
        return !empty($_SERVER['HTTPS']);
    }


    /**
     * The URI which was given in order to access this page;
     * for instance, '/index.html'.
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getUri() : string
    {
        return $_SERVER['REQUEST_URI'];
    }


    /**
     * Get the query string, if any, via which the page was accessed.
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getQueryStr() : string
    {
        return $_SERVER['QUERY_STRING'];
    }

}
