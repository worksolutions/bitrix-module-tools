## [Главная страница](../README.md)

### Загрузка классов
Автоматическая загрузка классов происходит после регистрации каталога хранения классов в загрузчике модуля. 
Конфигурация загрузчика классов. В параметрах с ключом `autoload` указывается конфигурация для драйверов автозагрузки
классов.
```php
<?php

$toolsModule = WS\Tools\Module::getInstance();
$toolsModule->classLoader()->configure(
    array(
       "psr4" => array(
           "Local\\" => __DIR__ . DIRECTORY_SEPARATOR . "lib",
           "Multiply\\Space\\Dirs\\" => array(
               __DIR__ . "/lib2",
               __DIR__ . "/lib3"
           )
           // ...
       ),
       "psr0" => array(
           "Old\\Namespaces\\" => __DIR__ . "/vendor",
           // ...
       )
   )
);
$toolsModule->config($config);
```
Для получения загрузчика есть специальный метод *classLoader*
```php
<?php
CModule::IncludeModule('ws.tools');
$toolsModule = WS\Tools\Module::getInstance();
$classLoader = $toolsModule->classLoader();
$classLoader->getDriver('psr4')->registerPathByNamespace(__DIR__ . '/local/lib', "Local\\");
```
Означает, что для поиска классов зарегистрирован каталог `__DIR__ . '/local/lib'`

На данный момент поддерживаются следующие драйверы для автозагрузки:
* [PSR-0](http://www.php-fig.org/psr/psr-0/ru/)
* [PSR-4](http://www.php-fig.org/psr/psr-4/ru/)
