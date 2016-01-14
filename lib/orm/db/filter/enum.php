<?php

namespace WS\Tools\ORM\Db\Filter;

/**
 * Фильтр выбора элементов списка.
 *
 * @author Максим Соколовский (my.sokolovsky@gmail.com)
 */
class Enum extends Common {
    
    /**
     * Условия фильтра - (Выбрать все возможные варианты для поля сущности)
     * @param string $entityClass  Класс сущности
     * @param string $attribute    Имя свойства сущности
     * @return Enum
     */
    public function forEntityProperty($entityClass, $attribute) {
        return $this->addCondition($entityClass, '#', $attribute);
    }

    protected function addCondition($attr, $operator, $value) {
        if ($operator == '=') {
            $operator = '';
        }
        return parent::addCondition($attr, $operator, $value);
    }
}
