<?php

namespace WS\Tools\ORM\BitrixEntity;

use WS\Tools\ORM\Entity;

/**
 * Element "list", cms bitrix
 * 
 * @property integer $id          ID            Identifier
 * @property integer $propertyId  USER_FIELD_ID Property identifier
 * @property string  $value       VALUE         Value
 * @property boolean $isDefault   DEF           Is default value
 * @property integer $sort        SORT          Sort
 * @property string  $xmlId       XML_ID        External identifier
 *
 * @gateway list
 * @bitrixClass CUserFieldEnum
 *
 */
class PropEnumElement extends Entity {
}
