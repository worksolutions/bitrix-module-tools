<?php
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

namespace WS\Tools;
use Bitrix\Main\Application;
use Bitrix\Main\DB\Exception;
/**
 * Class Module
 * namespace WS\Tools
 * pattern Singleton
 */

class Module {

    const MODULE_ID = 'ws.tools';
    const ITEMS_ID = 'ws_tools_menu';
    const MODULE_NAME = ' ws.tools';

    private $localizePath = null;
    private $localizations = array();
    private static  $name = self::MODULE_NAME;

    private $_services = array();

    private function __construct() {
        $this->localizePath = __DIR__.'/../lang/'.LANGUAGE_ID;
    }

    /**
     * @return Application
     */
    public function application() {
        return Application::getInstance();
    }

    /**
     * @return Module
     */
    public static function getInstance() {
        static $self = null;
        if(!$self) {
            $self = new self;
        }
        return $self;
    }

    /**
     * @param $path
     * @return mixed
     * @throws Exception
     */
    public function getLocalization($path) {
        if(!$this->localizations[$path]) {
            $realPath = realpath($this->localizePath.'/'.str_replace('.', '/',$path).'.php');
            if(!file_exists($realPath)) {
                throw new Exception('Exception '.__CLASS__ . ' method _getLocalization message - файл не найден');
            }

            $data = include $realPath;
            $this->localizations[$path] = new Localization($data);

        }

        return $this->localizations[$path];
    }

    /**
     * @return \CUser
     */
    public function getUser() {
        global $USER;
        return $USER;
    }

    static public function getName($stripDots = false) {
        $name = static::$name;
        if ($stripDots) {
            $name = str_replace('.', '_', $name);
        }
        return $name;
    }

    /**
     * @return ClassLoader
     */
    public function classLoader() {
        return ClassLoader::getInstance();
    }

    public function eventManager() {

    }
}