<?php
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

namespace WS\Tools;


class Localization {

    /**
     * @var Options
     */
    private $data;

    public function __construct($data) {
        $this->data = new Options($data);
    }

    /**
     * @param $path
     * @return array
     */
    public function getDataByPath($path) {
        return $this->getData()->get($path);
    }

    /**
     * @return Options
     */
    private function getData() {
        if(!$this->data) {
            $this->data = new Options();
        }

        return $this->data;
    }

    /**
     * @param string $path @see Options
     * @param array $replace
     * @return mixed
     */
    public function message($path, $replace = null) {
        $m = $this->getData()->get($path, '');
        $result = $m ?: $path;
        if (is_array($replace)) {
            $result = str_replace(array_keys($replace), array_values($replace), $m);
        }
        return $result;
    }

    /**
     * @param $path
     * @return Localization
     * @throws \Bitrix\Main\DB\Exception
     */
    public function fork($path) {
        return new static($this->getData()->get($path));
    }
}