<?php

namespace WS\Tools\ORM;

/**
 * Базовый класс сущьности, производит работу с аттрибутами, связями.
 * 
 * Производит нормализацию сущьности (возможно будет заниматься валидацией)
 *
 * @property int $id
 *
 * @author Максим Соколовский (my.sokolovsky@gmail.com)
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
     * Получение значения аттрибута без использования геттера.
     * @param string $name
     * @return mixed 
     */
    protected function _get($name) {
        return $this->attributes[$name];
    }
    
    /**
     * Установка значения аттрибута без использования сеттера.
     * @param string $name
     * @param mixed $value
     * @return mixed 
     */
    protected function _set($name, $value) {
        $this->attributes[$name] = $value;
    }
}
