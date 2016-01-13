## [Главная страница](../README.md)

## Организация работы с сервисами приложения

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

## [Главная страница](../README.md)
