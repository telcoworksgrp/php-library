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

    public $plan      = '';
    public $number    = '';
    public $provider  = '';
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
     * Update class properies to represent the current state of the form. This
     * takes into consideration form field values stored in the current session
     * and form field values passed in the http request. Values in the http
     * request override and replace values stored in the current session.
     * -------------------------------------------------------------------------
     * @return void
     */
    public function updateState()
    {
        $this->plan      = $this->getFormFieldState('port.plan', 'plan', '');
        $this->number    = $this->getFormFieldState('port.number', 'number', '', 'INT');
        $this->provider  = $this->getFormFieldState('port.provider', 'provider', '');
        $this->company   = $this->getFormFieldState('port.company', 'company', '');
        $this->abn       = $this->getFormFieldState('port.abn', 'abn', '', 'INT');
        $this->address1  = $this->getFormFieldState('port.address1', 'address1', '');
        $this->address2  = $this->getFormFieldState('port.address2', 'address2', '');
        $this->suburb    = $this->getFormFieldState('port.suburb', 'suburb', '');
        $this->state     = $this->getFormFieldState('port.state', 'state', '');
        $this->postcode  = $this->getFormFieldState('port.postcode', 'postcode', '', 'INT');
        $this->firstname = $this->getFormFieldState('port.firstname', 'firstname', '');
        $this->lastname  = $this->getFormFieldState('port.lastname', 'lastname', '');
        $this->mobile    = $this->getFormFieldState('port.mobile', 'mobile', '', 'INT');
        $this->email     = $this->getFormFieldState('port.email', 'email', '', 'EMAIL');
        $this->phone     = $this->getFormFieldState('port.phone', 'phone', '');
        $this->iagree    = $this->getFormFieldState('port.iagree', 'iagree', '', 'BOOL');

        parent::updateState();
    }

}
