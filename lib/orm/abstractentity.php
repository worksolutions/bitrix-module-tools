<?php
/**
 * @author Smotrov Dmitriy <smotrov@worksolutions.ru>
 */

namespace WS\Tools\ORM;


abstract class AbstractEntity {
    private $_primary;
    private $_data = array();

    public function __construct($data = array(), $primary = null) {
        $this->_data = array();

        $this->setPrimary($primary);
    }

    /**
     * @return integer
     */
    public function getPrimary() {
        return $this->_primary;
    }

    public function setPrimary($primary) {
        $this->_primary = $primary;
    }

    /**
     * @return array
     */
    public function getData() {
        return $this->_data;
    }

    protected function get($name) {
        return $this->_data[$name];
    }

    protected function set($name, $value) {
        $this->_data[$name] = $value;
    }
}