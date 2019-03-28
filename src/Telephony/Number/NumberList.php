<?php
/**
 * @package     Telecom Corporation PHP Library
 * @author      David Plath <webmaster@telecomcorp.com.au>
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

namespace TCorp\Telephony\Number;


/**
 * Class for working with a list of telephone numbers. This class implements
 * the ArrayAccess, SeekableIterator and Countable interfaces which means list
 * items can added/unset/accessed like a regular array and can be used with
 * foreach and count()
 */
class NumberList implements \ArrayAccess, \SeekableIterator, \Countable
{

    /**
     * A list of numbers managed by the list
     *
     * @var Number
     */
    protected $numbers  = array();



    /**
     * [current description]
     * -------------------------------------------------------------------------
     * @return mixed    [description]
     */
    public function current() : mixed
    {
        return current($this->numbers);
    }


    /**
     * [key description]
     * -------------------------------------------------------------------------
     * @return scalar   [description]
     */
    public function key() : scalar
    {
        return key($this->numbers);
    }


    /**
     * [next description]
     * -------------------------------------------------------------------------
     */
    public function next() : void
    {
        next($this->numbers);
    }


    /**
     * [rewind description]
     * -------------------------------------------------------------------------
     */
    public function rewind() : void
    {
        rewind($this->numbers);
    }


    /**
     * [valid description]
     * -------------------------------------------------------------------------
     * @return bool     [description]
     */
    public function valid() : bool
    {
        valid($this->numbers);
    }


    /**
     * [seek description]
     * -------------------------------------------------------------------------
     * @param int   $position   [description]
     */
    public function seek(int $position) : void
    {
        seek($this->numbers);
    }


    /**
     * Check if a phone number exists at a given offset
     * -------------------------------------------------------------------------
     * @param  mixed    $offset    An offset to check for
     *
     * @return bool TRUE if a number exists, FALSE if not
     */
    public function offsetExists(mixed $offset) : bool
    {
        return isset($this->numbers[$offset]);
    }


    /**
     * Returns the phone number at given offset.
     * -------------------------------------------------------------------------
     * @param  mixed    $offset     The offset to retrieve.
     *
     * @return mixed    The phone number at the given offset
     */
    public function offsetGet(mixed $offset) : mixed
    {
        return isset($this->numbers[$offset]) ? $this->numbers[$offset] : null;
    }


    /**
     * Set the phone number at a given offset
     * -------------------------------------------------------------------------
     * @param mixed     $offset     The offset to assign the value to.
     *
     * @param Number     $value      The value to set.
     */
    public function offsetSet(mixed $offset , Number $value) : void
    {
        $this->container[$offset] = $value;
    }


    /**
     * Unset the phone number at the given offeset
     * -------------------------------------------------------------------------
     * @param mixed     $offset     The offset to unset.
     */
    public function offsetUnset(mixed $offset) : void
    {
        unset($this->numbers[$offset]);
    }


    /**
     *  Count elements of numbers in the list
     *  ------------------------------------------------------------------------
     * @return int  The number of phone numbers in th elist
     */
    public function count() : int
    {
        return count($this->numbers);
    }


}
