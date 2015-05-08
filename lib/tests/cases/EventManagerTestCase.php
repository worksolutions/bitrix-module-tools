<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Tests\Cases;

use Bitrix\Main\Event;
use WS\Tools\Events\CustomHandler;
use WS\Tools\Events\EventType;
use WS\Tools\Module;
use WS\Tools\Tests\AbstractCase;

class TestHandler extends CustomHandler {
    private $history = array();

    public function identity() {
        $this->history[] = array('identity', $this->getLiveParams(), $this->eventParams());
        return true;
    }

    public function process() {
        $this->history[] = array('process', $this->getLiveParams(), $this->eventParams());
    }

    public function getHistory() {
        return $this->history;
    }
}

class TestReferenceHandler extends CustomHandler {

    public function processReference(& $one) {
        $one += 2;
    }
}

class EventManagerTestCase extends AbstractCase {

    public function name() {
        return $this->localization->message('name');
    }

    public function description() {
        return $this->localization->message('description');
    }

    /**
     * @return \WS\Tools\Events\EventsManager
     */
    public function manager() {
        return Module::getInstance()->eventManager();
    }

    public function testUseHandlerClassParams() {
        $eventType = EventType::createByParams("ws.tools", "test");

        $this->manager()->subscribe($eventType, $handler = new TestHandler(array('init params')));

        $this->manager()->trigger($eventType, array('process params'));

        $history = $handler->getHistory();

        $this->assertEquals(
            $history[0],
            array(
                'identity',
                array('init params'),
                array('process params')
            )
        );

        $this->assertEquals(
            $history[1],
            array(
                'process',
                array('init params'),
                array('process params')
            )
        );

        $this->manager()->trigger($eventType, array('process2 params'));

        $history = $handler->getHistory();

        $this->assertEquals(
            $history[3],
            array(
                'process',
                array('init params'),
                array('process2 params')
            )
        );

        $e = new Event("ws.tools", "test", array('process3 params'));
        $e->send($this);

        $history = $handler->getHistory();
        $this->assertEquals(
            $history[5],
            array(
                'process',
                array('init params'),
                array('process3 params')
            )
        );
    }

    public function testCallbackRun() {
        $eventType = EventType::createByParams("ws.tools", __METHOD__);

        $history = array();
        $this->manager()->subscribe($eventType, function ($params) use (& $history) {
            $history[] = $params;
        });

        $this->manager()->trigger($eventType, array('params'));

        $this->assertEquals(
            $history[0],
            array('params')
        );
    }

    public function testReferenceProcess() {
        $eventType = EventType::createByParams("ws.tools", __METHOD__);
        $first = 1;

        // subscribe, only one param by reference
        $this->manager()->subscribe($eventType, new TestReferenceHandler());
        $this->manager()->subscribe($eventType, function (& $one) {
            $one += 1;
        });

        // process
        $events = GetModuleEvents($eventType->getModule(), $eventType->getSubject(), true);
        foreach ($events as $arEvent) {
            ExecuteModuleEventEx($arEvent, array(& $first));
        }

        // test
        $this->assertEquals($first, 4);
    }
}
