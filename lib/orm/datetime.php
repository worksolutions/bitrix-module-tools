<?php

namespace WS\Tools\ORM;

/**
 * Extends DateTime class (uses bitrix benefits)
 *
 * @author my.sokolovsky@gmail.com
 */
class DateTime extends \DateTime {

    public static function className() {
        return get_called_class();
    }

    /**
     * Format date to $format, can set current timestamp.
     * @link http://dev.1c-bitrix.ru/api_help/main/functions/date/formatdate.php
     */
    public function bxFormat($format, $now = false) {
        return \FormatDate($format, $this->getTimestamp(), $now);
    }

    public function toSiteDbFormat() {
        return $this->bxFormat("FULL");
    }

    public function filterPropertyFormat($useTime = false) {
        return $useTime ? $this->format('Y-m-d H:i:s') : $this->format('Y-m-d');
    }
}
