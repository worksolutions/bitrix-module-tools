<?php

namespace WS\Tools\ORM\BitrixEntity;

use WS\Tools\ORM\Entity;

/**
 * Сущность секции инфоблоков
 *
 * @property integer              $id             ID группы информационного блока
 * @property string               $code           Мнемонический идентификатор
 * @property string               $externalId     Внешний код
 * @property string               $xmlId          Внешний код
 * @property integer              $iblockId       ID информационного блока
 * @property \WS\Tools\ORM\BitrixEntity\Section $parent         Группы родителя, если не задан то группа корневая
 * @property \WS\Tools\ORM\DateTime $modifiedDate   Дата последнего изменения параметров группы
 * @property integer              $sort           Порядок сортировки (среди групп внутри одной группы-родителя)
 * @property string               $name           Наименование группы
 * @property string               $isActive       Флаг активности (Y|N)
 * @property string               $isGobalsActive Флаг активности, учитывая активность вышележащих (родительских) групп (Y|N). Вычисляется автоматически (не может быть изменен вручную)
 * @property File                 $picture
 * @property string               $description    Описание группы
 * @property string               $descriptionType Тип описания группы (text/html)
 * @property integer              $leftMargin     Левая граница группы. Вычисляется автоматически (не устанавливается вручную)
 * @property integer              $rightMargin    Левая граница группы. Вычисляется автоматически (не устанавливается вручную)
 * @property integer              $depthLevel     Уровень вложенности группы. Вычисляется автоматически (не устанавливается вручную)
 * @property string               $pageUrl        Шаблон URL-а к странице для детального просмотра раздела. Определяется из параметров информационного блока. Изменяется автоматически
 * @property User                 $modifiedBy     Пользователь, в последний раз изменивший элемент
 * @property \WS\Tools\ORM\DateTime             $dateCreate     Дата создания элемента
 * @property User                 $createdBy      Пользователь, создавший элемент
 * @property File                 $detailPicture  Картинка детального просмотра
 *
 * @gateway common
 *
 * @author Максим Соколовский (my.sokolovsky@gmail.com)
 */
class Section extends Entity {
}
