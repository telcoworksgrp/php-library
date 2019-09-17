<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Joomla\Helper;

use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Factory;


/**
 * Generic helper class fpr working with Joomla
 */
class JoomlaHelper
{


    /**
     * Format a MySQL datetime value into a more user friendly format
     * -------------------------------------------------------------------------
     * @param  string   $dateTime   The MySQL datetime value to format
     * @param  string   $format     The output format (optional)
     * @param  string   $default    Default value if date is '0'/invalid
     *
     * @return string   A more user friendly datetime string
     */
    public static function formatMysqlDateTime($dateTime, string
        $format = 'd/m/Y h:i:s A', string $default = '-')
    {
        // If the value is '0' or invalid the return the default
        if (empty($dateTime) OR ($dateTime == '0000-00-00 00:00:00')) {
            return $default;
        }

        // Get and return the new value
        return HTMLHelper::_('date', $dateTime, $format, true);
    }


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
