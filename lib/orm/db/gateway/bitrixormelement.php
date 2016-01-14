<?php

namespace WS\Tools\ORM\Db\Gateway;

use Bitrix\Main\DB\Result;
use Bitrix\Main\Entity\AddResult;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\UpdateResult;
use Bitrix\Main\Type\Date;
use WS\Tools\ORM\Db\Gateway;
use Exception;

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

    /**
     * Обновление полей бд
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
     * Вставка полей в базу данных
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
     * @param $bxObject DataManager
     * @param $fields
     * @return array
     */
    private function prepareFields($bxObject, $fields) {
        $map = $bxObject->getMap();
        $fieldsForSave = array();
        foreach ($fields as $code => $value) {
            if (!isset($map[$code])) {
                continue;
            }
            if (!empty($value) && $map[$code]['data_type'] == 'date') {
                if (!($value instanceof Date) && strtotime($value)) {
                    $value = new Date($value);
                }
            }
            $fieldsForSave[$code] = $value;
        }

        return $fieldsForSave;
    }

    /**
     * Преобразование ценпочки обращения состоящую из аттрибутов (по связям)
     * в цепочку состоящую из полей api (для запроса)
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
