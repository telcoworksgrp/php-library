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

        $this->plan      = $this->getFieldState('connect.plan', 'plan');
        $this->firstname = $this->getFieldState('connect.firstname', 'firstname');
        $this->lastname  = $this->getFieldState('connect.lastname', 'lastname');
        $this->mobile    = $this->getFieldState('connect.mobile', 'mobile');
        $this->email     = $this->getFieldState('connect.email', 'email');
        $this->phone     = $this->getFieldState('connect.phone', 'phone');
        $this->dob       = $this->getFieldState('connect.dob', 'dob');
        $this->abn       = $this->getFieldState('connect.abn', 'abn');
        $this->number    = $this->getFieldState('connect.number', 'number');
        $this->owner     = $this->getFieldState('connect.owner', 'owner');
        $this->ownerabn  = $this->getFieldState('connect.ownerabn', 'ownerabn');
        $this->company   = $this->getFieldState('connect.company', 'company');
        $this->address1  = $this->getFieldState('connect.address1', 'address1');
        $this->address2  = $this->getFieldState('connect.address2', 'address2');
        $this->suburb    = $this->getFieldState('connect.suburb', 'suburb');
        $this->postcode  = $this->getFieldState('connect.postcode', 'postcode');
        $this->state     = $this->getFieldState('connect.state', 'state');
        $this->iagree    = $this->getFieldState('connect.iagree', 'iagree');

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
