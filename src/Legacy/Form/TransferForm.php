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
        $this->plan       = $this->getFieldState('transfer.plan', 'plan');
        $this->number     = $this->getFieldState('transfer.number', 'number');
        $this->provider   = $this->getFieldState('transfer.provider', 'provider');
        $this->accountno  = $this->getFieldState('transfer.accountno', 'accountno');
        $this->company    = $this->getFieldState('transfer.company', 'company');
        $this->abn        = $this->getFieldState('transfer.abn', 'abn');
        $this->address1   = $this->getFieldState('transfer.address1', 'address1');
        $this->address2   = $this->getFieldState('transfer.address2', 'address2');
        $this->suburb     = $this->getFieldState('transfer.suburb', 'suburb');
        $this->state      = $this->getFieldState('transfer.state', 'state');
        $this->postcode   = $this->getFieldState('transfer.postcode', 'postcode');
        $this->firstname  = $this->getFieldState('transfer.firstname', 'firstname');
        $this->lastname   = $this->getFieldState('transfer.lastname', 'lastname');
        $this->mobile     = $this->getFieldState('transfer.mobile', 'mobile');
        $this->email      = $this->getFieldState('transfer.email', 'email');
        $this->phone      = $this->getFieldState('transfer.phone', 'phone');
        $this->iagree     = $this->getFieldState('transfer.iagree', 'iagree');

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
