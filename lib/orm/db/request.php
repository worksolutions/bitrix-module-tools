<?php

namespace WS\Tools\ORM\Db;

/**
 * DbRequest definition
 *
 * @author my.sokolovsky@gmail.com
 */
abstract class Request {
    
    private static $filterMethods = array(
        'less', 'more', 'inRange', 'in', 'notIn',
        'equal', 'notEqual', 'moreOrEqual', 'lessOrEqual',
        'hasSubstr', 'forEntityProperty', 'logicOr'
    );

    /**
     * @var Gateway
     */
    protected $gateway;
    
    /**
     * @var Filter
     */
    private $filter;

    public function __construct(Gateway $gateway) {
        $this->gateway = $gateway;
    }
    
    /**
     * Self filter installation, on your own risk.
     * 
     * If filter is array,
     * then query methods related to filtration
     * cease to work.
     * 
     * @param Filter|array $filter
     * @return Request
     */
    public function setFilter($filter) {
        $this->filter = $filter;
        return $this;
    }
    
    /**
     * Getting filter array for child classes.
     * @return array
     */
    protected function getFilter() {
        if (is_object($this->_getFilter())) {
            return $this->_getFilter()->toArray();
        }
        return $this->_getFilter();
    }
    
    /**
     * @return Filter
     */
    protected function _getFilter() {
        if (is_null($this->filter)) {
            $this->filter = $this->gateway->createFilter();
        }
        return $this->filter;
    }
    
    /**
     * @param string $name
     * @return boolean
     */
    protected function isFilterMethod($name) {
        $methods = array_flip(self::$filterMethods);
        return isset($methods[$name]);
    }
    
    public function __call($methName, $arguments) {
        if ($this->isFilterMethod($methName) && is_object($this->_getFilter()) && $this->_getFilter() instanceof Filter) {
            if (method_exists($this->_getFilter(), $methName)) {
                call_user_func_array(array($this->_getFilter(), $methName), $arguments);
                return $this;
            }
            throw new \Exception("Method `$methName` not exists in gateway filter `".  get_class($this->gateway) ."`");
        }
        throw new \Exception("Method `$methName` not exists");
    }

    /**
     * The method for execute query, the result depends on the type of request
     */
    abstract public function execute();
}
