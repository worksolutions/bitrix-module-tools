<?php
/**
 * Created by PhpStorm.
 * User: Sokolovsky
 * Date: 12.02.2015
 * Time: 17:37
 */

namespace WS\Tools;


abstract class Cache {
    private
        $_original,
        $_timeLive,
        $_key;

    private
        $_bxInitDir,
        $_bxBaseDir;

    /**
     * @param \Bitrix\Main\Data\Cache $original
     * @param $key
     * @param $timeLive
     */
    public function __construct(\Bitrix\Main\Data\Cache $original, $key, $timeLive) {
        $this->_original = $original;
        $this->_key = $key;
        $this->_timeLive = $timeLive;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setBxInitDir($value) {
        $this->_bxInitDir = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setBxBaseDir($value) {
        $this->_bxBaseDir = $value;
        return $this;
    }

    /**
     * @return \Bitrix\Main\Data\Cache
     */
    protected function getOriginal() {
        return $this->_original;
    }

    protected function init() {
        return $this->getOriginal()->initCache($this->_timeLive, $this->_key, $this->_bxInitDir, $this->_bxBaseDir);
    }

    /**
     * Clear content
     * @return $this
     */
    public function clear() {
        $this->getOriginal()->clean($this->_key, $this->_bxInitDir, $this->_bxBaseDir);
        return $this;
    }

    public function isExpire() {
        return !$this->init();
    }
}