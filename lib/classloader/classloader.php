<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\ClassLoader;

use Bitrix\Main\LoaderException;

class ClassLoader {
    /** @var ClassLoaderDriverInterface[] */
    protected $drivers = array();

    public function __construct($options = array()) {
        if (!function_exists('spl_autoload_register')) {
            throw new LoaderException('function `spl_autoload_register` not exists');
        }

        $options['drivers'] && $this->drivers = $options['drivers'];

        \spl_autoload_register(array($this, 'load'));
    }

    public function configure($drivers) {
        foreach ($drivers as $name => $driverConfig) {
            $driver = $this->getDriver($name);
            $driver->configure($driverConfig);
        }
    }

    /**
     * Run load class by name
     * @param $className
     * @return bool
     */
    public function load($className) {
        foreach ($this->drivers as $driver) {
            if ($driver->load($className)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $name
     * @return ClassLoaderDriverInterface|AbstractNamespaceToPathClassLoaderDriver
     */
    public function getDriver($name) {
        return $this->drivers[$name];
    }
}