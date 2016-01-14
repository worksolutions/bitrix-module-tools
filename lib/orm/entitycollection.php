<?php

namespace WS\Tools\ORM;

/**
 * Коллекция сущностей определенного типа.
 *
 * @author Максим Соколовский (my.sokolovsky@gmail.com)
 */
class EntityCollection extends Collection {

    /**
     * @var string
     */
    private $_entityClass;

    public function __construct($entityClass, $items = null) {
        if (!class_exists($entityClass)) {
            throw new \Exception("Class `$entityClass` not exists");
        }
        $this->_entityClass = $entityClass;
        // Проверка правильности класса ожидаемой сущности
        if (is_null($items)) {
            return ;
        }
        foreach($items as $entity) {
            $this->addItem($entity, $entity->id);
        }
    }
    
    /**
     * @return string
     */
    public function getEntityClass() {
        return ltrim($this->_entityClass, '\\');
    }

    /**
     * Добавление сущности к коллекции.
     *
     * @param Entity $entity Объект сущности
     * @param string $key ключ
     * @return Entity
     * @throws \Exception
     */
    public function addItem(Entity $entity, $key = null) {
        $entityClass = get_class($entity);
        if ($entityClass !== $this->getEntityClass()) {
            throw new \Exception("Item `$entityClass` is not valid current collection type `{$this->getEntityClass()}`");
        }
        return parent::addItem($entity, $key);
    }

    /**
     * @return Entity
     */
    public function getFirst() {
        foreach ($this->items as $item) {
            return $item;
        }
    }

    /**
     * @param callable|\Closure $func
     * @return array
     * @throws \Exception
     */
    public function thinOut($func) {
        if (!is_callable($func) || ! $func instanceof \Closure) {
            throw new \Exception("$func must be function");
        }
        $res = array();
        foreach ($this->getAsArray() as $key => $value) {
            $itemRes = $func($value);
            if (is_array($itemRes) && count($itemRes) == 2 && !is_null($itemRes[0]) &&  is_scalar($itemRes[0])) {
                $res[$itemRes[0]] = $itemRes[1];
                continue;
            }
            $res[$key] = $itemRes;
        }
        return $res;
    }
}
