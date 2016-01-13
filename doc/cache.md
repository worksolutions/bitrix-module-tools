#### [Главная страница](../README.md)

## Кэширование данных
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

#### [Главная страница](../README.md)
