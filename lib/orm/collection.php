<?php

namespace WS\Tools\ORM;

/**
 * Коллекция значений.
 *
 * @author nomadhacker@gmail.com, Максим Соколовский (my.sokolovsky@gmail.com)
 */
class Collection implements \IteratorAggregate, \Countable {
    /** hold the collection of items in an array */
    protected $items = array();

    /**
     * Optionally accept an array of items to use for the collection, if provided
     * @params array $items (optional)
     */
    public function __construct($items = null) {
        if ($items !== null && is_array($items)) {
            $this->items = $items;
        }
    }

    /**
     * Function to satisfy the IteratorAggregate interface.  Sets an
     * ArrayIterator instance for the server list to allow this class to be
     * iterable like an array.
     */
    public function getIterator() {
        return new \ArrayIterator($this->items);
    }

    /**
     * Function to satisfy the Countable interface, returns a count of the
     * length of the collection
     * @return int the collection length
     */
    public function count() {
        return $this->length();
    }

    /**
     * Function to add an item to the Collection, optionally specifying
     * the key to access the item with.  Returns the item passed in for
     * continuing work.
     * @param $item object to add
     * @param $key string accessor key (optional)
     * @return mixed the item
     */
    public function addItem($item, $key = null) {
        if($key !== null) {
            $this->items[$key] = $item;
        } else {
            $this->items[] = $item;
        }

        return $item;
    }

    /**
     * Remove an item from the Collection identified by it's key
     * @param $key string identifying key of the item to remove
     */
    public function removeItem($key) {
        if(isset($this->items[$key])) {
            unset($this->items[$key]);
        } else {
            throw new \Exception("Invalid key $key specified.");
        }
    }

    /**
     * Retrieve an item from the collection as identified by its key
     *
     * @param $key string identifying key of the item to remove
     * @return object identified by the key
     * @throws \Exception
     */
    public function getItem($key) {
        if(isset($this->items[$key])) {
            return $this->items[$key];
        } else {
            throw new \Exception("Invalid key $key specified.");
        }
    }

    /**
     * Function to return the entire list of servers as an array
     * of Server objects
     * @return array
     */
    public function getAsArray() {
        return $this->items;
    }

    /**
     * Return the list of keys to all objects in the collection
     * @return array an array of items
     */
    public function keys() {
        return array_keys($this->items);
    }

    /**
     * Return the length of the collection of items
     * @return int the size of the collection
     */
    public function length() {
        return count($this->items);
    }

    /**
     * Check if an item with the identified key exists in the Collection
     * @param $key string key of the item to check
     * @return bool if the item is in the Collection
     */
    public function exists($key) {
        return (isset($this->items[$key]));
    }
}
