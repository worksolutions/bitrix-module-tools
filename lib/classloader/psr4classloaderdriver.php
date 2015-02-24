<?php
/**
 * @author Smotrov Dmitriy <smotrov@worksolutions.ru>
 */

namespace WS\Tools\ClassLoader;


class PSR4ClassLoaderDriver extends AbstractNamespaceToPathClassLoaderDriver {
    protected function loadByParams($path, $namespace, $className) {
        $file = str_replace($namespace, '', $className);
        $file = trim($file, '\\');
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);
        $file = $path . DIRECTORY_SEPARATOR . $file . '.php';

        if (!is_file($file)) {
            return false;
        }

        include $file;

        return true;
    }
}