<?php
/** @var CMain $APPLICATION */
/** @var CUser $USER */
/** @var CDatabase $DB */
/** @var CUpdater $updater */
$updater;
/**
 * Error message for processing update
 * @var string $errorMessage
 */
$fAddErrorMessage = function ($mess) use ($updater){
    $updater->errorMessage[] = $mess;
};
//=====================================================

if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
    $root = $_SERVER['DOCUMENT_ROOT'];
    unlink($root.'/bitrix/modules/ws.tools/lib/mail/MailPackage.php');
    unlink($root.'/bitrix/modules/ws.tools/lib/mail/MailService.php');
    unlink($root.'/bitrix/modules/ws.tools/lib/tests/cases/EventManagerTestCase.php');
}
