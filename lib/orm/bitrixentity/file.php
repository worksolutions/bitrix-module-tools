<?php

namespace WS\Tools\ORM\BitrixEntity;

use WS\Tools\ORM\Entity;

/**
 * File entity
 *
 * @property integer     $id                ID              Identifier
 * @property string      $name              FILE_NAME       File name
 * @property string      $description       DESCRIPTION     Description
 * @property string      $originalName      ORIGINAL_NAME   Original name(before upload)
 * @property \DateTime   $modificationDate  TIMESTAMP_X     Update date
 * @property integer     $height            HEIGHT          Height (if picture)
 * @property integer     $width             WIDTH           Width (if pictture)
 * @property integer     $size              FILE_SIZE       File size(bites)
 * @property string      $type              CONTENT_TYPE MIME mime type
 * @property string      $subdir            SUBDIR          subdir(includes file)
 *
 * @gateway file
 * @bitrixClass CFile
 *
 * @author my.sokolovsky@gmail.com
 */
class File extends Entity {

    public function getSrc() {
        $arFile =  \CFile::GetFileArray($this->id);
        return $arFile['SRC'];
    }

    public function sizeFormatted() {
        return \CFile::FormatSize($this->size);
    }
}
