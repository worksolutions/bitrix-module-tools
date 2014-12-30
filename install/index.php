<?php
use Bitrix\Main\Application;

require_once __DIR__ . '/../src/module.php';
require_once __DIR__ . '/../src/localization.php';
require_once __DIR__ . '/../src/module.php';
require_once __DIR__ . '/../src/options.php';


/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

class ws_tools extends CModule {
    var $MODULE_ID = 'ws.tools';
    var $MODULE_NAME = 'Tools';
    var $PARTNER_NAME = 'WorkSolutions';
    var $PARTNER_URI = 'http://worksolutions.ru';
    var $MODULE_DESCRIPTION = 'Описание модуля';
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;

    public function __construct() {
        $arModuleVersion = array();
        include(dirname(__FILE__) . "/version.php");
        $this->MODULE_VERSION = $arModuleVersion["VERSION"];
        $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
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
        $this->InstallFiles();
        RegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile('Установка модуля ws-tools', __DIR__.'/step.php');
    }

    public function DoUninstall() {
        global $APPLICATION;
        $this->UnInstallFiles();
        UnRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile('Деинсталяция модуля ws-tools', __DIR__.'/unstep.php');
    }
}