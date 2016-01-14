<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\ORM\BitrixEntity;

use WS\Tools\ORM\Entity;
/**
 * Сущность "Пользователь"
 *
 * @property integer                 $id          ID            Идентификатор
 * @property \WS\Tools\ORM\DateTime  $date        TIMESTAMP_X   Дата измнения
 * @property string                  $active      ACTIVE        Активность
 * @property string                  $name        NAME          Наименование группы
 * @property string                  $description DESCRIPTION   Описание
 * @property string                  $sort        C_SORT        Индекс сортировки
 * @property string                  $code        STRING_ID     Символьный код
 *
 * @gateway user
 * @bitrixClass CGroup
 **/
class UserGroup extends Entity {
}
