<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Tests\Cases;


use WS\Tools\BaseAgent;
use WS\Tools\Tests\AbstractCase;

class TestAgent extends BaseAgent {
    private $a, $b, $c;

    public function __construct($a, $b, $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $b;
    }

    /**
     * Run agent function
     *
     * @return array Params next call
     */
    public function algorithm() {
        return array($this->a + 10, $this->b .' string', array(2, 4));
    }
}

class AgentRunTestCase extends AbstractCase {

    public function name() {
        return $this->localization->message('name');
    }

    public function description() {
        return $this->localization->message('name');
    }

    public function testClassDetermination() {
        $result = TestAgent::run(1, 13);
        $this->assertEquals($result, 'WS\\Tools\\Tests\\Cases\\TestAgent::run(11, \'13 string\', \'param need throw as scalar\');');
    }
}