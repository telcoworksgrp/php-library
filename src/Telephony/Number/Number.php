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

namespace TCorp\Telephony\Number;


/**
 * Class for working with telephone numbers
 */
class Number
{

    /**
     * An international dialling prefix for the number
     *
     * @var NumberIntlCode
     */
    public $intlCode  = null


    /**
     * A country calling code for the phone number
     *
     * @var NumberCountry
     */
    public $country = mull


    /**
     * An area code for the phone number.
     *
     * @var NumberArea
     */
    public $area = null;


    /**
     * A prefix for the phone number
     *
     * @var NumberPrefix
     */
    public $prefix = null;


    /**
     * A suffix for the phone number
     *
     * @var NumberSuffix
     */
    public $suffix = null;


    /**
     * An extension nmber for the phone number
     *
     * @var NumberExt
     */
    public $extension = null;



    /**
     * Constructor method for initialising new instances of this class
     * -------------------------------------------------------------------------
     */
    public function __construct()
    {
        // Initialise all the various phone number parts
        $this->intlCode  = new NumberIntlCode();
        $this->country   = new NumberCountry();
        $this->area      = new NumberArea();
        $this->prefix    = new NumberPrefix();
        $this->suffix    = new NumberSuffix();
        $this->extension = new NumberExt();
    }


}
