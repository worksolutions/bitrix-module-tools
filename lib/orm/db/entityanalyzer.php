<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\ORM\Db;

use WS\Tools\Cache\ArrayCache;

class EntityAnalyzer {

    /**
     * @var string
     */
    private $class;
    /**
     * @var ArrayCache
     */
    private $cache;

    /**
     * @var array
     */
    private $params = array();

    private static $multiples = array(
        'property'
    );

    private $data;

    /**
     * @param $class
     * @param ArrayCache $cache
     */
    public function __construct($class, ArrayCache $cache) {
        $this->class = $class;
        $this->cache = $cache;
        $this->initParams();
    }

    public function initParams() {
        $refClass = new \ReflectionClass($this->class);

        $file = $refClass->getFileName();

        $modificationTime = filemtime($file);

        $cacheData = $this->cache->get();
        $cacheTime = $cacheData['time'];

        if (!$cacheTime || $modificationTime > $cacheTime) {
            $this->cache->clear();
            $cacheData = array();
        }

        if ($params = $cacheData['params']) {
            $this->params = $params;
            return ;
        }

        $docBlock = $refClass->getDocComment();
        // @property ClassName[] $name comment
        $strings =  preg_split('/[\r\n]+/', $docBlock, -1, PREG_SPLIT_NO_EMPTY);
        while ($string = array_shift($strings)) {
            $stringWords = array_values(array_filter(explode(' ', $string)));
            if ($stringWords[0] == '*') {
                array_shift($stringWords);
            }
            if (substr($stringWords[0], 0, 1) !== '@') {
                continue;
            }
            $name = substr($stringWords[0], 1);
            $first = $stringWords[1];
            $array = '';
            if (substr($first, -2) == '[]') {
                $array = '[]';
                $first = substr($first, 0, -2);
            }
            $second = $stringWords[2];
            $third = $stringWords[3];
            $lineData = array($first, $second, $array, $third);
            if (in_array($name, self::$multiples)) {
                $this->params[$name][] = $lineData;
                continue;
            }
            $this->params[$name] = $lineData;
        }

        $this->cache->set(array(
            'time' => $modificationTime,
            'params' => $this->params,
            'data' => $cacheData['data'] ?: array()
        ));
    }

    public function getClass() {
        return ltrim($this->class, '\\');
    }

    /**
     * @return string
     */
    public function gateway() {
        $line = $this->getParam('gateway');
        return $line[0];
    }

    /**
     * @param string $name
     * @param null $number
     * @return mixed
     */
    public function getParam($name, $number = null) {
        if (is_null($number)) {
            return $this->params[$name];
        }
        return $this->params[$name][$number - 1];
    }

    /**
     * @param $key
     * @param $value
     */
    public function setData($key, $value) {
        $this->data[$key] = $value;
        $cacheData = $this->cache->get();
        $cacheData['data'][$key] = $value;
        $this->cache->set($cacheData);
    }

    /**
     * @param $key
     * @param null $default
     * @return array
     */
    public function getData($key, $default = null) {
        if ($this->data[$key]) {
            return $this->data[$key];
        }
        $cacheData = $this->cache->get();
        $this->data = $cacheData['data'];
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }
        return $default;
    }

    public function getClassName($useName) {
        if (class_exists($useName)) {
            return $useName;
        }
        $ref = new \ReflectionClass($this->getClass());
        $namespace = $ref->getNamespaceName();
        if (class_exists($namespace.'\\'.$useName)) {
            return $namespace.'\\'.$useName;
        }
        return null;
    }
}