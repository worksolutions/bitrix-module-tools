<?php

namespace WS\Tools\ORM\BitrixEntity;

use WS\Tools\ORM\Entity;

/**
 * Element "list", cms bitrix
 * 
 * @property  integer  $id          ID            Identifier
 * @property  integer  $propertyId  PROPERTY_ID   Property identifier
 * @property  string   $value       VALUE         Value
 * @property  boolean  $isDefault   IS_DEFAULT    Is default value
 * @property  integer  $sort        SORT          Sort
 * @property  string   $externalId  EXTERNAL_ID   External identifier
 * @property  string   $xmlId       XML_ID        External identifier
 *
 * @gateway list
 * @bitrixClass CIBlockPropertyEnum
 *
 * @author my.sokolovsky@gmail.com
 */
class EnumElement extends Entity {

    public function setIsDefault($value) {
        if (!is_bool($value)) {
            if (in_array($value, array('Y', 'N', null))) {
                $value = $value == 'Y';
            } else {
                throw new \Exception("Incorrect value `isDefault` for entity {".get_class($this)."} - ".  var_export($value, true));
            }
        }
        $this->_set('isDefault', $value);
        return $value;
    }
}
