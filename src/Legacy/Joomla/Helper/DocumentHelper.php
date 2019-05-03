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

namespace TCorp\Legacy\Joomla\Helper;


use \Joomla\CMS\Factory;


/**
 * Helper class containing miscellanious methods for working with
 * Joomla documents
 */
class DocumentHelper
{


    /**
     * Proxy for adding an external script to the document, except a
     * little easier/cleaner when SRI or defer is needed.
     * -------------------------------------------------------------------------
     * @param string    $url           URL to the eternal javascript
     * @param string    $integrity     An SRI hash\
     * @param bool      $defer         Add a 'defer' attribute
     *
     * @return  void
     */
    public static function addScript(string $url, string $integrity = '',
    bool $defer = false)
    {
        // Initialise some local variables
        $options    = array();
        $attributes = array();

        // Add SRI hash if provoided
        if (!empty($integrity)) {
            $attributes['integrity']   = $integrity;
            $attributes['crossorigin'] = 'anonymous';
        }

        // Add the defer attribute
        if ($defer) {
            $attributes['defer'] = 'defer';
        }

        // Add the script to the document
        Factory::getDocument()->addScript($url, $options, $attributes);
    }



    /**
     * Proxy for adding an external stylesheets to the document, except a
     * little easier/cleaner when SRI hashes need to be added.
     * -------------------------------------------------------------------------
     * @param string    $url           URL to the eternal stylesheet
     * @param string    $integrity     An SRI hash
     *
     * @return  void
     */
    public static function addStylesheet(string $url, string $integrity = '')
    {
        // Initialise some local variables
        $options    = array();
        $attributes = array();

        // Add SRI hash if provoided
        if (!empty($integrity)) {
            $attributes['integrity']   = $integrity;
            $attributes['crossorigin'] = 'anonymous';
        }

        // Add the script to the document
        Factory::getDocument()->addStylesheet($url, $options, $attributes);
    }



}
