<?php
/**
 * Created by PhpStorm.
 * User: Sokolovsky
 * Date: 12.02.2015
 * Time: 17:37
 */

namespace WS\Tools\Cache;


use Bitrix\Main\Application;
use Bitrix\Main\Data\ICacheEngine;

abstract class Cache {
    private
        $_original,
        $_timeLive,
        $_key;

    private
        $_bxInitDir,
        $_bxBaseDir;

    /**
     * @param ICacheEngine $engine
     * @param $key
     * @param $timeLive
     */
    public function __construct(ICacheEngine $engine, $key, $timeLive) {
        $this->_original = $engine;
        $un = md5($key);
        $this->_key = "/".substr($un, 0, 2)."/".$un.".php";
        $this->_timeLive = $timeLive;
        $this->_bxBaseDir = "cache";
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
     * @return string
     */
    private function _baseDir() {
        $personalRoot = Application::getPersonalRoot();
        return $personalRoot."/".$this->_bxBaseDir."/";
    }

    /**
     * @return null
     */
    protected function read($isArray = false) {
        $value = $isArray ? array() : null;
        $this->_original->read($value, $this->_baseDir(), $this->_bxInitDir, $this->_key, $this->_timeLive);
        return $value;
    }

    /**
     * @param $value
     */
    protected function write($value) {
        $this->_original->write($value, $this->_baseDir(), $this->_bxInitDir, $this->_key, $this->_timeLive);
    }

    /**
     * Clear content
     * @return $this
     */
    public function clear() {
        $this->_original->clean($this->_baseDir(), $this->_bxInitDir, $this->_key);
        return $this;
    }

    public function isExpire() {
        return !$this->read();
    }
}