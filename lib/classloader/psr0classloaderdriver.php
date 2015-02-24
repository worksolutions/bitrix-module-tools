<?php
/**
 * @author Smotrov Dmitriy <smotrov@worksolutions.ru>
 */

namespace WS\Tools\ClassLoader;


class PSR0ClassLoaderDriver extends AbstractNamespaceToPathClassLoaderDriver {
    protected function loadByParams($path, $namespace, $className) {
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

        return true;
    }
}