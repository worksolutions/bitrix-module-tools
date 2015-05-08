<?php
/**
 * Created by PhpStorm.
 * User: Sokolovsky
 * Date: 12.02.2015
 * Time: 17:41
 */

namespace WS\Tools\Cache;


class ArrayCache extends Cache {

    /**
     * @return array
     */
    public function get() {
        return $this->read(true);
    }

    /**
     * @param array $value
     * @return $this
     */
    public function set(array $value) {
        $this->write($value);
        return $this;
    }

    public function isExpire() {
        return !$this->get();
    }
}