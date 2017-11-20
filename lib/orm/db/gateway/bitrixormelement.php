<?php

namespace WS\Tools\ORM\Db\Gateway;

use Bitrix\Main\DB\Result;
use Bitrix\Main\Entity\AddResult;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\DateField;
use Bitrix\Main\Entity\UpdateResult;
use Bitrix\Main\Type\Date;
use Bitrix\Main\Entity\ScalarField;
use Bitrix\Main\Entity\Field;
use WS\Tools\ORM\DateTime;
use WS\Tools\ORM\Db\Gateway;
use Exception;
use WS\Tools\ORM\Entity;

class BitrixOrmElement extends Gateway {

    protected function findEngine() {
        list($arFilter, $arOrder, $relations, $pager) = func_get_args();

        $bxClass = $this->analyzer->getParam('bitrixClass');
        $bxClass = $bxClass[0];
        $params = array(
            'filter' => $arFilter ? : array(),
            'order' => $arOrder ? : array(),
        );
        if (is_array($pager) && count($pager) == 2) {
            $params['limit'] = $pager[1];
            $params['offset'] = $pager[1] * ($pager[0] - 1);
        }
        /* @var $dbRes Result */
        $dbRes = call_user_func(array($bxClass, 'getList'), $params);
        return $dbRes;
    }

    protected function setupFilterClass() {
        return \WS\Tools\ORM\Db\Filter\Common::className();
    }

    protected function hydrateWithRepo(array $gwAssoc) {
        $keyPrimary = $this->getPrimaryKey();
        $key = !empty($gwAssoc[$keyPrimary]) ? $gwAssoc[$keyPrimary] : $gwAssoc['id'];
        if ($this->repo->exist($key)) {
            return $this->repo->get($key);
        }
        if ($this->proxy->exist($key)) {
            $entity = $this->proxy->get($key);
            $this->proxy->remove($key);
        } else {
            $entityClass = $this->getEntityClass();
            /** @var $entity Entity **/
            $entity = new $entityClass;
        }
        $this->hydrateRaw($gwAssoc, $entity);
        $this->repo->add($key, $entity);
        return $entity;
    }

    private function getPrimaryKey() {
        $bxClass = $this->analyzer->getParam('bitrixClass', 1);
        $bxObject = new $bxClass;
        foreach ($bxObject->getMap() as $key => $item) {
            if ($item instanceof ScalarField) {
                if ($item->isPrimary()) {
                    return $item->getName();
                }
            } else {
                if ($item['primary']) {
                    return $key;
                }
            }
        }
        return 'ID';
    }

    /**
     * Update database row
     *
     * @param $id
     * @param $fields
     * @return mixed
     */
    protected function updateRow($id, $fields) {
        $bxClass = $this->analyzer->getParam('bitrixClass', 1);
        $bxObject = new $bxClass;
        $fields = $this->prepareFields($bxObject, $fields);
        /** @var UpdateResult $res */
        $res = $bxObject->Update($id, $fields);
        if (!$res->isSuccess()) {
            throw new SaveException($res->getErrorMessages());
        }
    }

    /**
     * Insert database row
     *
     * @param $fields
     * @return mixed
     */
    protected function insertRow($fields) {
        $bxClass = $this->analyzer->getParam('bitrixClass', 1);
        $bxObject = new $bxClass;
        $fields = $this->prepareFields($bxObject, $fields);
        /** @var AddResult $res */
        $res = $bxObject->Add($fields);
        if (!$res->isSuccess()) {
            throw new SaveException($res->getErrorMessages());
        }
        return $res->getId();
    }

    /**
     * @param $entity
     */
    public function remove($entity) {
        $bxClass = $this->analyzer->getParam('bitrixClass', 1);
        $bxObject = new $bxClass;
        $bxObject->Delete($entity->id);
        $entity->id = null;
    }

    /**
     * @param DataManager $bxObject
     * @param $fields
     * @return array
     */
    private function prepareFields($bxObject, $fields) {
        $map = $this->getFieldsMap($bxObject);
        $fieldsForSave = array();
        foreach ($fields as $code => $value) {
            if (!isset($map[$code])) {
                continue;
            }
            if ($this->isDate($value) && $this->isDateField($map[$code])) {
                $value = new Date($value);
            }
            $fieldsForSave[$code] = $value;
        }

        return $fieldsForSave;
    }

    /**
     * @param DataManager $bxObject
     *
     * @return array
     */
    private function getFieldsMap($bxObject) {
        $map = $bxObject::getMap();
        $fieldsMap = [];
        foreach ($map as $key => $field) {
            if ($field instanceof Field) {
                $fieldsMap[$field->getName()] = $field;
                continue;
            }
            $fieldsMap[$key] = $field;
        }

        return $fieldsMap;
    }

    /**
     * @param $field
     *
     * @return bool
     */
    private function isDateField($field) {
        if (is_array($field)) {
            return $field['data_type'] === 'date' || $field['data_type'] === 'datetime';
        }

        return $field instanceof DateField;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    private function isDate($value) {
        if (empty($value)) {
            return false;
        }
        return ($value instanceof DateTime) || strtotime($value);
    }

    /**
     * Convert attribute chain (by relations)
     * to api fields chain (for query)
     *
     * @param string $attrsChain
     * @return string
     * @throws Exception
     */
    protected function fieldByAttrChainForOrder($attrsChain) {
        list($attr, $relPath) = $this->explodeRelation($attrsChain);
        $isRelation = $this->isRelation($attr);
        if (!$isRelation) {
            $attr = $attrsChain;
        }
        $field = $this->fieldByAttrForRequestOrder($attr);
        if (!is_null($relPath) && $isRelation) {
            return $field .'.'. $this->getGatewayByRelAttr($attr)->fieldByAttrChainForOrder($relPath);
        }
        if (!is_null($relPath) && !$isRelation) {
            $entityClass = $this->getEntityClass();
            throw new Exception("Call attr `$attr` as relation, but attr is not related to entity `$entityClass`");
        }
        return $field;
    }
}
