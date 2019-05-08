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

namespace TCorp\Helper;


/**
 * Helper class for working with arrays
 */
class ArrayHelper
{


    /**
     * Find which array element contains the closest value to the one provided.
     * This method only works on arrays containing int or float values
     * --------------------------------------------------------------------------
     * @param  float         $value     The value to use
     * @param  float[]       $array     A list of float or int values
     *
     * @return int|string    The key of the element which is closest
     */
     public static function closestToValue(float $value, array $array)
     {
         // Initlise some local variables
         $closest = null;

         // Find the element with the closest value
         foreach ($array as $key => $item) {

             if ($closest === null || abs($value - $closest) >
                 abs($item - $value)) {

                 $closest = $item;
                 $result  = $key;

             }
         }

         // Return the result
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
      public static function toCSSRule(string $selector, array $properties) : string
      {
          // Compose the declaration block
          $declaration = array();

          foreach ($properties AS $property => $value) {
              $declaration[] = "$property: $value;";
          }

          $declaration = implode(' ', $declaration);


          // Combine the selector and declaration block
          $result = "$selector { $declaration }";

          // Return the result
          return $result;
    }


}
