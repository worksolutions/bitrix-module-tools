<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Events;

use Bitrix\Main\Event;

/**
 * Class CustomHandler
 * @package WS\Tools\Events
 * @method processReference()
 */
abstract class CustomHandler {
    private $liveParams = array();

    private $processParams = array();

    public function __construct($params = array()) {
        $this->liveParams = $params;
    }

    public function __invoke() {
        $this->processParams = $args = func_get_args();
        if (!$this->identity()) {
            return true;
        }
        return $this->process();
    }

    /**
     * @return array
     */
    public function getParams() {
        return $this->processParams;
    }

    /**
     * @param array $params
     */
    public function addParams($params) {
        $this->processParams = array_merge($this->processParams, $params);
    }

    /**
     * @return array
     */
    public function getLiveParam($key) {
        return $this->liveParams[$key];
    }

    /**
     * @return array
     */
    public function getLiveParams(){
        return $this->liveParams;
    }

    /**
     * @param $key
     * @param $value
     */
    public function addLiveParam($key, $value) {
        $this->liveParams[$key] = $value;
    }

    /**
     * Identity by hand
     * @return bool
     */
    public function identity() {
        return true;
    }

    /**
     * @return array|null
     */
    protected function eventParams() {
        $event = $this->getEvent();
        return $event ? $event->getParameters() : null;
    }

    /**
     * @return mixed
     */
    protected function eventSender() {
        $event = $this->getEvent();
        return $event ? $event->getSender() : null;
    }

    /**
     * @return Event|null
     */
    protected function getEvent() {
        $params = $this->getParams();
        foreach ($params as $param) {
            if ($param instanceof Event) {
                return $param;
            }
        }
        return null;
    }

    /**
     * Run hand
     * @return mixed
     * @throws \Exception
     */
    public function process() {
        throw new \Exception('Need override this method or `processReference` '.__METHOD__);
    }
}
