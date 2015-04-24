<?php

namespace WS\Tools\Mail;

/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

class MailPackage {

    /**
     * @var array
     */
    private $fields;

    /**
     * @var string
     */
    private $eventName;

    /**
     * @var int
     */
    private $getMessageId;

    /**
     * @param $eventName
     */
    public function __construct($eventName){
        $this->eventName = $eventName;
    }

    /**
     * @return MailPackage
     */
    public function copy() {
        return clone $this;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function setField($name, $value) {
        $this->fields[$name] = $value;
        return $this;
    }

    /**
     * @param $values
     * @return $this
     */
    public function setFields($values) {
        $this->fields = array_merge($this->getFields(), $values);
        return $this;
    }

    /**
     * @return array
     */
    public function getFields() {
        return $this->fields ?: array();
    }

    /**
     * @return string
     */
    public function getEventName() {
        return $this->eventName;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setMessageId($value) {
        $this->getMessageId = $value;
        return $this;
    }

    /**
     * @return int
     */
    public function getMessageId() {
        return $this->getMessageId;
    }
}