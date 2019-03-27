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
     * Prefix to filter the results with
     *
     * @var int
     */
    protected $prefix = null;


    /**
     * The type of number to filter the results with
     *
     * @var string
     */
    protected $type = '';


    /**
     * Minimum price (in dollars) to filter the results with
     *
     * @var int
     */
    protected $minPrice = 0;


    /**
     * Maximum price (in dollars) to filter the results with
     *
     * @var int
     */
    protected $maxPrice = 1000;


    /**
     * Page number to start at
     *
     * @var int
     */
    protected $page = 1;


    /**
     * Maximum number of results to return
     *
     * @var int
     */
    protected $limit = 25;

    /**
     * 'Column' to sort the results by
     *
     * @var string
     */
    protected $ordering = 'PRICE';


    /**
     * Direction to sort the results in
     *
     * @var string
     */
    protected $direction = 'ASCENDING';



    /**
     * Get the number prefix to filter the results with
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getPrefix()
    {
        return $this->prefix;
    }


    /**
     *  Set the number prefix to filter the results with
     * -------------------------------------------------------------------------
     * @param int   $value     A new value
     */
    public function setPrefix(int $value)
    {
        $value = (in_array($value, array(1300,1800))) ? $value : null;
        $this->prefix = $value;
    }


    /**
     * Get the type of number to filter the results with
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Set the type of number to filter the results with
     * -------------------------------------------------------------------------
     * @param string    $value   A new value
     */
    public function setType(string $value)
    {
        $value = strtoupper($value);
        $value = (in_array($value, array('FLASH','LUCKY_DIP'))) ? $value : null;
        $this->type = $value;
    }


    /**
     * Get the minimum price (in dollars) to filter the results with
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getMinPrice()
    {
        return $this->minPrice;
    }


    /**
     * Set the minimum price (in dollars) to filter the results with
     * -------------------------------------------------------------------------
     * @param int   $value   a new value
     */
    public function setMinPrice(int $value)
    {
        $value = ($value >= 0) $value ? 0 ;
        $this->minPrice = $value;
    }


    /**
     * Get the maximum price (in dollars) to filter the results with
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getMaxPrice()
    {
        return $this->maxPrice;
    }


    /**
     * Set the maximum price (in dollars) to filter the results with
     * -------------------------------------------------------------------------
     * @param int   $value   a new value
     */
    public function setMaxPrice(int $value)
    {
        $value = ($value >= 0) $value ? 0 ;
        $this->maxPrice = $value;
    }


    /**
     * Get the page number to start at
     * -------------------------------------------------------------------------
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }


    /**
     * Set the page number to start at
     * -------------------------------------------------------------------------
     * @param int   $value  A new value
     */
    public function setPage(int $value)
    {
        $value = ($value > 0) $value ? 1 ;
        $this->page = $page;
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
        return $this->limit;
    }


    /**
     * Set the maximum number of results to return. Hard limit of 1000
     * -------------------------------------------------------------------------
     * @param int   $value  A new value
     */
    public function setLimit(int $value)
    {
        $value       = ($value < 0) 0 ? $value;
        $value       = ($value > 1000) 1000 ? $value ;
        $this->limit = $value;
    }


    /**
     * Get the 'column' to sort the results by
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getOrdering()
    {
        return $this->ordering;
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
        $this->ordering = $value;
    }


    /**
     * Get the direction to sort the results in
     * -------------------------------------------------------------------------
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
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
            $this->direction = 'DESCENDING';
        } else {
            $this->direction = 'ASCENDING';
        }
    }


}