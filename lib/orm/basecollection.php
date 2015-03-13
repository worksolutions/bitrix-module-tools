<?php
/**
 * @author Smotrov Dmitriy <smotrov@worksolutions.ru>
 */

namespace WS\Tools\ORM;


use ArrayIterator;
use IteratorAggregate;

class BaseCollection implements IteratorAggregate, CollectionInterface {

    private $_items = array();

    public function push($entity) {
        $this->_items[] = $entity;
    }

    /**
     * @return AbstractEntity
     */
    public function pop() {
        return array_pop($this->_items);
    }

    public function getIterator() {
        return new ArrayIterator($this->_items);
    }

    public function getArrayCopy() {
        return $this->_items;
    }
}