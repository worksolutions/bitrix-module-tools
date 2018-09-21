<?php

namespace WS\Tools\ORM\Db\Gateway;

/**
 * Base wf iblock gateway.
 *
 * There is integration with the bitrix catalog with workflow process (hydration of objects prices)
 *
 * @author m.papka@worksolutions.ru
 */

class IblockWfElement extends IblockElement {

    protected function findEngine() {
        list($arFilter, $arOrder, $relations, $arPager) = func_get_args();
        $arFilter['IBLOCK_ID'] = $this->iblockId();
        $arFilter["SHOW_NEW"] = "Y";
        $arFilter["SHOW_HISTORY"] = "Y";
        if (!empty($arPager)) {
            $arPager = array(
                'iNumPage' => $arPager[0],
                'nPageSize' => $arPager[1]
            );
        }
        $arSelected = array_merge(self::$mainFields, $relations ?: array());
        foreach ($this->getFieldsAssoc() as $attr => $field) {
            // Price and relations already set
            if ($this->isPriceRelation($attr)) {
                continue;
            }
            $arSelected[] = $this->fieldByAttrForRequest($attr);
        }
        return \CIBlockElement::getList($arOrder, $arFilter, false, $arPager, $arSelected);
    }
}
