<?php

namespace WS\Tools\ORM\Db\Filter;

/**
 * Filter for enum elements.
 *
 * @author my.sokolovsky@gmail.com
 */
class Enum extends Common {
    
    /**
     * Conditions - (Select all options for the field of entity)
     * @param string $entityClass  Entity Class
     * @param string $attribute    Property name
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
