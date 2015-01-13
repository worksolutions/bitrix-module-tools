<?php
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

use WS\Tools\Conversion\ConversionPropertyIBlock;
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php");

/** @var $localization \WS\Migrations\Localization */
$localization;

echo "Тип инфоблока </br><hr></br>";
?>

<form name="typeIBlock"
      action="<?$APPLICATION->GetCurPage()?>"
      method="GET"
      id="type-info-block">

    <?php
    echo SelectBoxFromArray("iBlock", ConversionPropertyIBlock::getListTypesIBlocks(), "", "", "", false, "typeIBlock")
    ?>
</form>
</br>
</br>
<?
$result = ConversionPropertyIBlock::getListIBlocks();
?>
<form name="iBlock"
action=""
method="POST"
ENCTYPE="multipart/form-data">
</form>

    <?php
    $form = new CAdminForm('ws_tools_conversion', array(
        array(
            "DIV" => "edit1",
            "TAB" => $localization->getDataByPath('title'),
            "ICON" => "iblock",
            "TITLE" => $localization->getDataByPath('title'),
        ),
    ));
    $form->Begin();
    $form->BeginCustomField('form', '');
    foreach($result as $iblock):?>
        <tr>
            <td width="30%">
                <h2><?= $iblock['NAME']?></h2>
            </td>
        </tr>
        <?php
        $listProperty = ConversionPropertyIBlock::getListPropertyIBlockByID($iblock['ID']);
        foreach ($listProperty as $property):?>
            <tr>
                <td width="30%">
                    <?= $property['NAME'], ' ' . $property['DEFAULT_VALUE']?>
                </td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td width="30%">
                <hr>
            </td>
        </tr>
    <?php endforeach ?>
    <?php
    $form->EndCustomField('form');
    $form->Show();
