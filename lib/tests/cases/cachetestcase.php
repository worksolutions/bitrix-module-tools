<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Tests\Cases;

use WS\Tools\Tests\AbstractCase;

class CacheTestCase extends AbstractCase {

    public function name() {
        return $this->localization->message('name');
    }

    public function description() {
        return $this->localization->message('description');
    }

    public function init() {
    }


    public function testTest() {
    }
}