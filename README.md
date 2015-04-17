bitrix-ws-tools
====================

Модуль WS-Tools это Инструментарий поддержки проектов компании "Рабочие Решения"


##Установка
В адресной строке браузера относительно домена ввести строку:
```
/bitrix/admin/update_system_partner.php?addmodule=ws.tools
```

## Возможности модуля
### Интерфейс
* Конвертация строковых свойств в списочные или привязка по элементам без потери информации

### Функционал
* Автозагрузчик классов
* События. Обработка, вызов
* Простой механизм логирования данных
* Кэширование информации
* Централизованный доступ к сервисам приложения через мехонизм `ServicesLocator`

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

### Конфигурация модуля в приложении

 В процессе заполнения.

### Загрузка классов
Автоматическая загрузка классов происходит после регистрации каталога хранения классов в загрузчике модуля. 
Конфигурация загрузчика классов. В параметрах с ключом `autoload` указывается конфигурация для драйверов автозагрузки
классов.
```php
<?php
$config = array(
    "autoload" => array(
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
    ),
    "services" => array(
    // ...
    )
);

CModule::IncludeModule('ws.tools');
$toolsModule = WS\Tools\Module::getInstance();
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


###События. Обработка, вызов
Поодержка событийной модели в системе очень удобный прием ее декомпозиции и облегчения разделения уровней логической схемы.
Из этого следует, что действия которые не находятся в основном процессе работы приложения нужно определять через систему событий.
К примеру отправка полчтовых уведомлений при оплате заказа, обновление кэша каталога товаров при обавлении нового товара и таких примеров множество.
Для `WS\Tools` работа с событиями происходит при помощи посредника менеджера событий `\WS\Tools\Events\EventsManager`. Обработка событий заключает два этапа, это:

1. Подписка обработчиков на события системы
2. Вызов собыитий системы с параметрами (обытно выполняется ядром 1С-Битрикс)

Доступ к менеджеру событий
```php
<?php
CModule::IncludeModule('ws.tools');
$toolsModule = WS\Tools\Module::getInstance();
$eventManager = $toolsModule->eventManager();
```
Реализована возможность работы с данными по ссылке (модификация данных)

####1. Типы событий
Тип события определяется классом *\WS\Tools\Events\EventType*.
Типы событий главного модуля, инфоблоков и интернет магазина определены в виде констант, к примеру `\WS\Tools\Events\EventType::MAIN_PROLOG`  
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

####2. Обработчики
Следующий код регистрирует обработчика события "OnProlog" модуля "main"
```php
<?php
$eventManager = $toolsModule->eventManager();
$eventType = \WS\Tools\Events\EventType::create(\WS\Tools\Events\EventType::MAIN_PROLOG);
$eventManager->subscribe($eventType, function ($arg1) {
    // код обработчика
});
```

##### Типы обработчиков

Для удобной поддержки проекта можно использовать следующие типы обработчиков

######1. Регистрация объявленной функции
```php
<?php
$eventManager = $toolsModule->eventManager();
$eventType  = \WS\Tools\Events\EventType::create(\WS\Tools\Events\EventType::MAIN_END_BUFFER_CONTENT);
// named function
function __callWs(& $content) {
	$content = 'callWs';
}
$em->subscribe($eventType, '__callWs');
```

######2. Регистрация безымянной функции
```php
<?php
$eventManager = $toolsModule->eventManager();
$eventType  = \WS\Tools\Events\EventType::create(\WS\Tools\Events\EventType::MAIN_END_BUFFER_CONTENT);
// closure function
$em->subscribe($eventType, function (& $content) {
    $content = 'Closure';
}));
```

######3. Регистрация статического метода класса
```php
<?php
$eventManager = $toolsModule->eventManager();
$eventType  = \WS\Tools\Events\EventType::create(\WS\Tools\Events\EventType::MAIN_END_BUFFER_CONTENT);
//class static method
abstract class SomeClass {
	static public function callWs(& $content) {
		$content = __METHOD__;
	}
}
$em->subscribe($eventType, array('SomeClass', 'callWs'));
```

######4. Регистрация объекта специального класса обработчика
```php
<?php
$eventManager = $toolsModule->eventManager();
$eventType  = \WS\Tools\Events\EventType::create(\WS\Tools\Events\EventType::MAIN_END_BUFFER_CONTENT);
class MyHandler extends \WS\Tools\Events\CustomHandler {
	public function processReference(& $content) {
		$content = __METHOD__;
	}
}
$em->subscribe($eventType, new MyHandler());
```

или

```php
<?php
$eventManager = $toolsModule->eventManager();
$eventType = \WS\Tools\Events\EventType::create(\WS\Tools\Events\EventType::MAIN_PROLOG);
class MySimpleHandler extends \WS\Tools\Events\CustomHandler {
    protected function log() {
        $toolsModule->getLog('PROLOG_START');
    }
	public function process() {
	    $this->log('prolog start ' . time());
	}
}
$em->subscribe($eventType, new MySimpleHandler());
```
**Внимание** классы должны находится в отдельных файлах, приведенные примеры используются сугубо для обформления

###### Создание специального класса обработчика
Класс обработчика должен находится в общем каталоге хранения классов проекта и быть унаследованным от `\WS\Tools\Events\CustomHandler`

```php
<?php
class MyHandler extends \WS\Tools\Events\CustomHandler {
    private $_iblockId;
    /**
     * Метод определяет целесообразность вызова обработчика
     **/
    public function identity() {
        $params = $this->getParams();
        $iblockId = $this->params[0];
        if ( != IBLOCK_NEWS) {
            return false;
        }
        $this->_iblockId = $iblockId;
        return true;
    }
	public function process() {
	    // handle process iblock 
	}
}
```

Пример класса обработчика с параметрами передаваемыми по ссылке: 
```php
<?php
class MyHandler extends \WS\Tools\Events\CustomHandler {
    /**
     * Метод определяется когда к параметрам необходимо получить доступ по ссылке 
     **/
	public function processReference(& $content) {
		$content = str_replace('#MARK#', date('Y-m-d'), $content);
	}
}
```

####3. Вызов события
Вызов события "OnProlog" модуля "main", так же будут вызваны все обработчики зарегистрированные не через модуль `WS\Tools`
```php
<?php
$eventManager = $toolsModule->eventManager();
$eventType = \WS\Tools\Events\EventType::create(\WS\Tools\Events\EventType::MAIN_PROLOG);
$eventManager->trigger($eventType);
```

### Логирование информации
Основой функционала логирования является [Журнал событий](https://dev.1c-bitrix.ru/community/webdev/user/11948/blog/2647/). Он позволяет журналировать собщения различного характера.
Модуль WS\Tools упрощает данную процедуру.
Пример помещения текста в Журнал событий:

```php
<?php
$log = $toolsModule->getLog("MY_CUSTOM_TYPE");
$log->severity(\WS\Tools\Log::SEVERITY_INFO)
    ->itemId(15)
    ->description("Обработка добавления элемента каталога в корзину")
    ->put();
```

Таким образом в примере выше в Журнал событий была добавлена запись произвольного типа "MY_CUSTOM_TYPE", с описанием "Обработка добавления элемента каталога в корзину", идентификатор элемента 15.

Теперь по поядку использование методов и их параметров:

* метод `getLog($type)` фасада модуля, осуществляет доступ к новому экземпляру класса логирования, где параметр `$type` определяет тип сообщения, к примеру для работы с добавлением в корзину элемента можно указать тип "ELEMENT_BASKET_ADD", его название произвольно в приложении. Зарание подготовленные типы доступны в константах `WS\Tools\Log::AUDIT_TYPE_..`
* метод `severity($value)` экземпляра логирования, задание уровня сообщения. Все уровни доступны через константы `WS\Tools\Log::SEVERITY_..`
* существуют вспомогательные методы более простого определения уровня сообщения:
+ `severityAsSecurity()` определяет сообщение как сообщение уровня безопасности. 
+ `severityAsError()` определяет сообщение как сообщение уровня ошибки. 
+ `severityAsWarning()` определяет сообщение как сообщение уровня предупреждения. 
+ `severityAsInfo()` определяет сообщение как сообщение информационного уровня. 
+ `severityAsDebug()` определяет сообщение как сообщение уровня отладки.
* `itemId($value)` устанавлевает идентификатор логируемого объекта, необязательный. Удобно использовать когда необходимо в журнале событий найти объект по идентификатору.
* `description($value)` установка описания записи, `$value` может принимать значения скаляра, массива или объекта
* `put()` отправляет сформированный объект на запись в Журнал событий

Функционал логирования поддерживает типы событий уровня ядра, например:

```php
<?php
$log = $toolsModule->getLog(\WS\Tools\Log::AUDIT_TYPE_IBLOCK_EDIT);
$log->severity(\WS\Tools\Log::SEVERITY_INFO)
    ->itemId(15)
    ->description("Обработка редактирования элемента инфоблока при вызове некого компонента")
    ->put();
```

Это означает то, что в Журнале событий колонки ITEM_ID появится запись элемента `15` со ссылкой на редактирование, а вместо кода `IBLOCK_EDIT` , будет сообщение `Изменен инфоблок`

Для получения описания типа сообщения существует событие 1С-Битрикс "OnEventLogGetAuditTypes" модуля "main". Обработчик должен фернуть массив пар ключ значение, где ключом будет являться код типа, а значением его описание. Можно также воспользоваться менеджером событий `WS\Toools`

```php
<?php
$eventManager = $toolsModule->eventManager();
$eventType = \WS\Tools\Events\EventType::create(\WS\Tools\Events\EventType::MAIN_EVENT_LOG_GET_AUDIT_TYPES);
$eventManager->subscribe($eventType, function () {
    return array(
        'MY_CUSTOM_TYPE' => "Пользовательский тип собщения"
    );
});
```

Пример, добавление сообщения об ошибке:

```php
<?php
// объект журналирования
$log = $toolsModule->getLog("WS_PROJECT_DEBUG_ERRORS");
// уровень сообщения
$log->severity(\WS\Tools\Log::SEVERITY_ERROR)
    // описание сообщения
    ->description("Обработка обработки почтового отправления, код {$postCode}")
    // сохранение сообщения
    ->put();
```

### Кэширование данных
Использование механизма кэширования из коробки Битрикса требует глубокого понимания использования.
Например практически невозможно интуитивно понять что точно делает метод `\Bitrix\Main\Data\Cache::startDataCache` с (внимание!) пятью параметрами.
На самом деле он проверяет есть ли буферизованный кэш и если его не оказалось включает буферизацию вывода. 
Тут же можно проинициализировать массив данных для использования в кеше. Такой клубок функционала программист разматывает каждый раз перед использованием кэширования данных.
`WS\Tools` предлагает упрощенную и более понятную схему кэширования данных. 

Пример (кэширование массива данных):

```php
<?php
CModule::IncludeModule('ws.tools');
$module = \WS\Tools\Module::getInstance();
// менеджер кэширования
$cm = $module->cacheManager();

//запись в кэш
$arrayWriteCache = $cm->getArrayCache('key_cache', 3000 /* cache time */);
$arrayWriteCache->set(array(
	'one', 'two', 'tree'
));

// получение данных 
$arrayReadCache = $cm->getArrayCache('key_cache', 3000);
var_dump($arrayReadCache->get() == array('one', 'two', 'tree'));
```

Кэширование вывода:

```php
<?php
CModule::IncludeModule('ws.tools');
$module = \WS\Tools\Module::getInstance();
// менеджер кэширования
$cm = $module->cacheManager();
// получение объекта кэширования вывода
$recordCache = $cm->getContentCache('testKeyCache', 200);
// проверка актуальности данных кэша
if ($recordCache->isExpire()) {
    // в случае если данные не актуальны, произведение записи новых данных
    $recordCache->record();
    echo "1222";
    // сохранение с запретом вывода данных в поток
    $recordCache->save(false);
}
// вывод в поток
echo $gettingCache->content();
```

Для реализации кэширования используются два класса: `\WS\Tools\Cache\ContentCache` и `\WS\Tools\Cache\ArrayCache`.
Класс `\WS\Tools\Cache\ContentCache` необходимо использовать для сохранения данных потока вывода, он доступен через метод менеджера кэширования `\WS\Tools\Cache\CacheManager::getContentCache`.
Класс `\WS\Tools\Cache\ArrayCache` используется для сохранения массива данных, доступен через метод `\WS\Tools\Cache\CacheManager::getArrayCache`.

При получении объектов кэширования необходимо указать параметры:

* `$key` - ключ кэширования
* `$timeLive` - время жизни кэша

#### Описание методов классов кэширования

###### Общие методы
* `setBxInitDir($value)` папка, в которой хранится кеш компонента, относительно /bitrix/cache/ (необязательный) [подробнее..](http://dev.1c-bitrix.ru/api_help/main/reference/cphpcache/initcache.php)
* `setBxBaseDir($value)` базовая директория кеша. По умолчанию равен cache (необязательный) [подробнее..](http://dev.1c-bitrix.ru/api_help/main/reference/cphpcache/initcache.php)
* `clear()` очистка хранимого кэша
* `isExpire()` проверка актуальности хранимого кэша

###### ArrayCache
* `get()` получение данных хранимого кэша
* `set($array)` сохранение данныз в кэш

###### ContentCache
* `record()` начало записи кэширования
* `abort()` прерывание записи кэширования, данные записи возвращяются в поток
* `stop($output = false)` сохранние записи кэширования в память, `$output` - параметр указывающий на необходимость направления данных в поток вывода, по умолчанию не распечатывается
* `content()` получение записи кэша ввиде строки
 
### Организация работы с сервисами приложения

Сервисы приложение удобно внедрять для организации повторно используемого кода, когда некий функционал описывается в виде некого класса,
объект которого во время жизни приложения обычно создается единажды, может включать определенные параметры. Подробнее об использовании [Сервис-ориентированой архитектуры](https://ru.wikipedia.org/wiki/%D0%A1%D0%B5%D1%80%D0%B2%D0%B8%D1%81-%D0%BE%D1%80%D0%B8%D0%B5%D0%BD%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%BD%D0%B0%D1%8F_%D0%B0%D1%80%D1%85%D0%B8%D1%82%D0%B5%D0%BA%D1%82%D1%83%D1%80%D0%B0)

#### 1. Доступ к сервису

Доступ к сервису осуществлется при помощи метода модуля `\WS\Tools\Module::getService($name)`, `$name` - имя сервиса.
В следующем примере будет получен доступ к сервису логирования через файл.

```php
<?php
CModule::IncludeModule('ws.tools');
$module = \WS\Tools\Module::getInstance();
$fileLog = $module->getService('myFileLog');
$fileLog->put('error message');
```

#### 2. Огранизация сервиса

Сервис можно определить двумя способами:

1. Указание сервиса с параметрами и зависимостями в настройке
2. Динамическое определение сервиса

##### Параметры конфигурации определения сервисов:
В общей конфигурации модуля сервисы определяются параметрами с ключом `services`.
Параметры определения сервисов состоят из ассоциативного массива, где ключи - имена сервисов, значения - параметры инициализации сервисов.
Параметры инициализации сервисов сосоят из:

* `class` - имя класса сервиса
* `params` - параметры используемые сервисом, будут внедрены при инициализации
* `depends` - зависимости от других сервисов 

При динамическом определении сервиса необходимо получить объект `ServiceLocator`:
```php
<?php
CModule::IncludeModule('ws.tools');
$module = \WS\Tools\Module::getInstance();
$serviceLocator = $module->getServiceLocator();
$serviceLocator->set('myFileLog', array(
    'class' => 'LogToFile',
    'path' => __DIR__.'/dump.log',
    ''
), array('user'));
```

##### Пример использования сервиса
Определим некий класс, который будем использовать в качестве сервиса:
```php
<?php
class LogToFile {
    /**
     * Имеется необходимость использовать класс CurrentUser
     * @var CurrentUser
     **/
    protected $user;
    
    private $_path;

    public function __construct($path) {
        $this->_path = $path;
    }
    
    public function put($content) {
        file_get_contents($this->_path, array(time(), $this->user->name, $content));
    }
}
```

Конфигурация с использованием класса:
```php
<?php
$config = array(
    // установка сервисов с параметрами и зависимостями
    'services'=> array(
        'myFileLog' => array(
            'class' => 'LogToFile',
            'params' => array(
                'path' => __DIR__.'/dump.log'
            ),
            'depends' => array('user')
        ),
        'user' => array(
            'class' => 'CurrentUser'
        )
    )
);

CModule::IncludeModule('ws.tools');
$module = \WS\Tools\Module::getInstance();
$module->config($config);
```

Работа с сервисом в приложении:
```php
<?php
$fileLog = $module->getService('myFileLog');
$fileLog->put('error message');
```

#### 3. Работа с объектом `ServiceLocator`
Работа с объектом `ServiceLocator` напрямую нужно использовать в основном для инициализации объектов-сирот, т.е. те объекты
которые не будут доступны при последующих вызовов получения сервисов.

Получение объекта осуществляется `ServiceLocator` следующим образом:
```php
<?php
$serviceLocator = $module->getServiceLocator();
$log = $serviceLocator->createInstance('log');
```

Методы объекта:

* `set($name, $params = array(), $depends = array())` - динамическая установка параметров инициализации `$params` сервиса $name с зависимостями от сервисов `$depends`.
* `get($name)` - получение сервиса `$name`
* `willUse($name, $object)` - установка объекта `$object` для дальнейшего использования в качестве сервиса `$name`
* `createInstance($name, $params = array(), $depends = array())` - создание экземплара объекта с использованием параметров и зависимостей.
Объект не будет зарегистрирован в `ServiceLocator` для дальнешего использования. Но он может пльзоватся параметрами конфигурации при инициализации.

#### Внедрение зависимостей
Внедрение зависимостей являеются общим паттерном программирования который повышает уровень слабой связанности объектов приложения,
облегчает замену компонентов и упрощает рефакторинг кода. Подробнее о пользе внедрения зависимостей можно прочитать в [статье](http://vladimirsblog.com/laravel-dependency-injection-for-beginners/).

#### Как взаимосвязаны поля класса сервиса и параметры для подстановки в объект?
При инициализации объекта `ServiceLocator` будет его наполнять параметрами и зависимыми сервисами по следующим признакам:
1. При совпадении имени параметра или сервиса в конструкторе класса
2. При совпадении класса сервиса в определении параметра конструктора класса
3. При совпадении свойств класса. Свойства должны быть `protected` или `public`. В `private` свойства параметры не передаются

Пример конфигурации для инициализации параметров:
```php
<?php

// параметры для сервисов
$config = array(
    'services' => array(
        'db' => array(
            'class' => 'DateBase',
            'params' => array(
                'host' => 'localhost',
                'user' => 'user',
            ),
            'depends' => array('shell')
        ),
        'shell' => array(
            'class' => 'CommandLineShell',
            'params' => array(
                'rootDir' => __DIR__.'/../root'
            )
        )
    )
);

// классы сервисов
 
class DateBase {
    
    /**
     * В это свойство будет записан объект CommandLineShell
     * @var CommandLineShell
     **/
    protected $shell;
    
    /**
     * В приватные свойства параметры не записываются
     **/
    private $connectionParams;
    
    public function __construct($host, $user) {
        $this->_connectionParams = array(
            'host' => $host,
            'user' => $user
        );
    }
    
    /**
     * Будет проинициализированно Shell объектом
     **/
    public function getShell() {
        return $this->shell;
    }
}

class CommandLineShell {

    /**
     * При инициализации наполнится параметром сомостоятельно
     **/
    protected $rootDir;
    
    public function getRootDir() {
        return $this->rootDir;
    }
}

CModule::IncludeModule('ws.tools');
$module = \WS\Tools\Module::getInstance();
$module->config($config);

/* @var DateBase */
$db = $module->getService('db');

$db->getShell()->getRootDir(); // /var/www/project/local/root

```

Из примера выше видно, что сервисы инициализируются автоматически с зараниее указанными параметрами.
 
### Базовый класс для агентов

Упрощает процедуру добавления [агента](https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=43&LESSON_ID=3436) в проект

#### Определение класса агента

```php
<?php

class ProjectAgent extends WS\Tools\BaseAgent {

    /**
     * Реализация функционала агента
     **/
    public function algorithm ($offset, $step) {
        // аглоритм функционала
        return array(100, 5); // возвращаются параметры следующего вызова
    }
}

```

#### Установка агента

Вариант добавления через API, основа взята из [документации](http://dev.1c-bitrix.ru/api_help/main/reference/cagent/addagent.php)

```php
<?php
CAgent::AddAgent(
    "ProjectAgent::run(0, 5);",           // имя функции
    "statistic",                          // идентификатор модуля
    "N",                                  // агент не критичен к кол-ву запусков
    86400,                                // интервал запуска - 1 сутки
    "07.04.2005 20:03:26",                // дата первой проверки на запуск
    "Y",                                  // агент активен
    "07.04.2005 20:03:26",                // дата первого запуска
    30);
?>
```