<?php
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

$conversionProperty = function ($idProperty, $idIBlock, $type) {
    $propertyValues = array();
    $result = CIBlockElement::GetList(array(), array('IBLOCK_ID' => $idIBlock), null, null, array('ID'));
    $variants = array();
    while ($element = $result->Fetch()) {
        $propResult = CIBlockElement::GetProperty($idIBlock, $element['ID'], '', '', array('ID' => $idProperty));
        while ($property = $propResult->Fetch()) {
            $propertyValues[] = array(
                'id_element' => (int) $element['ID'],
                'id_property' => (int) $property['ID'],
                'value' => $property['VALUE']
            );

            $variants[] = $property['VALUE'];
        }
    }

    $variants = array_filter(array_unique($variants));

    asort($variants);

    $prop = new CIBlockProperty();
    $prop->Update($idProperty, array('PROPERTY_TYPE' => $type));
    $propertyData = CIBlockProperty::GetByID($idProperty, $idIBlock)->Fetch();

    $list = array();

    switch ($type) {
        case "L": // list
            /** @var CDatabase $DB */
            global $DB;
            foreach ($variants as $variant) {
                $lastId = $list[$variant] = CIBlockPropertyEnum::Add(array(
                    'PROPERTY_ID' => $idProperty,
                    'VALUE' => $variant,
                ));
                if (!$lastId) {
                    throw new Exception($DB->db_Error);
                }
            }
            break;
        case "E" : // Привязка к элементу
            $arSourceIblockData = CIBlock::GetArrayByID($idIBlock);

            $sites = array();
            $rsSites = \Bitrix\Main\SiteTable::getList();
            while ($arSite = $rsSites->fetch()) {
                $sites[] = $arSite['LID'];
            }
            $iblock = new CIBlock();
            $handbookIblockId = $iblock->Add(array(
                "ACTIVE" => 'Y',
                "NAME" => $propertyData['NAME'],
                "SITE_ID" => $sites,
                "IBLOCK_TYPE_ID" => $arSourceIblockData['IBLOCK_TYPE_ID']
            ));
            if (!$handbookIblockId) {
                throw new Exception($iblock->LAST_ERROR);
            }

            $iblockElement = new CIBlockElement();
            $arPropertyId = array();
            foreach ($variants as $variant) {
                $lastId = $list[$variant] = $iblockElement->Add(array(
                    "ACTIVE" => "Y",
                    'IBLOCK_ID' => $handbookIblockId,
                    'NAME' => $variant,
                ));

                if (!$lastId) {
                    throw new Exception($iblockElement->LAST_ERROR);
                }
            }
            $property = new CIBlockProperty();
            $property->Update($idProperty, array('LINK_IBLOCK_ID' => $handbookIblockId));

            break;

    }

    $iblockElement = new CIBlockElement();
    $valuesToElements = array();
    foreach ($propertyValues as $propertyValue) {
        $variantIdId = $list[$propertyValue['value']];
        $valuesToElements[$propertyValue['id_element']][] = $variantIdId;
    }
    foreach ($valuesToElements as $elementId => $elementValues) {
        $iblockElement->SetPropertyValuesEx($elementId, $idIBlock, array($idProperty => $elementValues));
    }
    return true;
};

if ($_POST['apply'] == 'Применить') {

    $iblockID = intval($_POST['selectIblocks']);
    $propertyID = intval($_POST['selectProperties']);
    $newTypeIBlock = $_POST['new-type-property-info-block'];
    $conversionResult = $conversionProperty(
        $propertyID,
        $iblockID,
        $newTypeIBlock
    );

     $conversionResult && CAdminNotify::Add(array(
        'MESSAGE' => 'Конвертация прошла успешно',
        'TAG' => 'save_property_notify',
        'MODULE_ID' => 'ws.tools',
        'ENABLE_CLOSE' => 'Y',
    ));
    !$conversionResult && CAdminNotify::Error(array(
        'MESSAGE' => 'Конвертация не прошла успешно',
        'TAG' => 'save_property_notify_error',
        'MODULE_ID' => 'ws.tools',
        'ENABLE_CLOSE' => 'Y',
    ));
}

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
        'PROPERTY_TYPE' => \Bitrix\Iblock\PropertyTable::TYPE_STRING,
        'USER_TYPE' => NULL
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


/** @var $localization \WS\Tools\Localization */
$localization;

?>
<form method="POST"
      action="<?= $APPLICATION->GetCurUri()?>"
      ENCTYPE="multipart/form-data"
      name="apply">

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
$form->AddDropDownField('new-type-property-info-block', 'Тип', '', array('L' => 'Список', 'E' => 'Привязка к эементам'));
?>
    <div class="adm-info-message">
        <span class="required">
            Внимание! Пока доступна только конвертация свойств типа 'строка' в тип 'список' и 'привязка к элементу'
        </span>
    </div>

<?php
$form->Buttons(array('btnSave' => false));

$form->EndCustomField('form');
$form->Show();
?>
</form>

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