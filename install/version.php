<?php
/**
 * @author Sabirov Ruslan <sabirov@worksolutions.ru>
 */

$fileName = __DIR__.'/version.php';

$arModuleVersion = [
    'VERSION' => '1.0.0',
    'VERSION_DATE' => date('Y-m-d', filemtime($fileName)),
];