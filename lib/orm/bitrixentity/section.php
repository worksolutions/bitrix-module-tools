<?php

namespace WS\Tools\ORM\BitrixEntity;

use WS\Tools\ORM\Entity;

/**
 * Iblock section entity
 *
 * @property integer              $id             ID section id
 * @property string               $code           section code
 * @property string               $externalId     external identifier
 * @property string               $xmlId          external identifier
 * @property integer              $iblockId       iblock identifier
 * @property \WS\Tools\ORM\BitrixEntity\Section $parent         parent section identifier
 * @property \WS\Tools\ORM\DateTime $modifiedDate   last updatedate
 * @property integer              $sort           sort (in group)
 * @property string               $name           name
 * @property string               $isActive       activity (Y|N)
 * @property string               $isGobalsActive global activity (includes parent groups) (Y|N). Automatically (can't be updated manually)
 * @property File                 $picture
 * @property string               $description    description
 * @property string               $descriptionType description type(text/html)
 * @property integer              $leftMargin     left group margin. Automatically (can't be updated manually)
 * @property integer              $rightMargin    right group margin. Automatically (can't be updated manually)
 * @property integer              $depthLevel     The nesting level group. Automatically (can't be updated manually)
 * @property string               $pageUrl        Template URL-a page for a detailed view of section. Parameters determined from the information unit. Changes automatically
 * @property User                 $modifiedBy     user modified
 * @property \WS\Tools\ORM\DateTime             $dateCreate     create date
 * @property User                 $createdBy      create user
 * @property File                 $detailPicture  detailpicture
 *
 * @gateway common
 *
 * @author my.sokolovsky@gmail.com
 */
class Section extends Entity {
}
