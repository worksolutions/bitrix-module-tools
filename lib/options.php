<?php
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

namespace WS\Tools;

use Bitrix\Main\DB\Exception;

class Options {

    private $_data = array();

    public function __construct(array $data = null) {
        $data && ($this->_data = $data);
    }

    public function get($path, $default = null) {
        $usesAliases = array();

        $realPath = preg_replace_callback('/\[.*?\]/', function($matches) use (& $usesAliases) {
            $key = trim($matches[0], '[]');
            $alias = str_replace('.', '_', $key);
            $usesAliases[$alias] = $key;

            return '.' . $alias;
        }, $path);

        $arPath = explode('.', $realPath);
        $data = $this->_data;

        while(($pathItem = array_shift($arPath)) !== null) {
            if($usesAliases[$pathItem]) {
                $pathItem = $usesAliases[$pathItem];

                unset($usesAliases[$pathItem]);
            }

            if($data instanceof self) {
                $data = $data->toArray();
            }

            if(!isset($data[$pathItem])) {
                if ( ! is_null($default)) {
                    return $default;
                }

                throw new Exception("Value by path `$path` not exist");
            }
            $data = $data[$pathItem];
        }

        return $data;
    }

    private function toArray() {
        return $this->_data;
    }
}