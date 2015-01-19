bitrix-ws-tools
====================

Модуль WS-Tools это Инструментарий поддержки проектов компании "Рабочие Решения"


##Установка
```
/bitrix/admin/update_system_partner.php?addmodule=ws.tools
```

##Возможности модуля
###Интерфейс
* Конвертация строковых свойств в списочные или привязка по элементам без потери информации

###Функционал
* Автозагрузчик классов
* Обработка событий, вызов событий

##Использование функицинала
Перед использованием функционала необходимо убедится в том, что модуль проинициализирован
```php
<?php
CModule::IncludeModule('ws.tools');
```

После этого становятся доступны все классы модуля
###Фасад модуля, далее модуль
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

###Загрузка классов
Автоматическая загрузка классов происходит после регистрации каталога хранения классов в загрузчике модуля. Для получения загрузчика есть специальный метод *classLoader*
```php
<?php
CModule::IncludeModule('ws.tools');
$toolsModule = WS\Tools\Module::getInstance();
$classLoader = $toolsModule->classLoader();
$classLoader->registerFolder(__DIR__.'/classes');
```
Означает, что для поиска классов зарегистрирован каталог classes, находящийся в текущем каталоге файла

Классы подключаются по следующим правилам
* namespace класса помечается как путь к каталогу класса
* имя файла класса определяется как название

Таким образом класс *Custom\Network\Model* должен находится по следующему пути: *__DIR__.'Custom\Network\Model.php'*, где *__DIR__* - зарегистрированный каталог подключения классов

###Обработка событий, вызов событий
Доступ к менеджеру событий
```php
<?php
CModule::IncludeModule('ws.tools');
$toolsModule = WS\Tools\Module::getInstance();
$eventManager = $toolsModule->eventManager();
```
На данный момент не реализавана возможность работы с данными по ссылке (модификация данных) 

####1. Инициализация типа события
Тип события определяется классом *\WS\Tools\Events\EventType*.
Типы событий главного модуля, инфоблоков и интернет магазина определены в виде констант, к примеру *\WS\Tools\Events\EventType::MAIN_PROLOG*  
```php
<?php
$eventManager = $toolsModule->eventManager();
$eventType = \WS\Tools\Events\EventType::create(\WS\Tools\Events\EventType::MAIN_PROLOG);
```

Для инициализаций других типов событий, необходимо прописать имя модуля и тип события при инициализации объекта, в методе *createByParams*  
```php
<?php
$eventManager = $toolsModule->eventManager();
$eventType = \WS\Tools\Events\EventType::createByParams("main", "OnPrologBefore");
$eventManager->subscribe($eventType, function ($arg1) {
    // код обработчика
});
```

####2. Регистрация обработчика события
Следующий код регистрирует обработчика события "OnProlog" модуля "main"
```php
<?php
$eventManager = $toolsModule->eventManager();
$eventType = \WS\Tools\Events\EventType::create(\WS\Tools\Events\EventType::MAIN_PROLOG);
$eventManager->subscribe($eventType, function ($arg1) {
    // код обработчика
});
```

####3. Собственный вызов события
Вызов события "OnProlog" модуля "main", так же будут вызваны все обработчики зарегистрированные не через модуль инструментов
```php
<?php
$eventManager = $toolsModule->eventManager();
$eventType = \WS\Tools\Events\EventType::create(\WS\Tools\Events\EventType::MAIN_PROLOG);
$eventManager->trigger($eventType);
```
