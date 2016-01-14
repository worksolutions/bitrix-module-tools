<?php

namespace WS\Tools\ORM\Db\Gateway;

use WS\Tools\ORM\BitrixEntity\PropEnumElement;

/**
 * Движок шлюза сущности User
 *
 * @author Максим Соколовский (my.sokolovsky@gmail.com)
 */
class User extends Common {

    protected function findEngine() {
        list($arFilter, $arSort) = func_get_args();
        $by = 'timestamp_x';
        $order = 'desc';
        if (!is_null($arSort)) {
            $countSortElements = count($arSort);
            $arBySort = array_keys($arSort);
            $by = $arBySort[$countSortElements-1];
            $order = $arSort[$by];
        }
        $bxClass = $this->analyzer->getParam('bitrixClass');
        $bxClass = $bxClass[0];
        /* @var $dbRes \CDBResult */
        $params[] = & $by;
        $params[] = & $order;
        $params[] = $arFilter;
        $params[] = array("SELECT" => array("UF_*"));
        $dbRes = call_user_func_array(array($bxClass, 'getList'), $params);
        return $dbRes;
    }

    protected function setupFilterClass() {
        return \WS\Tools\ORM\Db\Filter\User::className();
    }

    public function getEnumVariants($attr) {
        $attrData = $this->attrs[$attr];
        if (ltrim($attrData[0], '\\') != PropEnumElement::className()) {
            throw new \Exception('Attr `'.$attr.'('.($attrData[0]).')` is not list');
        }
        $field = $this->attrsToFields[$attr];
        $userField = \CUserTypeEntity::GetList(array(), array('ENTITY_ID' => 'USER', 'FIELD_NAME' => $field))->Fetch();

        if (!$userField) {
            throw new \Exception('User property `'.$attr.'` as code `'.$field.'` not exists');
        }

        $gw = $this->getGatewayByEntityClass(PropEnumElement::className());
        return $gw->find(
            array(
                array('attr' => 'propertyId', 'operator' => '', 'value' => $userField['ID']),
            ),
            array('sort' => 'asc', 'value' => 'asc')
        );
    }

    public function getEnumVariant($attr, $code) {
        $attrData = $this->attrs[$attr];
        if (ltrim($attrData[0], '\\') != PropEnumElement::className()) {
            throw new \Exception('Attr `'.$attr.'('.($attrData[0]).')` is not list');
        }
        $field = $this->attrsToFields[$attr];
        $userField = \CUserTypeEntity::GetList(array(), array('ENTITY_ID' => 'USER', 'FIELD_NAME' => $field))->Fetch();

        if (!$userField) {
            throw new \Exception('User property `'.$field.'` as code `'.$field.'` not exists');
        }

        $gw = $this->getGatewayByEntityClass(PropEnumElement::className());
        return $gw->findOne(
            array(
                array('attr' => 'propertyId', 'operator' => '', 'value' => $userField['ID']),
                array('attr' => 'xmlId', 'operator' => '', 'value' => $code),
            ),
            array('value' => 'asc')
        );
    }
}
