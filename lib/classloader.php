<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools;

use Bitrix\Main\LoaderException;

class ClassLoader {
    private $_folderPaths = array();

    private function __construct() {
        if (!function_exists('spl_autoload_register')) {
            throw new LoaderException('function `spl_autoload_register` not exists');
        }
        spl_autoload_register(array(self::getInstance(), 'load'));
    }

    /**
     * @return static
     */
    static public function getInstance() {
        static $self;
        if ($self === null) {
            $self = new static;
        }
        return $self;
    }

    /**
     * Register folder by load.
     * The location of the classes in the directory {namespace}/ClassName.php
     * @param $path
     * @throws LoaderException
     */
    public function registerFolder($path) {
        if (!is_dir($path)) {
            throw new LoaderException("path `$path` to load not exists");
        }
        $this->_folderPaths[] = $path;
    }

    /**
     * Load class by path
     * @param $path
     * @param $className
     * @return bool
     */
    static public function loadByPath($path, $className) {
        $parts = explode('\\', $className);
        if (!$parts[0]) {
            array_shift($parts);
        }
        array_unshift($parts, $path);
        $baseClassName = array_pop($parts);
        $baseClassName .= '.php';
        array_push($parts, $baseClassName);
        $file = implode(DIRECTORY_SEPARATOR, $parts);
        if (!is_file($file)) {
            return false;
        }
        include $file;
    }

    /**
     * Run load class by name
     * @param $className
     * @return bool
     */
    public function load($className) {
        foreach ($this->_folderPaths as $path) {
            if (static::loadByPath($path, $className)) {
                return true;
            }
        }
        return false;
    }
}