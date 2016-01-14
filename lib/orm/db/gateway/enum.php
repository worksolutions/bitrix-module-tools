<?php

namespace WS\Tools\ORM\Db\Gateway;

/**
 * Описание List
 *
 * @author Максим Соколовский (my.sokolovsky@gmail.com)
 */
class Enum extends Common {

    protected function addConditionToBxFilter($filterParams, & $arFilter) {
        if ($filterParams['operator'] == '#') {
            $entityClass = $filterParams['attr'];
            $entityAttr = $filterParams['value'];
            $entityGw = $this->getGatewayByEntityClass($entityClass);
            if (! $entityGw instanceof IblockElement) {
                throw new \Exception("Entity `$entityClass` is not support list elements because they are not iblock");
            }
            $map = $entityGw->getFieldsAssoc();
            $propertyCode = $map[$entityAttr];
            if (!isset($propertyCode)) {
                throw new \Exception("Attr `$entityAttr` for `$entityClass` in gateway. Db sinh is not declared");
            }
            $arFilter['CODE'] = $propertyCode;
            $arFilter['IBLOCK_ID'] = $entityGw->iblockId();
        } else {
            parent::addConditionToBxFilter($filterParams, $arFilter);
        }
    }

    protected function setupFilterClass() {
        return \WS\Tools\ORM\Db\Filter\Enum::className();
    }

    protected function updateRow($id, $fields) {
        // nothing
    }

    protected function insertRow($fields) {
        // nothing
    }
}
