<?php
/**
 * =============================================================================
 *
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @copyright   Copyright (C) 2019 Telecom Corporation. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 *
 * =============================================================================
 */

namespace TCorp\Legacy\Http;


/**
 * Class for managing a list of HTTP headers
 */
class HeaderList implements Iterator
{

    /**
     * Current position of the list
     *
     * @var int
     */
    private $position = 0;


    /**
     * A list of HTTP headers
     *
     * @var string[]
     */
    private $items = [];


    /**
     * Return the current element
     * -------------------------------------------------------------------------
     * @return mixed
     */
    public function current() : mixed
    {
        return $this->items[$this->position];
    }


    /**
     * [key description]
     * -------------------------------------------------------------------------
     * @return scalar [description]
     */
    public function key() : scalar
    {
        return $this->position;
    }

    public function next() : void
    {
        ++$this->position;
    }

    public function rewind() : void
    {
        $this->position = 0;
    }

    public function valid() : bool
    {
        return isset($this->items[$this->position]);
    }

}
