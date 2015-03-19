<?php

namespace WS\Tools\Events;
use Bitrix\Main\Event;
use Bitrix\Main\EventManager;

/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

class EventsManager {

    private $_calls = array();

    /**
     * @param EventType $eventType
     * @param $handler
     * @return int Handler Identifier
     * @throws \Exception
     */
    public function subscribe(EventType $eventType, $handler) {
        $self = $this;

        $handlerType = false;
        /**
         * @param array $parameters
         * @return bool|array of positions
         */
        $functionParamsReference = function (array $parameters) {
            $res = array();
            /** @var \ReflectionParameter $param */
            foreach ($parameters as $param) {
                $param->isPassedByReference() && $res[] = $param->getPosition();
            }
            return $res ?: false;
        };

        //processing reference params
        $referenceParams = array();
        if (!$handlerType && is_string($handler) && function_exists($handler)) {
            $handlerType = 'function';
            $reflection = new \ReflectionFunction($handler);
            $referenceParams = $functionParamsReference($reflection->getParameters());
        }
        if (!$handlerType && $handler instanceof \Closure) {
            $handlerType = 'closure';
            $reflection = new \ReflectionFunction($handler);
            $referenceParams = $functionParamsReference($reflection->getParameters());
        }
        if (!$handlerType && is_object($handler) && method_exists($handler, '__invoke')) {
            $handlerType = 'invokable';
            // for invoke
            $referenceParams = array(0,1,2);
        }
        if (!$handlerType && is_array($handler) && class_exists($handler[0]) && method_exists($handler[0], $handler[1])) {
            $handlerType = 'class static method';
            $reflection = new \ReflectionMethod($handler[0], $handler[1]);
            $referenceParams = $functionParamsReference($reflection->getParameters());
        }
        if (!$handlerType) {
            throw new \Exception("Subscribe by event " . $eventType->getSubject()." handler not correct");
        }

        $wrapper = function () use ($self, $eventType, $handler) {
            $self->registerCall($eventType);
            return call_user_func_array($handler, func_get_args());
        };
        $referenceParams && $wrapperLink = function (& $param0, & $param1, & $param2, & $param3, & $param4) use ($self, $eventType, $handler, $referenceParams) {
            $self->registerCall($eventType);
            $args = func_get_args();
            $num = 0;
            $params = array();
            foreach ($args as $arg) {
                if (in_array($num, $referenceParams)) {
                    $params[] = & ${'param'.$num};
                } else {
                    $params[] = $arg;
                }
                $num++;
            }
            return call_user_func_array($handler, $params);
        };
        return $this->vendorManager()->addEventHandler($eventType->getModule(), $eventType->getSubject(), $wrapperLink ?: $wrapper);
    }

    /**
     * @param EventType $eventType
     * @param array $params
     * @param null $sender
     * @return Event
     */
    public function trigger(EventType $eventType, $params, $sender = null) {
        $event = new Event($eventType->getModule(), $eventType->getSubject(), $params);
        $event->send($sender);
        return $event;
    }

    /**
     * @param EventType $eventType
     * @return array
     */
    public function getSubscribers(EventType $eventType) {
        return $this->vendorManager()->findEventHandlers($eventType->getModule(), $eventType->getSubject());
    }

    /**
     * @return array
     */
    public function getCalls() {
        return $this->_calls;
    }

    /**
     * @param EventType $eventType
     */
    public function registerCall(EventType $eventType) {
        $this->_calls[] = $eventType->getModule().' '.$eventType->getSubject();
    }

    /**
     * @return EventManager
     */
    public function vendorManager() {
        return EventManager::getInstance();
    }
}