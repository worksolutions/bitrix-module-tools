<?php
/**
 * Created by PhpStorm.
 * User: Sokolovsky
 * Date: 12.02.2015
 * Time: 17:41
 */

namespace WS\Tools\Cache;


class ArrayCache extends Cache {
    
    private $fastData;
    private $useFastData = false;

    public function useFastData() {
        $this->useFastData = true;
    }

    /**
     * @return array
     */
    public function get() {
        if ($this->useFastData) {
            return $this->fastData;
        }
        return $this->read(true);
    }

    /**
     * @param array $value
     * @return $this
     */
    public function set(array $value) {
        if ($this->useFastData) {
            $this->fastData = $value;
        }
        $this->write($value);
        return $this;
    }

    public function isExpire() {
        return !$this->get();
    }
}
