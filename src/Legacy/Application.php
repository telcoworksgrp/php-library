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

namespace TCorp\Legacy;


/**
 * Class for implementing a Telecom Corp/Telcoworks Group legacy web application
 */
class Application
{

    /**
     * Holds the global form object
     *
     * @var \TCorp\Legacy\Form
     */
    public $form = null;


    /**
     * Holds the global T3 client object
     *
     * @var \TCorp\Legacy\T3
     */
    public $t3 = null;


    /**
     * Holds the global firewall object
     *
     * @var \TCorp\Legacy\Firewall
     */
    public $firewall = null;



    /**
     * Construtor method for initiailing new instances of this class
     * -------------------------------------------------------------------------
     * @return void
     */
    public function __construct()
    {
        // Initialise some class properties
        $this->form     = Factory::getForm();
        $this->t3       = Factory::getT3Client();
        $this->firewall = Factory::getFirewall();
    }


}
