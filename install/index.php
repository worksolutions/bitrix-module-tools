<?php
use Bitrix\Main\Application;
use WS\Tools\Module;

if (!class_exists('\WS\Tools\Localization')) {
    include __DIR__.'/../lib/localization.php';
}
if (!class_exists('\WS\Tools\Options')) {
    include __DIR__ . '/../lib/options.php';
}

/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

class ws_tools extends CModule {
    const FALLBACK_LOCALE = 'ru';
    const MODULE_ID = 'ws.tools';
    var $MODULE_ID = 'ws.tools';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_CSS;
    var $strError = '';

    var $localization;

    /**
     * @return \WS\Tools\Localization
     */
    private function localization() {
        $localizePath = __DIR__.'/../lang/'.LANGUAGE_ID;

        if (!file_exists($localizePath)) {
            $localizePath = __DIR__.'/../lang/'.self::FALLBACK_LOCALE;
        }

        return new \WS\Tools\Localization(require $localizePath.'/info.php');
    }

    public function __construct() {
        $arModuleVersion = array();
        include(dirname(__FILE__) . "/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $this->PARTNER_NAME = GetMessage("WS_TOOLS_PARTNER_NAME");

        $localization = $this->localization();
        $this->MODULE_NAME = $localization->getDataByPath("name");
        $this->MODULE_DESCRIPTION = $localization->getDataByPath("description");
        $this->PARTNER_NAME = $localization->getDataByPath("partner.name");
        $this->PARTNER_URI = 'http://worksolutions.ru';
    }

    function InstallFiles() {
        $rootDir = Application::getDocumentRoot().'/'.Application::getPersonalRoot();
        $adminGatewayFile = '/admin/ws_tools.php';
        copy(__DIR__. $adminGatewayFile, $rootDir . $adminGatewayFile);
        return true;
    }

    function UnInstallFiles() {
        $rootDir = Application::getDocumentRoot().'/'.Application::getPersonalRoot();
        $adminGatewayFile = '/admin/ws_tools.php';
        unlink($rootDir . $adminGatewayFile);
        return true;
    }

    public function DoInstall() {
        global $APPLICATION;
        RegisterModule($this->MODULE_ID);
        $this->InstallFiles();
        CModule::IncludeModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile($this->localization()->getDataByPath('setup.up'), __DIR__.'/step.php');
    }

    public function DoUninstall() {
        global $APPLICATION;
        $this->UnInstallFiles();
        UnRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile($this->localization()->getDataByPath('setup.down'), __DIR__.'/unstep.php');
    }
}