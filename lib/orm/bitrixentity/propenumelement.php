<?php

namespace WS\Tools\ORM\BitrixEntity;

use WS\Tools\ORM\Entity;

/**
 * Елемент типа "список", стандартный cms bitrix
 * 
 * @property integer $id          ID            Идентификатор
 * @property integer $propertyId  USER_FIELD_ID Идентификатор свойства
 * @property string  $value       VALUE         Значение элемента
 * @property boolean $isDefault   DEF           Признак установки элемента, как элемента по умолчанию
 * @property integer $sort        SORT          Индекс сортировки
 * @property string  $xmlId       XML_ID        Внешний код
 *
 * @gateway list
 * @bitrixClass CUserFieldEnum
 *
 */
class PropEnumElement extends Entity {
}
