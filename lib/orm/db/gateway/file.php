<?php

namespace WS\Tools\ORM\Db\Gateway;

/**
 * File definition
 *
 * @author my.sokolovsky@gmail.com
 */
class File extends Common {

    protected function setupFilterClass() {
        return \WS\Tools\ORM\Db\Filter\File::className();
    }

    /**
     * @param $path
     * @return \WS\Tools\ORM\BitrixEntity\File|null
     * @throws \Exception
     */
    public function createByTemporaryPath($path) {
        $file = \CFile::MakeFileArray($path);
        $fileId = \CFile::SaveFile($file, '/upload/');
        if ($fileId) {
            $filter = $this->createFilter()->equal('id', $fileId)->toArray();
            return $this->findOne($filter);
        }
        return null;
    }
}
