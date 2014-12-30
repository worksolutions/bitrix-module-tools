<?php
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

namespace WS\Tools;


class Localization {

    /**
     * @var Options
     */
    private $_data;

    public function __construct($data) {
        $this->_data = new Options($data);
    }

    /**
     * @param $path
     * @return array
     */
    public function getDataByPath($path) {
        return $this->_getData()->get($path);
    }

    /**
     * @return Options
     */
    private function _getData() {
        if(!$this->_data) {
            $this->_data = new Options();
        }

        return $this->_data;
    }
}