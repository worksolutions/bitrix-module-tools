<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Events;

/**
 * Class CustomHandler
 * @package WS\Tools\Events
 * @method processReference()
 */
abstract class CustomHandler {
    private $_params = array();

    public function __construct($params = array()) {
        $this->_params = $params;
    }

    public function __invoke(& $param0, & $param1, & $param2) {
        $this->addParams($args = func_get_args());
        if (!$this->identity()) {
            return true;
        }
        if (method_exists($this, 'processReference')) {
            $reflection = new \ReflectionMethod($this, 'processReference');
            $refParams = array_filter($reflection->getParameters(), function (\ReflectionParameter $p) {
                return $p->isPassedByReference();
            });

            /** @var \ReflectionParameter $refParam */
            foreach ($refParams as $refParam) {
                $args[$refParam->getPosition()] = & ${'param'.$refParam->getPosition()};
            }
            $res = call_user_func_array(array($this, 'processReference'), $args);
        } else {
            $res = $this->process();
        }
        return $res;
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
    public function process() {
        throw new \Exception('Need override this method or `processReference` '.__METHOD__);
    }
}

