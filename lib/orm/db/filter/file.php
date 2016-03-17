<?php

namespace WS\Tools\ORM\Db\Filter;

use WS\Tools\ORM\Db\Filter;

/**
 * Filter for BitrixEntity_File
 *
 * @author my.sokolovsky@gmail.com
 */
class File extends Filter {

    private function createNotSupportedException() {
        return new \Exception("Method is not supported class filter `".get_class($this)."`");
    }

    public function inRange($attr, $from, $to) {
        throw $this->createNotSupportedException();
    }

    public function notInRange($attr, $from, $to) {
        throw $this->createNotSupportedException();
    }

    public function equal($attr, $value) {
        return $this->addCondition($attr, '', $value);
    }

    public function in($attr, $values) {
        $values = implode(', ', $values);
        return $this->addCondition($attr, '@', $values);
    }

    public function less($attr, $value) {
        throw $this->createNotSupportedException();
    }

    public function lessOrEqual($attr, $value) {
        throw $this->createNotSupportedException();
    }

    public function more($attr, $value) {
        throw $this->createNotSupportedException();
    }

    public function moreOrEqual($attr, $value) {
        throw $this->createNotSupportedException();
    }

    public function notEqual($attr, $value) {
        throw $this->createNotSupportedException();
    }

    public function notIn($attr, $values) {
        throw $this->createNotSupportedException();
    }
}
