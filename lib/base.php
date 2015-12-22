<?php

namespace WS\Tools;

/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

class Base {
    static public function className () {
        return get_called_class();
    }
}