<?php
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

namespace WS\Tools\Conversion;


use Bitrix\Main\DB\Exception;
use CDBResult;
use CIBlockType;

class ConversionPropertyIBlock {

    /**
     * @return array
     * @throws Exception
     */
    public static function getListTypesIBlocks() {

        $result = array(
            "REFERENCE" => array(),
            "REFERENCE_ID" => array()
        );

        /** @var CDBResult $listTypeIBlock */
        $listTypeIBlock = CIBlockType::GetList();

        if(!$listTypeIBlock) {
            throw new Exception();
        };

        foreach($listTypeIBlock->arResult as $iBlock) {
            $result["REFERENCE"][] = $iBlock['ID'];
            $result["REFERENCE_ID"][] = $iBlock['ID'];
        }

        return $result;
    }

    /**
     * @return array
     */
    public static function getListIBlocks() {

        $result = \CIBlock::GetList();
        $arrayIBlocks = array();
        $count = $result->SelectedRowsCount();

        while($count--) {
            array_push($arrayIBlocks, $result->GetNext());
        }

        return $arrayIBlocks;
    }

    public static function getListPropertyIBlockByID($id) {
        $listProperties = array();
        $result = \CIBlock::GetProperties($id, array(), array("CHECK_PERMISSIONS" => 'N'));

        $count = $result->SelectedRowsCount();
        while($count--) {
            if($res = $result->NavNext()) {
                array_push($listProperties, $res);
            }
        }

        return $listProperties;
    }


}