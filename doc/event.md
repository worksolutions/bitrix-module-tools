#### [Главная страница](../README.md)

## События. Обработка, вызов
Поддержка событийной модели в системе очень удобный прием ее декомпозиции и облегчения разделения уровней логической схемы.
Из этого следует, что действия которые не находятся в основном процессе работы приложения нужно определять через систему событий.
К примеру отправка почтовых уведомлений при оплате заказа, обновление кэша каталога товаров при обновлении нового товара и таких примеров множество.
Для `WS\Tools` работа с событиями происходит при помощи посредника менеджера событий `\WS\Tools\Events\EventsManager`. Обработка событий заключает два этапа, это:

1. Подписка обработчиков на события системы
2. Вызов событий системы с параметрами (обытно выполняется ядром 1С-Битрикс)

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

```Замечание: по ссылке возможно принимать только первый параметр в методе processReference, при этом метод processReference обязательно необходимо объявить с получением первого параметра по ссылке```

####3. Вызов события
Вызов события "OnProlog" модуля "main", так же будут вызваны все обработчики зарегистрированные не через модуль `WS\Tools`
```php
<?php
$eventManager = $toolsModule->eventManager();
$eventType = \WS\Tools\Events\EventType::create(\WS\Tools\Events\EventType::MAIN_PROLOG);
$eventManager->trigger($eventType);
```
#### [Главная страница](../README.md)
