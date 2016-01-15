#### [Главная страница](../README.md)

## ORM сервис работы с предметной областью

Наиболее удобным вариантом представления сущностей проекта является их представление в виде объектов. На текщий момент CMS Битрикс не имеет 
встроенную ORM для работы с ее сущностями. Не имея такого инструмента разработчикам приходится работать с данными в 
виде ассоциативных массивов что при водит к частому дублированию логики и частым ошибкам. Сервис ORM позволяет решить проблему 
недостачи подходящего инстумента для работы с данными в виде объектов.

### Особенности

* Определение единой логики поведения объектов предметной области определенной сущности
* Быстрый и удобный доступ к данным во время разработки
* Одна сущность предметной области представлена один экземпляром объекта в приложении, что позволяет избежать рассогласованности данных
* Работа с взаимосвязанными сущностями

### Использование

Следующий пример демонстрирует получение новостей со связими с их авторами, далее идет вывод имен авторов
```php
<?php
CModule::IncludeModule('ws.tools');
$module = \WS\Tools\Module::getInstance();

$orm = $module->orm();

$collection = $orm->createSelectRequest(\Domain\Entity\ShopNews::className())
    ->withRelations(array('author'))
    ->getCollection();

/** @var \Domain\Entity\ShopNews $item */
foreach ($collection as $item) {
    var_dump($item->author->name);
}

```

Т.о выполнено минимум действий. Для получения списка элементов в стандартном api действий потребуется гораздо больше.

### Определение моделей предметной области

Модели предметной области определяются на основе информационных блоков. В административном интерфейсе проекта создается инфоблок, 
а в коде проекта вы воздаете его описание , в виде класса, согласно некоторым правилам.

```php
<?php

namespace Domain\Entity;

/**
 * @property integer $id
 * @property string $name NAME
 * @property string $description DESCRIPTION
 * @property \WS\Tools\ORM\BitrixEntity\User $author
 *
 * @gateway iblockElement
 * @iblockCode shop_news
 */
class ShopNews extends \WS\Tools\ORM\Entity {
}
```

Выше представлена полноценная модель предметной области. Поля модели и ее ассоциация с информационным блоком описываются в 
doc блоке класса. Поля обозначаются через обозначение ```@property``` в блоке.
Класс должен быть унаследован от базового ```\WS\Tools\ORM\Entity```

* ```@property``` описание свойства модели, далее в строке указываются: тип (если сразу после типа определены скобки ```[]``` 
это означает что связь множественная), имя свойства, имя свойства информационного блока.
Если имя свойства инфоблока и модели совпадают без учета регистра 3 параметр можно пропустить
* ```@gateway``` определение шлюза работы с данными для ORM. В основном это всегда будет ```iblockElement```
* ```@iblockCode``` код информационного блока из настроек административного интерфейса, так же вместо этого параметра можно 
использовать ```@iblockId```

### Определение связей

ORM поддерживает следующие типы связей:

* Элемент инфоблока
* Пользователь
* Группа пользователей
* Файл
* Список

Пример определения связей модели:
```php
<?php

namespace Domain\Entity;

/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 *
 * @property integer $id
 * @property string $name
 * @property string $description DESCRIPTION
 * @property MainNews $main MAIN_NEWS
 * @property \WS\Tools\ORM\BitrixEntity\User $author
 * @property \WS\Tools\ORM\BitrixEntity\File $detailPicture DETAIL_PICTURE
 * @property \WS\Tools\ORM\BitrixEntity\Section $section SECTION
 * @property \WS\Tools\ORM\BitrixEntity\UserGroup $group SECTION
 * @property \WS\Tools\ORM\BitrixEntity\EnumElement[] $words
 *
 * @gateway iblockElement
 * @iblockCode shop_news
 */
class ShopNews extends \WS\Tools\ORM\Entity {
}
```

Привязку моделей предметной области необходимо обозначать полными путями либо обозначением классов текщего пространства имен

### Получение объектов

Объекты из базы данных можно полусить двумя сособами

* Прямое обращение через идентификатор
* Через составление запроса

Пример получения объекта по идентификатору:

```php
<?php
CModule::IncludeModule('ws.tools');
$module = \WS\Tools\Module::getInstance();

$orm = $module->orm();

$news = $orm->getById(\Domain\Entity\ShopNews::className(), 12);
```

Получение объектов через запрос:

```php
<?php
CModule::IncludeModule('ws.tools');
$module = \WS\Tools\Module::getInstance();

$orm = $module->orm();

$newRequest = $orm->createSelectRequest(\Domain\Entity\ShopNews::className());
$collection = $newRequest
    ->equal('author.id', 100)
    ->addSort('id', 'desc')
    ->withRelations(array('author', 'detailPicture', 'colors'))
    ->getCollection();

/** @var \Domain\Entity\ShopNews $item */
foreach ($collection as $item) {
    var_dump($item->detailPicture->originalName);
    // во множественных связях коллекция
    /** @var \WS\Tools\ORM\EntityCollection $words */
    $words = $item->words;
    /** @var \WS\Tools\ORM\BitrixEntity\EnumElement $word */
    foreach ($words as $word) {
        var_dump($word->xmlId.' - '.$word->value);
    }
}
```

В предидущем примере сервис ORM сгенерировал запрос для модели ```\Domain\Entity\ShopNews```. Запрос имеет множество вспомагательных методов
для удобного получения реультата

#### Объект запроса

Получение объекта запроса для определенного типа модели:

```php
<?php
$newsRequest = $orm->createSelectRequest(\Domain\Entity\ShopNews::className());
```

Основные методы фильтрации:

* ```equal($path, $value)``` равенство
* ```in($path, $arValues)``` принадлежность к множеству
* ```inRange($path, $from, $to)``` принадлежность к диапазону
* ```notEqual($path, $value)``` неравенство

```$path``` является уточнением свойства модели, если необзодимо указать свойство связанной сущности тогда устанавливается точка ```.```
пример: ```"author.name"```

Сортировка:

* ```addSort($path, $direction)``` сортировка по направлению, $direction: asc, desc

По соображениям производительности связи получаемые в результах запроса необходимо указывать явно:

* ```withRelations($relations)```

Получение результата:

* ```getCollection()``` коллекция объектов запроса ```\WS\Tools\ORM\EntityCollection```
* ```getOne()``` получение одного экземпляра модели
* ```count``` количество элементов результата

### Создание, сохранение, удаление

Пример работы с синхронизацией БД
```php
<?php
// новая модель с сохранением в базу данных
$newNews = new \Domain\Entity\ShopNews();
// наполнение данными
$newNews->name = "News name";
// для связей вместо реальных объектов можно использовать proxy
$newNews->author = $orm->createProxy(\Domain\Entity\ShopNews::className(), 12);

$orm->save(array($newNews));

// редактирование модели предметной области
$savedNews = $orm->getById(\Domain\Entity\ShopNews::className(), 100);

$savedNews->name = "Another name";

$orm->save(array($savedNews));

// удаление модели из базы данных
$savedNews = $orm->getById(\Domain\Entity\ShopNews::className(), 101);

$orm->remove(array($savedNews));

// или

$orm->remove(array(
    $orm->createProxy(\Domain\Entity\ShopNews::className(), 101)
));

```

### Дополнение

В этой части даются некоторые объяснения относительно работы сервиса

#### Получение вариантов знаячений списка конкретного инфоблока

Часто требуется получить все варианты для определенного поля в списке

```php
<?php

/** @var \WS\Tools\ORM\Db\Gateway\IblockElement $shopNewsGateway */
$shopNewsGateway = $orm->getGateway(\Domain\Entity\ShopNews::className());

$allWords = $shopNewsGateway->getEnumVariants('words');

foreach ($allWords as $word) {
    var_dump($word->value);
}

```

#### Работа с proxy оъектами

Иногда возникает необходимость установить связь для модели с другим объектом идентификатор последнего имеется заранее, но
необходимости получения объекта из базы данных нет. В этом случае можно использовать proxy объект для установления связи.

```php
<?php

/** @var \Domain\Entity\ShopNews $news */
$news = $orm->getById(\Domain\Entity\ShopNews::className(), 101);

$news->detailPicture = $orm->createProxy(\WS\Tools\ORM\BitrixEntity\File::className(), 840);

$orm->save(array($news));

```

#### Специальные сущности

Сервис уже содержит некоторые стандартные сущности. Их классы определены в пространстве имен ```\WS\Tools\ORM\BitrixEntity```

* ```User```
* ```UserGroup```
* ```Section```
* ```EnumElement```
* ```File```

Их можно использовать для связей с сущностями проекта

#### Работа с фильтром по условию "OR"

На данный момент отсутствует
