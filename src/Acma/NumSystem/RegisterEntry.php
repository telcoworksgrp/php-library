<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Acma\NumSystem;


/**
 * Class that represents a single entry in ACMA's numbering system registrar
 *
 * @todo Find a glossary of terms and improve comments
 */
class RegisterEntry
{

    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var string
     */
    public $serviceType = '';


    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var int
     */
    public $prefix = '';


    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var int
     */
    public $numberLength = '';


    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var int
     */
    public $from = '';


    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var int
     */
    public $to = '';


    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var string
     */
    public $status = '';


    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var int
     */
    public $quantity = '';


    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var string
     */
    public $allocatee = '';


    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var string
     */
    public $allocationDate = '';


    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var string
     */
    public $latestHolder = '';


    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var string
     */
    public $latestTransferDate = '';


    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var string
     */
    public $currentErouHolder = '';


    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var string
     */
    public $erouAssignmentDate = '';


    /**
     * Lorem ipsum dolor sit amet, consectetur
     *
     * @var string
     */
    public $numberingArea = '';



    /**
     * Constructor for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @param mixed $data  Data for a single entry from ACMA's number registar
     */
    public function __construct($data = null)
    {
        // Initialise some class properties
        if (is_array($data)) {
            $this->loadFromArray($data);
        }
    }


    /**
     * Load entry data from an assoc array
     * -------------------------------------------------------------------------
     * @param  array  $data     Data for a single entry
     *
     * @return void
     */
    public function loadFromArray(array $data)
    {
        $this->serviceType        = $data['Service Type'] ?? '';
        $this->prefix             = $data['Prefix'] ?? '';
        $this->numberLength       = $data['Number Length'] ?? '';
        $this->from               = $data['From'] ?? '';
        $this->to                 = $data['To'] ?? '';
        $this->status             = $data['Status'] ?? '';
        $this->quantity           = $data['Quantity'] ?? '';
        $this->allocatee          = $data['Allocatee'] ?? '';
        $this->allocationDate     = $data['Allocation Date'] ?? '';
        $this->latestHolder       = $data['Latest Holder'] ?? '';
        $this->latestTransferDate = $data['Latest Transfer Date'] ?? '';
        $this->currentErouHolder  = $data['Current EROU holder'] ?? '';
        $this->erouAssignmentDate = $data['EROU assignment date'] ?? '';
        $this->numberingArea      = $data['Numbering Area'] ?? '';
    }

}
