<?php
/**
 * Created by PhpStorm.
 * User: Sokolovsky
 * Date: 12.02.2015
 * Time: 17:18
 */

namespace WS\Tools\Cache;

use Bitrix\Main\Data\CacheEngineFiles;
use Bitrix\Main\Data\ICacheEngine;

/**
 * Class CacheManager
 * @package WS\Tools\Cache
 */
class CacheManager {

    private $_defaultEngine, $_nextEngine;

    private $_bxInitDir, $_bxBaseDir;

    public function __construct($options = array()) {
        $options['engine'] && $this->useEngine($options['engine']);
        !$options['engine'] && $this->useEngine(new CacheEngineFiles());

        $this->_bxInitDir = $options['bxInitDir'];
        $this->_bxBaseDir = $options['bxBaseDir'];
    }

    /**
     * Once use engine
     * @param ICacheEngine $object
     * @return $this
     */
    public function useEngine(ICacheEngine $object) {
        if (!$this->_defaultEngine) {
            $this->_defaultEngine = $object;
        } else {
            $this->_nextEngine = $object;
        }
        return $this;
    }

    /**
     * @return ICacheEngine
     */
    private function _engine() {
        $object = $this->_nextEngine ?: $this->_defaultEngine;
        $this->_nextEngine = null;
        return $object;
    }

    /**
     * @param $key
     * @param int $timeLive
     * @return ContentCache
     */
    public function getContentCache($key, $timeLive = 3600) {
        return new ContentCache($this->_engine(), $key, $timeLive);
    }

    /**
     * @param $key
     * @param int $timeLive
     * @return ArrayCache
     */
    public function getArrayCache($key, $timeLive = 3600) {
        return new ArrayCache($this->_engine(), $key, $timeLive);
    }
}
