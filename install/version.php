<?php
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

$fileName = __DIR__.'/version.php';

$arModuleVersion = array(
    'VERSION' => '1.0.1',
    'VERSION_DATE' => date('Y-m-d', filemtime($fileName))
);