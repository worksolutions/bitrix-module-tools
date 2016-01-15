<?php
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

namespace WS\Tools;

use Bitrix\Main\Application;
use Bitrix\Main\Data\CacheEngineFiles;
use WS\Tools\Cache\CacheManager;
use WS\Tools\ClassLoader\ClassLoader;
use WS\Tools\ClassLoader\PSR0ClassLoaderDriver;
use WS\Tools\ClassLoader\PSR4ClassLoaderDriver;
use WS\Tools\Events\EventsManager;
use WS\Tools\Mail\MailService;
use WS\Tools\ORM\Db\Manager;
use WS\Tools\Services\ServicesLocator;

/**
 * Class Module
 * namespace WS\Tools
 * pattern Singleton
 */

class Module {

    const MODULE_ID = 'ws.tools';
    const ITEMS_ID = 'ws_tools_menu';
    const MODULE_NAME = 'ws.tools';
    const FALLBACK_LOCALE = 'ru';

    private $localizePath = null;
    private $localizations = array();
    private static  $name = self::MODULE_NAME;

    /**
     * @var ServicesLocator
     */
    private $_servicesLocator;

    private function __construct() {
        $this->localizePath = __DIR__.'/../lang/'.LANGUAGE_ID;

        if (!file_exists($this->localizePath)) {
            $this->localizePath = __DIR__.'/../lang/'.self::FALLBACK_LOCALE;
        }

        $this->_servicesLocator = new ServicesLocator();
        $this->_servicesLocator->willUse('eventManager', new EventsManager());
        $this->_servicesLocator->willUse('classLoader', new ClassLoader(array(
            'drivers' => array(
                "psr4" => new PSR4ClassLoaderDriver(),
                "psr0" => new PSR0ClassLoaderDriver()
            )
        )));
        $this->_servicesLocator->willUse('cache', new CacheManager(array(
            'engine' => new CacheEngineFiles()
        )));
        $this->_servicesLocator->willUse('mail', new MailService());
        $this->_servicesLocator->willUse('orm', new Manager($this->cacheManager()));
    }

    /**
     * Setup params to configure module
     * @param $params
     */
    public function config($params) {
        foreach ($params as $name => $value) {
            $this->configSection($name, $value);
        }
    }

    /**
     * Setup params section to configure
     * @param $name
     * @param $value
     */
    public function configSection($name, $value) {
        if ($name == 'services') {
            $this->_servicesLocator->configure($value);
        }
        if ($name == 'autoload') {
            $this->classLoader()->configure($value);
        }
    }

    /**
     * @return Application
     */
    public function application() {
        return Application::getInstance();
    }

    /**
     * Will get module facade
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
     * Works with i18n messages
     * @param $path
     * @throws \Exception
     * @return mixed
     */
    public function getLocalization($path) {
        if(!$this->localizations[$path]) {
            $realPath = realpath($this->localizePath.'/'.str_replace('.', '/',$path).'.php');
            if(!file_exists($realPath)) {
                throw new \Exception('Exception '.__CLASS__ . ' method _getLocalization message - файл не найден');
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
     * @param $name
     * @return Object
     */
    public function getService($name) {
        return $this->_servicesLocator->get($name);
    }

    /**
     * @return ClassLoader
     */
    public function classLoader() {
        return $this->getService('classLoader');
    }

    /**
     * @return EventsManager
     */
    public function eventManager() {
        return $this->getService('eventManager');
    }


    /**
     * @param $type
     * @return Log
     */
    public function getLog($type) {
        return new Log($type);
    }

    /**
     * @return CacheManager
     */
    public function cacheManager() {
        return $this->getService('cache');
    }

    /**
     * @return MailService
     */
    public function mail() {
        return $this->getServiceLocator()->get('mail');
    }

    /**
     * @return Manager
     */
    public function orm() {
        return $this->getServiceLocator()->get('orm');
    }

    /**
     * @return ServicesLocator
     */
    public function getServiceLocator() {
        return $this->_servicesLocator;
    }
}