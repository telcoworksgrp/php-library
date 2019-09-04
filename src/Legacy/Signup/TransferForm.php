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

use \TCorp\Legacy\Session;


class TransferForm extends SignupForm
{

    public $plan      = '';
    public $number    = '';
    public $provider  = '';
    public $accoutnno = '';
    public $company   = '';
    public $abn       = '';
    public $address1  = '';
    public $address2  = '';
    public $suburb    = '';
    public $state     = '';
    public $postcode  = '';
    public $firstname = '';
    public $lastname  = '';
    public $mobile    = '';
    public $email     = '';
    public $phone     = '';
    public $iagree    = false;



    /**
     * Loads the current state of the signup form from the current session
     * -------------------------------------------------------------------------
     * @return void
     */
    public function loadState() : void
    {
        // Call the parent method
        parent::loadState();

        // Load form field values
        $this->plan      = Helper::getSessionValue('port.plan', '');
        $this->number    = Helper::getSessionValue('port.number', '');
        $this->provider  = Helper::getSessionValue('port.provider', '');
        $this->accountno = Helper::getSessionValue('port.accountno', '');
        $this->company   = Helper::getSessionValue('port.company', '');
        $this->abn       = Helper::getSessionValue('port.abn', '');
        $this->address1  = Helper::getSessionValue('port.address1', '');
        $this->address2  = Helper::getSessionValue('port.address2', '');
        $this->suburb    = Helper::getSessionValue('port.suburb', '');
        $this->state     = Helper::getSessionValue('port.state', '');
        $this->postcode  = Helper::getSessionValue('port.postcode', '');
        $this->firstname = Helper::getSessionValue('port.firstname', '');
        $this->lastname  = Helper::getSessionValue('port.lastname', '');
        $this->mobile    = Helper::getSessionValue('port.mobile', '');
        $this->email     = Helper::getSessionValue('port.email', '');
        $this->phone     = Helper::getSessionValue('port.phone', '');
        $this->iagree    = Helper::getSessionValue('port.iagree', '');
    }


    /**
     * Update the current state of the signup form to include any new data
     * submitted with the current request. This will also update values in
     * current session
     * -------------------------------------------------------------------------
     * @return void
     */
    public function updateState() : void
    {
        // Call the parent method
        parent::updateState();

        // Load form field values
        $this->plan      = $this->getFieldState('port.plan', 'plan', '');
        $this->number    = $this->getFieldState('port.number', 'number', '', 'INT');
        $this->provider  = $this->getFieldState('port.provider', 'provider', '');
        $this->accountno = $this->getFieldState('port.accountno', 'accountno', '');
        $this->company   = $this->getFieldState('port.company', 'company', '');
        $this->abn       = $this->getFieldState('port.abn', 'abn', '', 'INT');
        $this->address1  = $this->getFieldState('port.address1', 'address1', '');
        $this->address2  = $this->getFieldState('port.address2', 'address2', '');
        $this->suburb    = $this->getFieldState('port.suburb', 'suburb', '');
        $this->state     = $this->getFieldState('port.state', 'state', '');
        $this->postcode  = $this->getFieldState('port.postcode', 'postcode', '', 'INT');
        $this->firstname = $this->getFieldState('port.firstname', 'firstname', '');
        $this->lastname  = $this->getFieldState('port.lastname', 'lastname', '');
        $this->mobile    = $this->getFieldState('port.mobile', 'mobile', '', 'INT');
        $this->email     = $this->getFieldState('port.email', 'email', '', 'EMAIL');
        $this->phone     = $this->getFieldState('port.phone', 'phone', '');
        $this->iagree    = $this->getFieldState('port.iagree', 'iagree', '', 'BOOL');
    }


}
