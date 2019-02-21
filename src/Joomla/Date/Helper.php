<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\Date;

use \Joomla\CMS\HTML\HTMLHelper;


/**
 * Helper class for working with dates
 */
class Helper
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

}
