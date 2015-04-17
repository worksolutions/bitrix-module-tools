<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools;

/**
 * Class BaseAgent
 *
 * @package WS\Tools
 */
abstract class BaseAgent {

    /**
     * Run agent function
     * @return array Params next call
     */
    abstract static public function algorithm();

    /**
     * Returns string to agent call
     * @param array $params
     * @return string
     */
    static public function executeString($params = array()) {
        $params = array_map(function ($param) {
            $res = $param;
            if (!is_scalar($param)) {
                $param = "param need throw as scalar";
            }
            if (is_string($param)) {
                $res = "'$param'";
            }
            return $res;
        }, $params);
        $class = get_called_class();
        return $class.'::run('.implode(', ', $params).');';
    }

    /**
     * Interface by run subclass agent
     * @return string
     */
    static public function run() {
        try {
            $calledClass = get_called_class();
            $params = $calledClass::algorithm(func_get_args()) ?: array();
            return $calledClass::executeString($params);
        } catch (\Exception $e) {
            return '';
        }
    }
}