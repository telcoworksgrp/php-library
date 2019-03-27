<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */


namespace TCorp\T3\Api\AvailNumbers;


use \TCorp\T3\Api\Request;


class AvailNumbersRequest extends Request
{

    /**
     * Relative URL that represents the API action to execute
     *
     * @var string
     */
    protected $action = 'numbers-service-impl/api/Activations';


    /**
     * Constructor for initialising new instances of this class
     * -------------------------------------------------------------------------
     */
    public function __construct()
    {
        // Initlialise some of the request's parameters
        $this->setPrefix(1300);
        $this->setParam('numberTypes', 'SERVICE_NUMBER');
        $this->setType('LUCKY_DIP');
        $this->setMinPrice(0);
        $this->setMaxPrice(1000);
        $this->setPage(1);
        $this->setLimit(25);
        $this->setOrdering('PRICE');
        $this->setDirection('ASCENDING');
    }


    /**
     * Get the number prefix to filter the results with
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getPrefix()
    {
        return $this->getParam('query');
    }


    /**
     *  Set the number prefix to filter the results with
     * -------------------------------------------------------------------------
     * @param int   $value     A new value
     */
    public function setPrefix(int $value)
    {
        $value = (in_array($value, array(1300,1800))) ? $value : null;
        $this->setParam('query', $value);
    }


    /**
     * Get the type of number to filter the results with
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getType()
    {
        return $this->getParam('serviceNumberTypes');
    }


    /**
     * Set the type of number to filter the results with
     * -------------------------------------------------------------------------
     * @param string    $value   A new value
     */
    public function setType(string $value)
    {
        $value = strtoupper($value);
        $value = (in_array($value, array('FLASH','LUCKY_DIP'))) ? $value : '';
        $this->setParam('serviceNumberTypes', $value);
    }


    /**
     * Get the minimum price (in dollars) to filter the results with
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getMinPrice()
    {
        return $this->getParam('minPriceDollars');
    }


    /**
     * Set the minimum price (in dollars) to filter the results with
     * -------------------------------------------------------------------------
     * @param int   $value   a new value
     */
    public function setMinPrice(int $value)
    {
        $value = ($value >= 0) ? $value :  0 ;
        $this->setParam('minPriceDollars', $value);
    }


    /**
     * Get the maximum price (in dollars) to filter the results with
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getMaxPrice()
    {
        return $this->getParam('maxPriceDollars');
    }


    /**
     * Set the maximum price (in dollars) to filter the results with
     * -------------------------------------------------------------------------
     * @param int   $value   a new value
     */
    public function setMaxPrice(int $value)
    {
        $value = ($value >= 0) ? $value : 0 ;
        $this->setParam('maxPriceDollars', $value);
    }


    /**
     * Get the page number to start at
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getPage()
    {
        return $this->getParam('pageNum');
    }


    /**
     * Set the page number to start at
     * -------------------------------------------------------------------------
     * @param int   $value  A new value
     */
    public function setPage(int $value)
    {
        $value = ($value > 0) ? $value : 1 ;
        $this->getParam('pageNum', $value);
    }


    /**
     * Set the page number based on item number (starting with 0)
     * -------------------------------------------------------------------------
     * @param int   $itemNo  A item number
     */
    public function setPageByItemNo(int $itemNo)
    {
        $itemNo = ($itemNo <  0) ? 0 : $itemNo;
        $limit  = $this->getLimit();
        $pageNo = ($item / $limit) + 1;
        $this->setPage($pageNo);
    }


    /**
     * Get the maximum number of results to return
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getLimit()
    {
        return $this->getParam('pageSize');
    }


    /**
     * Set the maximum number of results to return. Hard limit of 1000
     * -------------------------------------------------------------------------
     * @param int   $value  A new value
     */
    public function setLimit(int $value)
    {
        $value       = ($value < 0) ? 0 : $value;
        $value       = ($value > 1000) ? 1000 : $value ;
        $this->setParam('pageSize', $value);
    }


    /**
     * Get the 'column' to sort the results by
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getOrdering()
    {
        return $this->getParam('sortBy');
    }


    /**
     * Set the value of Sort the results by this column
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     */
    public function setOrdering(string $value)
    {
        $value = strtoupper($value);
        $value = (in_array($value, array('PRICE','NUMBER'))) ? $value : 'PRICE';
        $this->setParam('sortBy', $value);
    }


    /**
     * Get the direction to sort the results in
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getDirection()
    {
        return $this->getParam('sortDirection');
    }


    /**
     * Set the direction to sort the results in
     * -------------------------------------------------------------------------
     * @param string    $value  A new value
     */
    public function setDirection($value)
    {
        $value = strtoupper($value);

        if ($value == 'DESC' || $value == 'DESCENDING') {
            $value = 'DESCENDING';
        } else {
            $value = 'ASCENDING';
        }

        $this->setParam('sortDirection', $value);
    }


}
