<?php
use Bitrix\Main\Application;

include __DIR__.'/../lib/localization.php';
include __DIR__.'/../lib/options.php';

/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

class ws_tools extends CModule {
    var $MODULE_ID = 'ws.tools';
    var $MODULE_NAME = 'Tools';
    var $PARTNER_NAME = 'WorkSolutions';
    var $PARTNER_URI = 'http://worksolutions.ru';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;

    var $localization;

    /**
     * @return \WS\Tools\Localization
     */
    private function localization() {
        if (!$this->localization) {
            $this->localization = new \WS\Tools\Localization(include __DIR__.'/../lang/'.LANGUAGE_ID.'/info.php');
        }
        return $this->localization;
    }

    public function __construct() {
        $arModuleVersion = array();
        include(dirname(__FILE__) . "/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

        $localization = $this->localization();
        $this->MODULE_NAME = $localization->getDataByPath("name");
        $this->MODULE_DESCRIPTION = $localization->getDataByPath("description");
        $this->PARTNER_NAME = $localization->getDataByPath("partner.name");
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