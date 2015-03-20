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
         * @param \ReflectionParameter[] $parameters
         * @return bool|array of positions
         */
        $isReference = function (array $parameters) {
            $first = array_shift($parameters);
            /** @var \ReflectionParameter $first */
            return $first && $first->isPassedByReference();
        };

        //processing reference params
        $reference = false;
        if (!$handlerType && is_string($handler) && function_exists($handler)) {
            $handlerType = 'function';
            $reflection = new \ReflectionFunction($handler);
            $reference = $isReference($reflection->getParameters());
        }
        if (!$handlerType && $handler instanceof \Closure) {
            $handlerType = 'closure';
            $reflection = new \ReflectionFunction($handler);
            $reference = $isReference($reflection->getParameters());
        }
        if (!$handlerType && is_object($handler) && method_exists($handler, 'processReference')) {
            $handlerType = 'invoke reference';
            $reference = true;
        }
        if (!$handlerType && is_object($handler)) {
            $handlerType = 'invoke';
            $reference = false;
        }
        if (!$handlerType && is_array($handler) && class_exists($handler[0]) && method_exists($handler[0], $handler[1])) {
            $handlerType = 'class static method';
            $reflection = new \ReflectionMethod($handler[0], $handler[1]);
            $reference = $isReference($reflection->getParameters());
        }
        if (!$handlerType) {
            throw new \Exception("Subscribe by event " . $eventType->getSubject()." handler not correct");
        }

        $wrapper = function () use ($self, $eventType, $handler) {
            $self->registerCall($eventType);
            return call_user_func_array($handler, func_get_args());
        };

        $reference && $wrapperLink = function (& $linkParam) use ($self, $eventType, $handler, $reference) {
            $self->registerCall($eventType);
            $args = func_get_args();
            array_shift($args);
            $params[] = & $linkParam;
            foreach ($args as $arg) {
                $params[] = $arg;
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