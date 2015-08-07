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

    private $original;
    private $timeLive;
    private $key;

    private
        $bxInitDir,
        $bxBaseDir;

    /**
     * @param ICacheEngine $engine
     * @param $key
     * @param $timeLive
     */
    public function __construct(ICacheEngine $engine, $key, $timeLive) {
        $this->original = $engine;
        $un = md5($key);
        $this->key = "/".substr($un, 0, 2)."/".$un.".php";
        $this->timeLive = $timeLive;
        $this->bxBaseDir = "cache";
    }

    /**
     * @param $value
     * @return $this
     */
    public function setBxInitDir($value) {
        $this->bxInitDir = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setBxBaseDir($value) {
        $this->bxBaseDir = $value;
        return $this;
    }

    /**
     * @return string
     */
    private function baseDir() {
        $personalRoot = Application::getPersonalRoot();
        return $personalRoot."/".$this->bxBaseDir."/";
    }

    /**
     * @param bool $isArray
     * @return null
     */
    protected function read($isArray = false) {
        $value = $isArray ? array() : null;
        if (\Bitrix\Main\Data\Cache::shouldClearCache()) {
            $this->clear();
        }
        $this->timeLive && $this->original->read($value, $this->baseDir(), $this->bxInitDir, $this->key, $this->timeLive);
        return $value;
    }

    /**
     * @param $value
     */
    protected function write($value) {
        $this->original->write($value, $this->baseDir(), $this->bxInitDir, $this->key, $this->timeLive);
    }

    /**
     * Clear content
     * @return $this
     */
    public function clear() {
        $this->original->clean($this->baseDir(), $this->bxInitDir, $this->key);
        return $this;
    }

    /**
     * @return bool
     */
    public function isExpire() {
        return !$this->read();
    }
}