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

$root = $_SERVER['DOCUMENT_ROOT'];

DeleteDirFilesEx($root.'/bitrix/modules/ws.tools/.git');
unlink($root.'/bitrix/modules/ws.tools/.gitignore');
