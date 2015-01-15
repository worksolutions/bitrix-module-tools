<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Events;


class EventType {

    const MAIN_PAGE_START = 'main-page-start';

    static $params = array(
        self::MAIN_PAGE_START => array('main', 'OnPageStart')
    );

    private $_module, $_subject;

    /**
     * @param $module
     * @param $subject
     * @throws \Exception
     */
    private function __construct($module, $subject) {
        if (!$module || !$subject) {
            throw new \Exception("Params not exists");
        }
        $this->_module = $module;
        $this->_subject = $subject;
    }

    /**
     * @param $code
     * @throws \Exception
     */
    static public function create($code) {
        $params = static::$params[$code];
        if (!$params) {
            throw new \Exception();
        }
    }

    /**
     * @param $module
     * @param $subject
     * @return static
     */
    static public function createByParams($module, $subject) {
        return new static($module, $subject);
    }

    /**
     * @return string
     */
    public function getModule() {
        return $this->_module;
    }

    /**
     * @return string
     */
    public function getSubject() {
        return $this->_subject;
    }
}
