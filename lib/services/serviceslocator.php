<?php
namespace WS\Tools\Services;

/**
 * Class ServicesLocator
 * @package WS\Tools\Services
 */
class ServicesLocator {

    private $_config = array(),
        $_instances = array();

    public function __construct(array $config = array()) {
        $this->_config = $config;
    }

    /**
     * Additional config
     * @param array $config
     * @return $this
     */
    public function configure($config = array()) {
        $this->_config = array_merge($this->_config, $config);
        return $this;
    }

    /**
     * @param $name
     * @param $params
     * @param array $depends
     * @return $this
     */
    public function set($name, $params, $depends = array()) {
        $class = $params['class'] ?: $name;
        unset($params['class']);
        $this->_config[$name] = array(
            'class' => $class,
            'params' => $params,
            'depends' => $depends
        );
        return $this;
    }

    /**
     * @param $name
     * @param $object
     * @return $this
     */
    public function willUse($name, $object) {
        $this->_instances[$name] = $object;
        return $this;
    }

    /**
     * Getting object, lazy load is used. Object will create once.
     * @param $name
     * @return mixed
     * @throws \Exception
     */
    public function get($name) {
        if (!$this->_instances[$name]) {
            $this->_instances[$name] = $this->createInstance($name);
        }
        return $this->_instances[$name];
    }

    /**
     * Create object. Object will create by each call
     * @param string $name
     * @return mixed
     * @throws \Exception
     */
    public function createInstance($name, $params = array(), $depends = array()) {
        if (!$this->_config[$name] && !class_exists($name)) {
            throw new \Exception("Instance of $name imposable");
        }

        $config = $this->_config[$name] ?: array();

        $class = $config['class'] ?: $name;
        $params = $config['params'] ?: $params ?: array();
        $depends = $config['depends'] ?: $depends ?: array();

        $instances = array();
        $values = array();
        foreach ($depends as $dependName) {
            $values[$dependName] = $dependInstance = $this->get($dependName);
            $instances[get_class($dependInstance)] = $dependInstance;
        }
        $values = array_merge($params, $values);

        // class discovery
        $refClass = new \ReflectionClass($class);
        $constructParams = array();
        if ($refClass->hasMethod('__construct')) {
            $constructor = $refClass->getMethod('__construct');
            foreach ($constructor->getParameters() as $cParameter) {
                $cParamValue = null;
                $cParameter->getDeclaringClass() && $cParamValue = $instances[$cParameter->getDeclaringClass()->getName()];
                $values[$cParameter->getName()] && $cParamValue = $values[$cParameter->getName()];
                $constructParams[] = $cParamValue;
            }
        }
        $object = $refClass->newInstanceArgs($constructParams);

        foreach ($refClass->getProperties() as $property) {
            if ($property->isStatic() || $property->isPrivate()) {
                continue;
            }
            if (! $value = $values[$property->getName()]) {
                continue;
            }
            $property->isProtected() && $property->setAccessible(true);
            $property->setValue($object, $value);
            $property->isProtected() && $property->setAccessible(false);
        }
        return $object;
    }
}
