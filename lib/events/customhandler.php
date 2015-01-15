<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Events;

/**
 * Class CustomHandler
 * @package WS\Tools\Events
 */
abstract class CustomHandler {
    private $_params = array();

    public function __construct($params = array()) {
        $this->_params = $params;
    }

    public function __invoke() {
        $this->addParams(func_get_args());
        if (!$this->identity()) {
            return false;
        }
        return $this->process();
    }

    /**
     * @return array
     */
    public function getParams() {
        return $this->_params;
    }

    /**
     * @param array $params
     */
    public function addParams($params) {
        $this->_params = array_merge($this->_params, $params);
    }

    /**
     * Identity by hand
     * @return bool
     */
    public function identity() {
        return true;
    }

    /**
     * Run hand
     * @return mixed
     */
    abstract public function process();
}

