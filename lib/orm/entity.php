<?php

namespace WS\Tools\ORM;

/**
 * Base entity class, works with attributes and relations.
 * 
 * Performs normalization of entity (maybe will make validation)
 *
 * @property int $id
 *
 * @author my.sokolovsky@gmail.com
 * 
 */
abstract class Entity {

    protected $attributes;

    /**
     * @param $id
     * @return Entity
     */
    static public function createProxy($id) {
        $class = get_called_class();
        $entity = new $class;
        $entity->id = $id;
        return $entity;
    }
    /**
     * @return string
     */
    static public function className() {
        return get_called_class();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function get($name) {
        $methName = 'get'.$name;
        if (method_exists($this, $methName)) {
            return $this->$methName();
        }
        return $this->_get($name);
    }

    /**
     * @param $name
     * @param $value
     * @return mixed
     */
    public function set($name, $value) {
        $methName = 'set'.$name;
        if (method_exists($this, $methName)) {
            return $this->$methName($value);
        }
        return $this->_set($name, $value);
    }
    
    public function __get($name) {
        return $this->get($name);
    }
    
    public function __set($name, $value) {
        $this->set($name, $value);
        return $value;
    }
    
    /**
     * Get property value without getter.
     * @param string $name
     * @return mixed 
     */
    protected function _get($name) {
        return $this->attributes[$name];
    }
    
    /**
     * Get property value without setter.
     * @param string $name
     * @param mixed $value
     * @return mixed 
     */
    protected function _set($name, $value) {
        $this->attributes[$name] = $value;
    }
}
