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
     * Raw ACMA data for this entry
     *
     * @var string
     */
    public $data = [];



    /**
     * Constructor for initialising new instances of this class
     * -------------------------------------------------------------------------
     * @param mixed $data  Data for a single entry from ACMA's number registar
     */
    public function __construct($data = null)
    {
        // Initialise some class properties
        $this->data = (array) $data;
    }


    /**
     * Get the value of this entries service type
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getServiceType(string $default = '') : string
    {
        return $this->data['Service Type'] ?? $default;
    }


    /**
     * Get the value of this entries prefix
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getPrefix(string $default = '') : string
    {
        return $this->data['Prefix'] ?? $default;
    }


    /**
     * Get the value of this entries number length
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getNumberLength(string $default = '') : int
    {
        return $this->data['Number Length'] ?? $default;
    }


    /**
     * Get the value of this entries starting/"from" number
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getRangeStart(string $default = '') : string
    {
        return $this->data['From'] ?? $default;
    }


    /**
     * Get the value of this entries ending/"to" number
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getRangeEnd(string $default = '') : string
    {
        return $this->data['To'] ?? $default;
    }


    /**
     * Get the value of this entries status
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getStatus(string $default = ''): string
    {
        return $this->data['Status'] ?? $default;
    }


    /**
     * Get the value of this entries quantity
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getQuantity(string $default = '') : srting
    {
        return $this->data['Quantity'] ?? $default;
    }


    /**
     * Get the value of this entries allocatee
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getAllocatee(string $default = '') : srting
    {
        return $this->data['Allocatee'] ?? $default;
    }


    /**
     * Get the value of this entries allocation date
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getAllocationDate(string $default = '') : srting
    {
        return $this->data['Allocation Date'] ?? $default;
    }


    /**
     * Get the value of this lastest holder
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getLatestHolder(string $default = '') : srting
    {
        return $this->data['Latest Holder'] ?? $default;
    }


    /**
     * Get the value of this entries latest transfer date
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getLatestTransferDate(string $default = '') : srting
    {
        return $this->data['Latest Transfer Date'] ?? $default;
    }


    /**
     * Get the value of this entries EROU holder
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getErouHolder(string $default = '') : srting
    {
        return $this->data['Current EROU holder'] ?? $default;
    }


    /**
     * Get the value of this entries EROU assignment date
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getErouAssignmentDate(string $default = '') : srting
    {
        return $this->data['EROU assignment date'] ?? $default;
    }


    /**
     * Get the value of this entries numbering area
     * -------------------------------------------------------------------------
     * @param   string  $default    Value to return if there is no data
     *
     * @return string
     */
    public function getNumberingArea(string $default = '') : srting
    {
        return $this->data['Numbering Area'] ?? $default;
    }


    /**
     * Check if the entry has been allocated
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function isAllocated() : bool
    {
        return $this->getStatus() == "Allocated";
    }


    /**
     * Check if the entry has a current EROU holder
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function hasErouHolder() : bool
    {
        return $his->getErouHolder() != '';
    }


    /**
     * Check if the entry is a telecom corp flash number
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function isFlashNumber() : bool
    {
        return in_array($this->getErouHolder(), [
            'FYI TELCO',
            'FYI TELCO PTY LTD',
            'TELECOM CORPORATE PTY LTD'
        ]);
    }


    /**
     * Check if this entry is available to telecom corp customers
     * -------------------------------------------------------------------------
     * @return bool
     */
    public function isAvailable(): bool
    {
        $hasErouHolder = $this->hasErouHolder();
        $isAllocated   = $this->isAllocated();
        $isFlashNumber = $this->isFlashNumber();

        return (!$hasErouHolder && !$isAllocated && !$isFlashNumber) ||
            ($hasErouHolder && !$isAllocated && $isFlashNumber);
    }


}
