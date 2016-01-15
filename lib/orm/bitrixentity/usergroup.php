<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\ORM\BitrixEntity;

use WS\Tools\ORM\Entity;
/**
 * Entity "UserGroup"
 *
 * @property integer                 $id          ID            Identifier
 * @property \WS\Tools\ORM\DateTime  $date        TIMESTAMP_X   Update date
 * @property string                  $active      ACTIVE        Activity
 * @property string                  $name        NAME          Name
 * @property string                  $description DESCRIPTION   Description
 * @property string                  $sort        C_SORT        Sort index
 * @property string                  $code        STRING_ID     String identifier
 *
 * @gateway user
 * @bitrixClass CGroup
 **/
class UserGroup extends Entity {
}
