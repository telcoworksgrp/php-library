<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\T3;


/**
 * Class that represents a single number returned by the T3 Api
 */
class Number
{

    /**
     * T3's uid for the number (eg: "e59e26e4-766b-45fc-9f55-5ca6fbc0b66" )
     *
     * @var string
     */
    public $id = '';


    /**
     * The 1300/1800 number  (eg: "1300123456" )
     *
     * @var string
     */
    public $number = '';


    /**
     * Number Type (eg "ServiceNumber")
     *
     * @var string
     */
    public $numtype = '';


    /**
     * The type of number (eg: "LUCK_DIP" or "FLASH")
     *
     * @var string
     */
    public $type = '';


    /**
     * price for leasing the number in dollars (eg: "4.45")
     *
     * @var float
     */
    public $price = 0;


    /**
     * Phone word associated with the number
     *
     * @var string
     */
    public $word = '';


    /**
     * The number is available for signup
     *
     * @var bool
     */
    public $available = false;


    /**
     * Formatted number for display #1
     *
     * @var string
     */
    public $format1 = '';


    /**
     * Formatted number for display #2
     *
     * @var string
     */
    public $format2 = '';


    /**
     * Formatted number for display #3
     *
     * @var string
     */
    public $format3 = '';


    /**
     * Formatted number for display #4
     *
     * @var string
     */
    public $format4 = '';


    /**
     * Constructor for initialising new instances of this class
     * -------------------------------------------------------------------------
     */
    public function __construct($data = null)
    {
        // Initialise some class properties
        if (!empty($data)) {
            $this->load($data);
        }
    }


    /**
     * Loads data from an object, array or json string
     * -------------------------------------------------------------------------
     * @param  mixed    $data   Array,object or json string containing T3 data
     *
     * @return void
     */
    public function load($data)
    {
        // Cast objects and json strings to an assoc array
        $data = (is_string($data)) ? json_decode($data) : $data ;
        $data = (array) $data;

        // Set some basic class properties
        $this->id        = trim($data['id'] ?? '');
        $this->number    = trim($data['number'] ?? '');
        $this->numtype   = trim($data['numberType'] ?? '');
        $this->type      = trim($data['type'] ?? '');
        $this->price     = trim($data['price'] ?? 0);
        $this->word      = trim($data['word'] ?? '');
        $this->available = (bool) $data['available'];

        // Set additional display formats
        $this->format1   = preg_replace('|^(\d{4})(\d{6})$|i',
            '$1 $2', $this->number);

        $this->format2   = preg_replace('|^(\d{4})(\d{3})(\d{3})$|i',
            '$1 $2 $3', $this->number);

        $this->format3   = preg_replace('|^(\d{4})(\d{2})(\d{2})(\d{2})$|i',
            '$1 $2 $3 $4', $this->number);

        $this->format4   = (!empty($this->word) ? $this->word
            : $this->format3);
    }

}
