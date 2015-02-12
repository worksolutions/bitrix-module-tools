<?php
/**
 * Created by PhpStorm.
 * User: Sokolovsky
 * Date: 12.02.2015
 * Time: 17:41
 */

namespace WS\Tools;


class ArrayCache extends Cache {

    /**
     * @return array
     */
    public function get() {
        $this->init();
        $this->getOriginal()->getVars();
    }

    /**
     * @param array $value
     * @return $this
     */
    public function set(array $value) {
        $this->init();
        $this->getOriginal()->startDataCache();
        $this->getOriginal()->endDataCache($value);
        return $this;
    }
}