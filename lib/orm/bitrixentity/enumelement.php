<?php

namespace WS\Tools\ORM\BitrixEntity;

use WS\Tools\ORM\Entity;

/**
 * Елемент типа "список", стандартный cms bitrix
 * 
 * @property  integer  $id          ID            Идентификатор
 * @property  integer  $propertyId  PROPERTY_ID   Идентификатор свойства
 * @property  string   $value       VALUE         Значение элемента
 * @property  boolean  $isDefault   IS_DEFAULT    Признак установки элемента, как элемента по умолчанию
 * @property  integer  $sort        SORT          Индекс сортировки
 * @property  string   $externalId  EXTERNAL_ID   Внешний код
 * @property  string   $xmlId       XML_ID        Внешний код
 *
 * @gateway list
 * @bitrixClass CIBlockPropertyEnum
 *
 * @author Максим Соколовский (my.sokolovsky@gmail.com)
 */
class EnumElement extends Entity {

    public function setIsDefault($value) {
        if (!is_bool($value)) {
            if (in_array($value, array('Y', 'N', null))) {
                $value = $value == 'Y';
            } else {
                throw new \Exception("Неверное устанавливаемое начение `isDefault` сущности {".get_class($this)."} - ".  var_export($value, true));
            }
        }
        $this->_set('isDefault', $value);
        return $value;
    }
}
