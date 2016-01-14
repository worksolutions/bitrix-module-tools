<?php

namespace WS\Tools\ORM;

/**
 * –асширенный класс работы с датой/временем (использование приемуществ битрикса)
 *
 * @author ћаксим —околовский (my.sokolovsky@gmail.com)
 */
class DateTime extends \DateTime {

    public static function className() {
        return get_called_class();
    }

    /**
     * ¬ывод даты в формате $format, возможно использование установки текущей метки времени.
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
