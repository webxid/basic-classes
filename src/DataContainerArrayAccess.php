<?php

namespace WebXID\BasicClasses;

abstract class DataContainerArrayAccess extends DataContainer implements \Iterator, \ArrayAccess, \Countable
{
    #region Iterator Interface

    /**
     * Return the current object
     *
     * @return object|false
     */
    public function current()
    {
        return current($this->_data);
    }

    /**
     * Advance the internal array pointer of an array
     */
    public function next()
    {
        next($this->_data);
    }

    /**
     * Return the key of the current element
     *
     * @return int
     */
    public function key()
    {
        return key($this->_data);
    }

    /**
     * Checks if current position is valid
     *
     * @return bool
     */
    public function valid()
    {
        return current($this->_data) !== false;
    }

    /**
     * Rewind the Iterator to the first element
     */
    public function rewind()
    {
        reset($this->_data);
    }

    #endregion

    #region Iterator Methods

    /**
     * Whether a offset exists
     *
     * @param $offset
     *
     * @return bool
     * @internal param $int
     */
    public function offsetExists($offset)
    {
        return isset($this->_data[$offset]);
    }

    /**
     * @param $offset
     *
     * @return object|null
     */
    public function offsetGet($offset)
    {
        return $this->_data[$offset];
    }

    /**
     * @param $offset
     * @param mixed $object
     */
    public function offsetSet($offset, $value)
    {
        $this->_data[$offset] = $value;
    }

    /**
     * Offset to unset
     *
     * @param int $index
     */
    public function offsetUnset($offset)
    {
        unset($this->_data[$offset]);
    }

    #endregion

    #region Countable Interface

    /**
     * Count elements of an object
     *
     * @return int
     */
    public function count()
    {
        return count($this->_data);
    }

    #endregion

    #region Getters

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->_data;
    }

     #endregion
}