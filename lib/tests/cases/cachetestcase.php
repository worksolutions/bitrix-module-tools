<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Tests\Cases;

use WS\Tools\Module;
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

    /**
     * @return \WS\Tools\Cache\CacheManager
     */
    public function service() {
        return Module::getInstance()->cacheManager();
    }

    /**
     * use array cache
     */
    public function testArrayCache() {
        $cache = $this->service()->getArrayCache(__METHOD__, 1);
        $cache->set(array('data', 'key' => 'value'));
        $this->assertFalse($cache->isExpire(), $this->errorMessage('cache must be not expire'));
        $this->assertNotEmpty($cache->get(), $this->errorMessage('cache must be not empty'));
        $this->assertEquals($cache->get(), array('data', 'key' => 'value'), $this->errorMessage('bad stored data'));
        sleep(2);
        $this->assertTrue($cache->isExpire(), $this->errorMessage('cache must be expire'));
        $this->assertEmpty($cache->get(), $this->errorMessage('data must be empty'));

        $cache = $this->service()->getArrayCache(__METHOD__, 0);
        $cache->set(array('data'));
        $this->assertTrue($cache->isExpire(), $this->errorMessage('cache must be expire'));
    }

    /**
     * use content cache
     */
    public function testContentCache() {
        $cache = $this->service()->getContentCache(__METHOD__, 1);
        $string = 'comment string | n';

        $cache->record();
        echo $string;
        $cache->stop();

        $this->assertFalse($cache->isExpire(), $this->errorMessage('cache must be not expire'));
        $this->assertEquals($cache->content(), $string, $this->errorMessage('string not equals expected'));

        sleep(2);

        $this->assertTrue($cache->isExpire(), $this->errorMessage('cache must be expired'));
        $this->assertEmpty($cache->content());
    }
}
