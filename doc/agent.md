## [Главная страница](../README.md)

## Базовый класс для агентов

Упрощает процедуру добавления [агента](https://dev.1c-bitrix.ru/learning/course/?COURSE_ID=43&LESSON_ID=3436) в проект

#### Определение класса агента

```php
<?php

class ProjectAgent extends WS\Tools\BaseAgent {

    private $offset;
    private $step;
    
    /**
     * Именно в конструкторе определяется небходимый список параметров вызова 
     *
     **/
    public function __construct($offset, $step) {
        $this->offset = $offset;
        $this->step = $step;
    }

    /**
     * Реализация функционала агента
     **/
    public function algorithm () {
        // аглоритм функционала
        return array($this->offset * ($this->step + 1), $this->step + 1); // возвращаются параметры следующего вызова В ВИДЕ СПИСКА! ($offset, $step)
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
