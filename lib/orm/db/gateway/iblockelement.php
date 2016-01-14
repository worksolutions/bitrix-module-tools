<?php

namespace WS\Tools\ORM\Db\Gateway;

use WS\Tools\ORM\BitrixEntity\EnumElement;
use WS\Tools\ORM\Collection;
use WS\Tools\ORM\Db\Gateway;
use Exception;

/**
 * Базовый класс шлюзов информационных блоков. 
 * 
 * Присутствует интеграция с торговым каталогом (гидротация объектов цен)
 * 
 * @author Максим Соколовский (my.sokolovsky@gmail.com)
 */
class IblockElement extends Gateway {

    const PROPERTY_TYPE_LIST = 1; 
    const PROPERTY_TYPE_ELEMENT = 2;
    const PROPERTY_TYPE_BOOL = 2;
    const PROPERTY_TYPE_NUMBER = 4;
    const PROPERTY_TYPE_STRING = 5;
    const PROPERTY_TYPE_GROUP = 6;
    const PROPERTY_TYPE_FILE = 7;

    /**
     * @var array
     */
    protected $propertyParams = array();

    /**
     * @var array
     */
    protected $fileProperties = array();

    static protected $mainFields = array(
        'ID', 'CODE', 'XML_ID', 'NAME', 'IBLOCK_ID', 'IBLOCK_SECTION_ID', 'IBLOCK_CODE', 'ACTIVE',
        'DATE_ACTIVE_FROM', 'DATE_ACTIVE_TO', 'SORT', 'PREVIEW_PICTURE', 'PREVIEW_TEXT',
        'PREVIEW_TEXT_TYPE', 'DETAIL_PICTURE', 'DETAIL_TEXT', 'DETAIL_TEXT_TYPE', 'SEARCHABLE_CONTENT',
        'DATE_CREATE', 'CREATED_BY', 'CREATED_USER_NAME', 'TIMESTAMP_X', 'MODIFIED_BY', 'USER_NAME',
        'LANG_DIR', 'LIST_PAGE_URL', 'DETAIL_PAGE_URL', 'SHOW_COUNTER', 'SHOW_COUNTER_START', 'WF_COMMENTS',
        'WF_STATUS_ID', 'LOCK_STATUS', 'TAGS'
    );

    private $iblockId;

    protected function construct() {
        \CModule::includeModule('iblock');
        $iblockIdDataParam = $this->analyzer->getParam('iblockId');
        $iblockIdDataParam && $this->iblockId = $iblockIdDataParam[0];

        $iblockCodeDataParam = $this->analyzer->getParam('iblockCode');
        $iblockCodeDataParam && $iblockCode = $iblockCodeDataParam[0];

        if (!$this->iblockId) {
            $this->iblockId = $this->analyzer->getData('iblockId', false);
        }
        if (!$this->iblockId() && isset($iblockCode)) {
            if (!$iblockCode) {
                throw new \Exception("Disable `".$this->analyzer->getClass()."` as iblock");
            }
            $arIblock = \CIBlock::GetList(
                array(),
                array(
                    'CODE' => $iblockCode,
                    'CHECK_PERMISSIONS' => 'N'
                )
            )->Fetch();
            $this->iblockId = $arIblock['ID'];
            $this->analyzer->setData('iblockId', $this->iblockId);
        }
        if (!$this->iblockId) {
            throw new \Exception("Diasable `".$this->analyzer->getClass()."` as iblock");
        }

        // установка типов свойств
        if ($this->propertyParams = $this->analyzer->getData('propertyParams', array())) {
            $this->fileProperties = $this->analyzer->getData('fileProperties', array());
            return ;
        }

        $dbRes = \CIBlockProperty::GetList(array(), array('IBLOCK_ID'=>$this->iblockId(), 'CHECK_PERMISSIONS' => 'N'));
        $this->propertyParams = array_flip($this->getFieldsAssoc());
        while ($arProperty = $dbRes->Fetch()) {
            if (!isset($this->propertyParams[$arProperty['CODE']])) {
                continue;
            }
            $type = null;
            switch ($arProperty['PROPERTY_TYPE']) {
                case 'S':
                    $type = self::PROPERTY_TYPE_STRING;
                    break;
                case 'N':
                    $type = self::PROPERTY_TYPE_NUMBER;
                    break;
                case 'L':
                    $type = self::PROPERTY_TYPE_LIST;
                    break;
                case 'F':
                    $type = self::PROPERTY_TYPE_FILE;
                    break;
                case 'G':
                    $type = self::PROPERTY_TYPE_GROUP;
                    break;
                case 'E':
                    $type = self::PROPERTY_TYPE_ELEMENT;
                    break;
                default:
                    break;
            }
            if ($type == self::PROPERTY_TYPE_FILE) {
                $this->fileProperties[] = $arProperty['CODE'];
            }
            $this->propertyParams[$arProperty['CODE']] = array(
                'type' => $type,
                'isMultiple' => $arProperty['MULTIPLE'] == 'Y',
                'id' => $arProperty['ID'],
            );
        }
        $this->analyzer->setData('propertyParams', $this->propertyParams);
        $this->analyzer->setData('fileProperties', $this->fileProperties);
    }

    protected function findEngine() {
        list($arFilter, $arOrder, $relations, $arPager) = func_get_args();
        $arFilter['IBLOCK_ID'] = $this->iblockId();
        if (!empty($arPager)) {
            $arPager = array(
                'iNumPage' => $arPager[0],
                'nPageSize' => $arPager[1]
            );
        }
        $arSelected = array_merge(self::$mainFields, $relations ?: array());
        foreach ($this->getFieldsAssoc() as $attr => $field) {
            // Цены и связи уже установлены
            if ($this->isPriceRelation($attr)) {
                continue;
            }
            $arSelected[] = $this->fieldByAttrForRequest($attr);
        }
        return \CIBlockElement::getList($arOrder, $arFilter, false, $arPager, $arSelected);
    }

    protected function addConditionToRelationFilter($filterParams, $attr, $relationPath, &$arRelations) {
        $field = $this->getFieldByAttr($attr);
        if ($this->propertyParams[$field]['type'] == self::PROPERTY_TYPE_LIST && !isset($arRelations[$attr])) {
            $arRelations[$attr][] = array(
                'attr' => 'propertyId',
                'operator' => '',
                'value' => $this->propertyParams[$field]['id']
            );
        }
        parent::addConditionToRelationFilter($filterParams, $attr, $relationPath, $arRelations);
    }

    /**
     * Добавление строки условия в фильтр битрикса
     * @param array $filterParams параметры фильтра для элемента
     * @param array $arFilter     фильтр битрикса (по ссылке)
     */
    protected function addConditionToBxFilter($filterParams, & $arFilter) {
        if (!isset($filterParams['logic']) || $filterParams['logic'] != 'or') {
            parent::addConditionToBxFilter($filterParams, $arFilter);
            return;
        }
        unset($filterParams['logic']);
        foreach ($filterParams as $filerOrBlock) {
            $blockFilter = array(
                'LOGIC' => 'OR'
            );
            foreach ($filerOrBlock as $subFilterParams) {
                $blockFilter[] = $this->getProcessedFilter($subFilterParams);
            }
            $arFilter[] = $blockFilter;
        }
    }

    protected function addRelationConditionToFilter($filterParams, $itemAttr, $relationPath, & $filter) {
        $relGateway = $this->getGatewayByRelAttr($itemAttr);
        if (!$relGateway instanceof self || !in_array($relGateway->getFieldByAttr($relationPath), self::$mainFields)) {
            return false;
        }
        $operator = $filterParams['operator'];
        $value = $filterParams['value'];
        $bxCond = $operator.$this->fieldByAttrForRequestFilter($itemAttr);
        if ($relGateway->getFieldByAttr($relationPath) != 'ID') {
            $bxCond .= '.'.$relGateway->getFieldByAttr($relationPath);
        }
        $filter[$bxCond] = $value;
        return true;
    }

    /**
     * Преобразование имени поля для подстановки в фильтр битрикса ('PROPERTY_')
     * @param string $field
     * @return string
     */
    protected function convertFieldToPropertyForRequest($field) {
        return 'PROPERTY_'.strtoupper($field);
    }

    protected function convertFieldToPropertyForDbResult($field) {
        $postfix = '_VALUE';
        if ($this->propertyParams[$field]['type'] == self::PROPERTY_TYPE_LIST && !$this->propertyParams[$field]['isMultiple']) {
            $postfix = '_ENUM_ID';
        }
        return $this->convertFieldToPropertyForRequest($field).$postfix;
    }

    /**
     * Признак того что аттрибут сущности является элементом цены торгового каталога
     * @param string $attr 
     * 
     * @return boolean
     */
    private function isPriceRelation($attr) {
        $attrConfig = parent::getFieldByAttr($attr);
        return is_array($attrConfig) && $attrConfig['type'] == 'price';
    }

    private function getPriceTypeId($attr) {
        $entityClass = $this->getEntityClass();
        if (!$this->isPriceRelation($attr)) {
            throw new \Exception("Price id is not available for attr `$attr`".
                    " of entity `$entityClass`");
        }
        $attrConfig = parent::fieldByAttrForRequest($attr);
        $priceTypeId = $attrConfig['id'];
        if (is_null($priceTypeId) || !is_integer($priceTypeId)) {
            throw new \Exception("Price id is not available for attr `$attr` of entity `$entityClass`");
        }
        return $priceTypeId;
    }

    /**
     * Используется в запросе на выборку определенных полей
     * (необходим при синхронизации с торговым каталогом)
     *
     * @param string $attr
     * @return string
     */
    protected function fieldByAttrForRequestRelatedItem($attr) {
        if (!$this->isPriceRelation($attr)) {
            return parent::fieldByAttrForRequestRelatedItem($attr);
        }
        return 'CATALOG_GROUP_'.$this->getPriceTypeId($attr);
    }
    
    protected function fieldByAttrForRequestOrder($attr) {
        // необходима проверка того, что аттрибут является ценой
        list($relAttr, $attrProperty) = $this->explodeRelation($attr);
        if (!is_null($attrProperty) && $this->isPriceRelation($relAttr)) {
            $priceField = '';
            switch ($attrProperty) {
                case 'currency': $priceField = 'CURRENCY';
                    break;
                case 'value': $priceField = 'PRICE';
                    break;
                default : throw new \Exception("Sort field is not available");
            }
            return 'CATALOG_'.$priceField.'_'.$this->getPriceTypeId($attr);
        }
        return parent::fieldByAttrForRequestOrder($attr);
    }

    protected function fieldByAttrForRequestFilter($attr) {
        return $this->fieldByAttrForRequestOrder($attr);
    }


    protected function getAttrValue($attr, $gwAssoc) {
        $type = $this->attrs[$attr][0];
        if ($this->isPriceRelation($attr)) {
            if ($type != 'BitrixEntity_Price' && !in_array('BitrixEntity_Price', class_parents($type))) {
                throw new \Exception("In entity declare `{$this->getEntityClass()}` attr `{$attr}` is used as price".
                    ", but attr type doesn't have price type `$type`");
            }
            $price = new $type;
            $catalogPriceTypeId = $this->getPriceTypeId($attr);
            $price->value = $gwAssoc['CATALOG_PRICE_'.$catalogPriceTypeId];
            $price->currency = $gwAssoc['CATALOG_CURRENCY_'.$catalogPriceTypeId];
            return $price;
        }
        return parent::getAttrValue($attr, $gwAssoc);
    }

    
    protected function fieldByAttrForRequest($attr) {
        $parentConvert = parent::fieldByAttrForRequest($attr);
        if(is_string($parentConvert) && in_array(strtoupper($parentConvert), self::$mainFields)) {
            return strtoupper($parentConvert);
        }
        return $this->convertFieldToPropertyForRequest($parentConvert);
    }
    
    protected function fieldByAttrForHydrate($attr) {
        // Возможно придется учитывать типы полей для правильного приобразования.
        $parentConvert = strtoupper($resConvert = parent::fieldByAttrForHydrate($attr));
        if (in_array($parentConvert, self::$mainFields)) {
            return $parentConvert;
        }
        return $this->convertFieldToPropertyForDbResult($resConvert);
    }

    /**
     * @return string
     */
    protected function setupFilterClass() {
        return \WS\Tools\ORM\Db\Filter\IblockElement::className();
    }

    protected function processingFieldResultValue($field, $value) {
        if (
            !in_array($field, self::$mainFields) &&
            $this->propertyParams[$field]['type'] == self::PROPERTY_TYPE_LIST &&
            $this->propertyParams[$field]['isMultiple']
            ) {
            return array_keys($value);
        }
        return parent::processingFieldResultValue($field, $value);
    }

    
    /**
     * Возвращает идентификатор инфоблока.
     * @return integer
     */
    public function iblockId() {
        return $this->iblockId;
    }

    /**
     * Обновление полей бд
     *
     * @param $id
     * @param $fields
     * @return mixed
     */
    protected function updateRow($id, $fields) {
        $bxIb = new \CIBlockElement();
        $res = $bxIb->Update($id, $fields);
        if (!$res) {
            throw new SaveException($bxIb->LAST_ERROR);
        }
        if ($this->fileProperties) {
            foreach ($this->fileProperties ?: array() as $propertyName) {
                $this->applyFilesToRow($propertyName, $fields[$propertyName], $fields['ID']);
                unset($fields[$propertyName]);
            }
        }
        \CIBlockElement::SetPropertyValuesEx($id, $this->iblockId(), $fields);
    }

    /**
     * Вставка полей в базу данных
     *
     * @param $fields
     * @return mixed
     */
    protected function insertRow($fields) {
        $bxIb = new \CIBlockElement();
        $fields['IBLOCK_ID'] = $this->iblockId();
        $res = $bxIb->Add($fields);
        if (!$res) {
            throw new SaveException($bxIb->LAST_ERROR);
        }
        if ($this->fileProperties) {
            foreach ($this->fileProperties ?: array() as $propertyName) {
                $this->applyFilesToRow($propertyName, $fields[$propertyName], $res);
                unset($fields[$propertyName]);
            }
        }
        \CIBlockElement::SetPropertyValuesEx($res, $this->iblockId(), $fields);
        return $res;
    }

    /**
     * @param $attr
     * @return Collection
     * @throws \Exception
     */
    public function getEnumVariants($attr) {
        $attrData = $this->attrs[$attr];
        if (ltrim($attrData[0], '\\') != EnumElement::className()) {
            throw new \Exception("Attr `'.$attr.'('.($attrData[0]).')` doesn't have list type");
        }
        $field = $this->attrsToFields[$attr];
        $arProperty = \CIBlockProperty::GetList(array(), array('IBLOCK_ID' => $this->iblockId(), 'CODE' => $field))->Fetch();
        if (!$arProperty) {
            throw new \Exception('Iblock property `'.$this->iblockId().'` as code `'.$field.'` not exists');
        }

        $gw = $this->getGatewayByEntityClass(EnumElement::className());
        return $gw->find(
            array(
                array('attr' => 'propertyId', 'operator' => '', 'value' => $arProperty['ID']),
            ),
            array('sort' => 'asc', 'value' => 'asc')
        );
    }

    public function getEnumVariant($attr, $code) {
        $attrData = $this->attrs[$attr];
        if (ltrim($attrData[0], '\\') != EnumElement::className()) {
            throw new \Exception('Attr `'.$attr.'('.($attrData[0]).')` is not list');
        }
        $field = $this->attrsToFields[$attr];
        $arProperty = \CIBlockProperty::GetList(array(), array('IBLOCK_ID' => $this->iblockId(), 'CODE' => $field))->Fetch();
        if (!$arProperty) {
            throw new \Exception('Iblock property `'.$this->iblockId().'` as code `'.$field.'` not exists');
        }

        $gw = $this->getGatewayByEntityClass(EnumElement::className());
        return $gw->findOne(
            array(
                array('attr' => 'propertyId', 'operator' => '', 'value' => $arProperty['ID']),
                array('attr' => 'xmlId', 'operator' => '', 'value' => $code),
            ),
            array('value' => 'asc')
        );
    }

    /**
     * @param $propertyName
     * @param $filesIds
     * @param $id
     */
    private function applyFilesToRow($propertyName, $filesIds, $id) {
        global $DB;
        $propertyId = $this->propertyParams[$propertyName]['id'];

        if (!$this->propertyParams[$propertyName]['isMultiple']) {
            $fileId = is_array($filesIds) ? array_shift($filesIds) : $filesIds;
            $DB->Query("
                update
                b_iblock_element_prop_s".$this->iblockId()."
                set PROPERTY_".$propertyId."=".$fileId."
                where IBLOCK_ELEMENT_ID=".$id."
            ");
            return ;
        }

        $toDeleteIds = array();
        $toInsertIds = $filesIds;
        if ($id) {
            $rs = $DB->Query("
                select *
                from b_iblock_element_prop_m".$this->iblockId()."
                where IBLOCK_ELEMENT_ID=".$id."
                AND IBLOCK_PROPERTY_ID=".$propertyId."
            ");
            $storedIds = array();
            while ($arPropValue = $rs->Fetch()) {
                $storedIds[] = $arPropValue['VALUE'];
            }
            $toDeleteIds = array_diff($storedIds, $filesIds);
            $toInsertIds = array_diff($filesIds, $storedIds);
        }
        foreach ($toDeleteIds as $toDeleteId) {
            $DB->Query("
                delete
                from b_iblock_element_prop_m".$this->iblockId()."
                where IBLOCK_ELEMENT_ID=".$id."
                AND IBLOCK_PROPERTY_ID=".$propertyId."
                AND VALUE=".$toDeleteId."
            ");
        }
        foreach ($toInsertIds as $toInsertId) {
            $DB->Query("
                insert
                into b_iblock_element_prop_m".$this->iblockId()."
                (`ID`, `IBLOCK_ELEMENT_ID`, `IBLOCK_PROPERTY_ID`, `VALUE`)
                VALUES (NULL, '".$id."', '".$propertyId."', '".$toInsertId."');
            ");
        }
        // save stored files in single property
        $rs = $DB->Query("
                select *
                from b_iblock_element_prop_m".$this->iblockId()."
                where IBLOCK_ELEMENT_ID=".$id."
                AND IBLOCK_PROPERTY_ID=".$propertyId."
            ");
        $storedIds = array();
        while ($arPropValue = $rs->Fetch()) {
            $storedIds[$arPropValue['ID']] = $arPropValue['VALUE'];
        }
        $serialized = array(
            'ID' => array_keys($storedIds),
            'VALUE' => array_values($storedIds)
        );
        $DB->Query("
                update
                b_iblock_element_prop_s".$this->iblockId()."
                set PROPERTY_".$propertyId."='".serialize($serialized)."'
                where IBLOCK_ELEMENT_ID=".$id."
            ");
    }

    /**
     * @param $entity
     */
    public function remove($entity) {
        \CIBlockElement::Delete($entity->id);
        $entity->id = null;
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
        if (is_null($relPath) && $isRelation) {
            if (Enum::className()  == $this->getGatewayByRelAttr($attr)->className()) {
                $field = str_replace('PROPERTY_', 'PROPERTYSORT_', $field);
                return $field;
            }
        }
        if (!is_null($relPath) && !$isRelation) {
            $entityClass = $this->getEntityClass();
            throw new Exception("Attr call `$attr` as relation, but is not related for `$entityClass`");
        }
        if (is_null($relPath) && $isRelation) {
            throw new Exception("Sort call `$attr` without field");
        }
        return $field;
    }
}
