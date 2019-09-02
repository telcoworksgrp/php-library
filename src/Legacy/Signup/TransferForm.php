<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Legacy\Signup;


class TransferForm extends SignupForm
{

    public $plan       = '';
    public $number     = '';
    public $provider   = '';
    public $company    = '';
    public $abn        = '';
    public $address1   = '';
    public $address2   = '';
    public $suburb     = '';
    public $state      = '';
    public $postcode   = '';
    public $firstname  = '';
    public $lastname   = '';
    public $mobile     = '';
    public $email      = '';
    public $phone      = '';
    public $iagree     = false;
    public $ipaddress  = '';
    public $useragent  = '';
    public $submitted  = '';
    public $referralId = '';
    public $domain     = '';



    /**
     * Constructor method for initalising new instances of this class
     * -------------------------------------------------------------------------
     */
    public function __construct()
    {

        // Call the parent constructor
        parent::__construct();

        // Initalise the form's current state
        $this->plan      = $this->getFormFieldState('port.plan', 'plan', '', 'STRING');
        $this->number    = $this->getFormFieldState('port.number', 'number', '', 'INT', 'STRING');
        $this->provider  = $this->getFormFieldState('port.provider', 'provider', '', 'STRING');
        $this->accountno = $this->getFormFieldState('port.accountno', 'accountno', '', 'INT');
        $this->company   = $this->getFormFieldState('port.company', 'company', '', 'STRING');
        $this->abn       = $this->getFormFieldState('port.abn', 'abn', '', 'INT');
        $this->address1  = $this->getFormFieldState('port.address1', 'address1', '', 'STRING');
        $this->address2  = $this->getFormFieldState('port.address2', 'address2', '', 'STRING');
        $this->suburb    = $this->getFormFieldState('port.suburb', 'suburb', '', 'STRING');
        $this->state     = $this->getFormFieldState('port.state', 'state', '', 'STRING');
        $this->postcode  = $this->getFormFieldState('port.postcode', 'postcode', '', 'INT');
        $this->firstname = $this->getFormFieldState('port.firstanme', 'firstname', '', 'STRING');
        $this->lastname  = $this->getFormFieldState('port.lastname', 'lastname', '', 'STRING');
        $this->mobile    = $this->getFormFieldState('port.mobile', 'mobile', '', 'INT');
        $this->email     = $this->getFormFieldState('port.email', 'email', '', 'EMAIL');
        $this->phone     = $this->getFormFieldState('port.phone', 'phone', '', 'STRING');
        $this->iagree    = $this->getFormFieldState('port.iagree', 'iagree', false, 'BOOL');
    }


}
