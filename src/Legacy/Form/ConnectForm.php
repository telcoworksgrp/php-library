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
 * Class for working with the telecom corporate connect signup form
 */
class ConnectForm extends BaseForm
{

    public $plan      = '';
    public $firstname = '';
    public $lastname  = '';
    public $mobile    = '';
    public $email     = '';    
    public $phone     = '';
    public $dob       = '';
    public $abn       = '';
    public $number    = '';
    public $owner     = '';
    public $ownerabn  = '';
    public $company   = '';
    public $address1  = '';
    public $address2  = '';
    public $suburb    = '';
    public $postcode  = '';
    public $state     = '';
    public $iagree    = false;


    /**
     * Load the current state of the form
     * -------------------------------------------------------------------------
     * @return void
     */
    public function loadState()
    {

        $this->plan      = Helper::getFormFieldState('connect.plan', 'plan');
        $this->firstname = Helper::getFormFieldState('connect.firstname', 'firstname');
        $this->lastname  = Helper::getFormFieldState('connect.lastname', 'lastname');
        $this->mobile    = Helper::getFormFieldState('connect.mobile', 'mobile');
        $this->email     = Helper::getFormFieldState('connect.email', 'email');
        $this->phone     = Helper::getFormFieldState('connect.phone', 'phone');
        $this->dob       = Helper::getFormFieldState('connect.dob', 'dob');
        $this->abn       = Helper::getFormFieldState('connect.abn', 'abn');
        $this->number    = Helper::getFormFieldState('connect.number', 'number');
        $this->owner     = Helper::getFormFieldState('connect.owner', 'owner');
        $this->ownerabn  = Helper::getFormFieldState('connect.ownerabn', 'ownerabn');
        $this->company   = Helper::getFormFieldState('connect.company', 'company');
        $this->address1  = Helper::getFormFieldState('connect.address1', 'address1');
        $this->address2  = Helper::getFormFieldState('connect.address2', 'address2');
        $this->suburb    = Helper::getFormFieldState('connect.suburb', 'suburb');
        $this->postcode  = Helper::getFormFieldState('connect.postcode', 'postcode');
        $this->state     = Helper::getFormFieldState('connect.state', 'state');
        $this->iagree    = Helper::getFormFieldState('connect.iagree', 'iagree');

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
        Helper::setSessionValue('connect', []);
    }

}
