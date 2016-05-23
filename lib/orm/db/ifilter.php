<?php

namespace WS\Tools\ORM\Db;

/**
 * Query filter interface.
 * @author my.sokolovsky@gmail.com
 */
interface IFilter {
    /**
     * Attribute $attr, equal $value
     * @param string $attr
     * @param mixed $value
     * @return IFilter
     */
    public function equal($attr, $value);
    
    /**
     * Attribute $attr, not equl $value
     * @param string $attr
     * @param mixed $value
     * @return IFilter
     */
    public function notEqual($attr, $value);

    /**
     * Attribute $attr, less $value
     * @param string $attr
     * @param mixed $value
     * @return IFilter
     */
    public function less($attr, $value);

    /**
     * Attribute $attr, more $value
     * @param string $attr
     * @param mixed $value
     * @return IFilter
     */
    public function more($attr, $value);

    /**
     * Attribute $attr, less or equal $value
     * @param string $attr
     * @param mixed $value
     * @return IFilter
     */
    public function lessOrEqual($attr, $value);

    /**
     * Attribute $attr, more or equal $value
     * @param string $attr
     * @param mixed $value
     * @return IFilter
     */
    public function moreOrEqual($attr, $value);

    /**
     * Attribute $attr, in $values
     * @param string $attr
     * @param array $values
     * @return IFilter
     */
    public function in($attr, $values);

    /**
     * Attribute $attr, not in $values
     * @param string $attr
     * @param array $values
     * @return IFilter
     */
    public function notIn($attr, $values);

    /**
     * Attribute $attr, in range $from - $to
     * @param string $attr
     * @param mixed $from
     * @param mixed $to
     * @return IFilter
     */
    public function inRange($attr, $from, $to);

    /**
     * Attribute $attr, not in range $from - $to
     * @param string $attr
     * @param mixed $from
     * @param mixed $to
     * @return IFilter
     */
    public function notInRange($attr, $from, $to);
    
    /**
     * Attribute $attr, like $value
     * $value can be used with %, e.g. 'mos%', '%mos'
     * @param string $attr
     * @param string $value
     * @return IFilter
     */
    public function like($attr, $value);
}
