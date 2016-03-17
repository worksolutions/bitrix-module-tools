<?php

namespace WS\Tools\ORM\Db\Filter;

use WS\Tools\ORM\Db\Filter;

/**
 * Extended definition
 *
 * @author my.sokolovsky@gmail.com
 */
class Common extends Filter {
    
    public function inRange($attr, $from, $to) {
        $this->lessOrEqual($attr, $to);
        $this->moreOrEqual($attr, $from);
        return $this;
    }

    public function notInRange($attr, $from, $to) {
        $this->lessOrEqual($attr, $from);
        $this->moreOrEqual($attr, $to);
        return $this;
    }
}
