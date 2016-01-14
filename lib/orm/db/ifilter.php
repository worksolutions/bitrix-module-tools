<?php

namespace WS\Tools\ORM\Db;

/**
 * Интерфейс использования фильтра запроса.
 * @author Максим Соколовский (my.sokolovsky@gmail.com)
 */
interface IFilter {
    /**
     * Аттрибут $attr, равен $value
     * @param string $attr
     * @param mixed $value
     * @return IFilter
     */
    public function equal($attr, $value);
    
    /**
     * Аттрибут $attr, не равен $value
     * @param string $attr
     * @param mixed $value
     * @return IFilter
     */
    public function notEqual($attr, $value);

    /**
     * Аттрибут $attr, меньше $value
     * @param string $attr
     * @param mixed $value
     * @return IFilter
     */
    public function less($attr, $value);

    /**
     * Аттрибут $attr, больше $value
     * @param string $attr
     * @param mixed $value
     * @return IFilter
     */
    public function more($attr, $value);

    /**
     * Аттрибут $attr, больше или равен $value
     * @param string $attr
     * @param mixed $value
     * @return IFilter
     */
    public function lessOrEqual($attr, $value);

    /**
     * Аттрибут $attr, меньше или равен $value
     * @param string $attr
     * @param mixed $value
     * @return IFilter
     */
    public function moreOrEqual($attr, $value);

    /**
     * Аттрибут $attr, находится во множестве $values
     * @param string $attr
     * @param array $values
     * @return IFilter
     */
    public function in($attr, $values);

    /**
     * Аттрибут $attr, не находится во множестве $values
     * @param string $attr
     * @param array $values
     * @return IFilter
     */
    public function notIn($attr, $values);

    /**
     * Аттрибут $attr, нахадоится в диапозоне от $from до $to
     * @param string $attr
     * @param mixed $from
     * @param mixed $to
     * @return IFilter
     */
    public function inRange($attr, $from, $to);

    /**
     * Аттрибут $attr, не нахадоится в диапозоне от $from до $to
     * @param string $attr
     * @param mixed $from
     * @param mixed $to
     * @return IFilter
     */
    public function notInRange($attr, $from, $to);

}
