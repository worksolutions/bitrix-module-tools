<?php
/**
 * @author Smotrov Dmitriy <smotrov@worksolutions.ru>
 */

namespace WS\Tools\ClassLoader;


interface ClassLoaderDriverInterface {
    public function load($className);

    public function configure($value);
}