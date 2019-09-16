<?php
/**
 * =============================================================================
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 * =============================================================================
 */

namespace TCorp\Legacy\Form;

use \TCorp\Legacy\Helper;


/**
 * Class for working with the telecom corporate transfer signup form
 */
class TransferForm extends BaseForm
{

    public $plan      = '';
    public $number    = '';
    public $provider  = '';
    public $accountno = '';
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
     * Load the current state of the form
     * -------------------------------------------------------------------------
     * @return void
     */
    public function loadState()
    {
        $this->plan       = Helper::getFormFieldState('transfer.plan', 'plan');
        $this->number     = Helper::getFormFieldState('transfer.number', 'number');
        $this->provider   = Helper::getFormFieldState('transfer.provider', 'provider');
        $this->accountno  = Helper::getFormFieldState('transfer.accountno', 'accountno');
        $this->company    = Helper::getFormFieldState('transfer.company', 'company');
        $this->abn        = Helper::getFormFieldState('transfer.abn', 'abn');
        $this->address1   = Helper::getFormFieldState('transfer.address1', 'address1');
        $this->address2   = Helper::getFormFieldState('transfer.address2', 'address2');
        $this->suburb     = Helper::getFormFieldState('transfer.suburb', 'suburb');
        $this->state      = Helper::getFormFieldState('transfer.state', 'state');
        $this->postcode   = Helper::getFormFieldState('transfer.postcode', 'postcode');
        $this->firstname  = Helper::getFormFieldState('transfer.firstname', 'firstname');
        $this->lastname   = Helper::getFormFieldState('transfer.lastname', 'lastname');
        $this->mobile     = Helper::getFormFieldState('transfer.mobile', 'mobile');
        $this->email      = Helper::getFormFieldState('transfer.email', 'email');
        $this->phone      = Helper::getFormFieldState('transfer.phone', 'phone');
        $this->iagree     = Helper::getFormFieldState('transfer.iagree', 'iagree');

        // Call the parent method
        parent::loadState();
    }



    /**
     * Clear the form's current state
     * -------------------------------------------------------------------------
     * @return void
     */
    public function clearState()
    {
        Helper::setSessionValue('transfer', []);
    }

}
