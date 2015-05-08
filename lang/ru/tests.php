<?php
return array(
    'run' => array(
        'name' => 'Рабочие решения. Инструменты разработчика',
        'report' => array(
            'completed' => 'Успешно пройдено',
            'assertions' => 'Проверок'
        )
    ),
    'cases' => array(
        \WS\Tools\Tests\Cases\CacheTestCase::className() => array(
            'name' => 'Тестирование функционала кэширования',
            'description' => '',
            'errors' => array(
                'cache must be not expire' => 'Кэш должен быть не истекшим',
                'cache must be not empty' => 'Кэш должен быть не пустым',
                'bad stored data' => 'Хранимая информация не верна',
                'cache must be expire' => 'Кэш должен быть истекшим',
                'data must be empty' => 'Данные не должны быть пустыми',
                'string not equals expected' => 'Строка контента не соответствует ожидаемой',
            )
        )
    )
);