<?php
CModule::IncludeModule('ws.tools');
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

use \WS\Tools\Localization;
use \WS\Tools\Module;

if (!Module::getInstance()->getUser()->IsAdmin()) {
    return array();
}

/** @var Localization $localization */
$localization = Module::getInstance()->getLocalization('menu');
$inputUri = '/bitrix/admin/ws_tools.php?q=';

return array(
    array(
        'parent_menu' => 'global_menu_settings',
        'sort' => 500,
        'text' => $localization->getDataByPath('title'),
        'title' => $localization->getDataByPath('title'),
        'module_id' => Module::MODULE_ID,
        'icon' => '',
        'items_id' => Module::ITEMS_ID,
        'items' => array(
            array(
                'text' => $localization->getDataByPath('conversionPropertiesIB'),
                'url' => $inputUri.'conversion',
            ),
        )
    )
);

