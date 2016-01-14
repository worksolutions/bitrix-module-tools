<?php

namespace WS\Tools\ORM\BitrixEntity;

use WS\Tools\ORM\Entity;

/**
 * Сущность типа File
 *
 * @property integer     $id                ID              Идентификатор
 * @property string      $name              FILE_NAME       Имя на диске сервера
 * @property string      $description       DESCRIPTION     Описание
 * @property string      $originalName      ORIGINAL_NAME   Имя до момента загрузки на сервер
 * @property \DateTime   $modificationDate  TIMESTAMP_X     Дата изменения
 * @property integer     $height            HEIGHT          Высота (если графический)
 * @property integer     $width             WIDTH           Ширина (если графический)
 * @property integer     $size              FILE_SIZE       Размер в байтах
 * @property string      $type              CONTENT_TYPE MIME тип
 * @property string      $subdir            SUBDIR          Подкаталог в котором находится файл на диске
 *
 * @gateway file
 * @bitrixClass CFile
 *
 * @author Максим Соколовский (my.sokolovsky@gmail.com)
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
