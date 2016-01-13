## [Главная страница](../README.md)

## Использование функционала
Перед использованием функционала необходимо убедится в том, что модуль проинициализирован
```php
<?php
CModule::IncludeModule('ws.tools');
```

После этого становятся доступны все классы модуля
### Фасад модуля, далее модуль
Все сервисы модуля, такие как загрузчик классов и менеджер событий, доступны через главный объект "одиночку" модуля, доступен через вызов
```php
<?php
CModule::IncludeModule('ws.tools');
$toolsModule = WS\Tools\Module::getInstance();
```

Доступ ко всем сервисам происходит через метод модуля *getService($name)*
```php
<?php
CModule::IncludeModule('ws.tools');
$toolsModule = WS\Tools\Module::getInstance();
$classLoader = $toolsModule->getService('classLoader');
```

### Конфигурация инициализация модуля в приложении

```php
<?php

// init config
$wsTools = WS\Tools\Module::getInstance();
$wsTools->classLoader()->configure(require __DIR__ . '/autoload.php');
$config = array(
    // определение сервисов
    "services" => array(
      // название сервиса
      'local' => array(
          // класс сервиса
          'class' => \Domain\Local::className(),
          // параметры
          'params' => array(
              'dir' => __DIR__.DIRECTORY_SEPARATOR.'langs'.DIRECTORY_SEPARATOR.LANGUAGE_ID
          )
      )
    )
);
$wsTools->config($config);
```

Этот код необходимо поместить в файл инициализации проекта, обычно это ```init.php```
