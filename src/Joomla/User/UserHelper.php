<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Joomla\User;


defined('_JEXEC') or die();


use \Joomla\CMS\Factory;


/**
 * Helper class for working with Joomla user info
 */
class UserHelper
{


    /**
     * Get the full name (as opposed to username) of given user id
     * -------------------------------------------------------------------------
     * @param   int     $userId     The id of the user
     * @param   string  $default    A value to return if unsucessful
     *
     * @return  string The full name of the given user
     */
    public static function getFullName($userId = 0, string $default = '-')
    {
        // Get and return the user's name
        return (empty($userId)) ? $default : Factory::getUser($userId)->name;
    }



    /**
     * Check if the a user is authorised to perform an action on a given asset
     * -------------------------------------------------------------------------
     * @param  string   $action     The action requested to perform
     * @param  string   $asset      The asset on which the action to be performed
     * @param  mixed    $userId     Id of the user, or null for the current user
     *
     * @return bool     TRUE if authorised, FALSE is not authorised
     */
    public static function isAuthorised(string $action, string $asset, $userId = null)
    {
        // Check if the user is authorised to perform the action on
        // the given asset and return the result
        return Factory::getUser($userId)->authorise($action, $asset);
    }


}
