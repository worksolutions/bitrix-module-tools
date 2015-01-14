<?php
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

$jsParams = array();

$types = array();
$rsTypes = \Bitrix\Iblock\TypeLanguageTable::getList(array(
    'filter' => array(
        'LANGUAGE_ID' => LANG
    )
));
while ($type = $rsTypes->fetch()) {
    $types[$type['IBLOCK_TYPE_ID']] = $type['NAME'];
}
$jsParams['types'] = array(
    'name' => 'selectTypes',
    'list' => $types
);

$iblocks = array();
$rsIblocks = \Bitrix\Iblock\IblockTable::getList();
while ($iblock = $rsIblocks->fetch()) {
    $iblocks[$iblock['ID']] = array(
        'name' => $iblock['NAME'],
        'type' => $iblock['IBLOCK_TYPE_ID']
    );
}

$jsParams['iblocks'] = array(
    'name' => 'selectIblocks',
    'list' => $iblocks
);

$properties = array();
$rsProperties = \Bitrix\Iblock\PropertyTable::getList(array(
    'filter' => array(
        'PROPERTY_TYPE' => array('S', 'N')
    )
));
while ($property = $rsProperties->fetch()) {
    $properties[$property['ID']] = array(
        'name' => $property['NAME'],
        'iblockId' => $property['IBLOCK_ID']
    );
}

$jsParams['properties'] = array(
    'name' => 'selectProperties',
    'list' => $properties
);


/** @var $localization \WS\Migrations\Localization */
$localization;

?>
<?php
$form = new CAdminForm('ws_tools_conversion', array(
    array(
        "DIV" => "edit1",
        "TAB" => $localization->getDataByPath('title'),
        "TITLE" => $localization->getDataByPath('title'),
    ),
));
$form->Begin();

$form->BeginNextFormTab();
$form->BeginCustomField('form', '');
$form->AddSection('section-source', 'Источник');
$form->AddDropDownField('selectTypes', 'Тип Инфоблока', '', array());
$form->AddDropDownField('selectIblocks', 'Инфоблок', '', array());
$form->AddDropDownField('selectProperties', 'Свойство Инфоблока', '', array());

$form->AddSection('section-appointment', 'Назначение');
$form->AddDropDownField('new-type-property-info-block', 'Тип', '', array('Список', 'Привязка к эементам'));

$form->Buttons(array());

$form->EndCustomField('form');

$form->EndTab();
$form->Show();

?>

<script type="text/javascript">
    (function (params) {
        var
            $selectTypes = $('select[name="'+params['types']['name']+'"]'),
            $selectIblocks = $('select[name="'+params['iblocks']['name']+'"]'),
            $selectProperties = $('select[name="'+params['properties']['name']+'"]');

        var
            data = {
                types: params['types']['list'],
                iblocks: params['iblocks']['list'],
                properties: params['properties']['list']
            };

        $selectIblocks.on("change", function () {
            $selectProperties.empty();
            var iblockId = $selectIblocks.val();
            var list = data['properties'];
            $.each(list, function (id, data) {
                var name = data['name'];
                var propIblockId = data['iblockId'];
                if (iblockId != propIblockId) {
                    return;
                }
                var $option = $('<option />', {
                    value: id
                }).text(name);
                $selectProperties.append($option);
            });
        });

        $selectTypes.on("change", function () {
            $selectIblocks.empty();
            var typeId = $selectTypes.val();
            var list = data['iblocks'];
            $.each(list, function (id, data) {
                var name = data['name'];
                var iblockTypeId = data['type'];
                if (typeId != iblockTypeId) {
                    return;
                }
                var $option = $('<option />', {
                    value: id
                }).text(name);
                $selectIblocks.append($option);
            });
            $selectIblocks.change();
        });

        $.each(data.types, function (id, name) {
            var $option = $('<option />', {
                value: id
            }).text(name);
            $selectTypes.append($option);
        });
        $selectTypes.change();

    })(<?= json_encode($jsParams)?>);
</script>