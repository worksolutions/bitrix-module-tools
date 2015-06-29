<?php
/**
 * @author Smotrov Dmitriy <smotrov@worksolutions.ru>
 */

namespace WS\Tools\ClassLoader;


use Bitrix\Main\LoaderException;

abstract class AbstractNamespaceToPathClassLoaderDriver implements ClassLoaderDriverInterface{
    private $_namespacesToPaths = array();

    const NAMESPACE_SEPARATOR = "\\";

    public function load($className) {
        $className = self::NAMESPACE_SEPARATOR . ltrim($className, self::NAMESPACE_SEPARATOR);

        foreach ($this->_namespacesToPaths as $namespace => $paths) {
            $namespace = self::NAMESPACE_SEPARATOR . ltrim($namespace, self::NAMESPACE_SEPARATOR);

            if (strpos($className, $namespace) !== 0) {
                continue;
            }

            if (!is_array($paths)) {
                $paths = array($paths);
            }

            foreach ($paths as $path) {
                if ($this->loadByParams($path, $namespace, $className)) {
                    return true;
                }
            }
        }

        return false;
    }

    public function registerPathByNamespace($path, $namespace = null) {
        if (is_null($namespace)) {
            $namespace = self::NAMESPACE_SEPARATOR;
        }

        if (substr($namespace, -1, 1) !== self::NAMESPACE_SEPARATOR) {
            throw new LoaderException("namespace `$namespace` must be ends by \\");
        }

        if (!is_dir($path)) {
            throw new LoaderException("path `$path` to load not exists");
        }

        $this->_namespacesToPaths[$namespace][] = $path;
    }

    public function configure($value) {
        $this->_namespacesToPaths = $value;
    }

    abstract protected function loadByParams($path, $namespace, $className);
}