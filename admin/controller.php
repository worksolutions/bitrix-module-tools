<?php
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

use WS\Tools\Module;

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
require_once(__DIR__."/../include.php");
require_once(__DIR__."/../prolog.php");


if(!Module::getInstance()->getUser()) {
    return;
}

CModule::IncludeModule('ws.tools');
CModule::IncludeModule('iblock');

$request = $_REQUEST;
$action = $request['q'];
$fAction = function ($file) use ($action) {
    global
    $USER, $DB, $APPLICATION, $adminPage, $adminMenu, $adminChain;
    $localization = Module::getInstance()->getLocalization('admin')->fork($action);
    include $file;
};

$actionFile = __DIR__.DIRECTORY_SEPARATOR.$request['q'].'.php';
if (file_exists($actionFile)) {
    $fAction($actionFile);
} else {
    /* @var $APPLICATION CMain */
    $APPLICATION->ThrowException("Action `$actionFile` not exists");
}
require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_admin_after.php");
?>




