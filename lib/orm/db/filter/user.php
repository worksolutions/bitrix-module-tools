<?php

namespace WS\Tools\ORM\Db\Filter;

/**
 * Filter selection list items.
 *
 * @author my.sokolovsky@gmail.com
 */
class User extends Common {
    
    protected function addCondition($attr, $operator, $value) {
        if ($operator == '=') {
            $operator = '';
            is_array($value) && $value = implode('|', array_filter($value));
        }
        return parent::addCondition($attr, $operator, $value);
    }
}
