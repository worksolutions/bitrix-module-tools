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
                'number of links to the information block and the information block entries must match' => 'Количество ссылок по инфоблокам и записей инфоблоков должно совпадать',
                'number of links on the properties of information blocks and records must match' => 'Количество ссылок по свойствам инфоблоков и записей должно совпадать',
                'number of links to information block sections and records must match' => 'Количество ссылок по разделам инфоблоков и записей должно совпадать',
            )
        )
    )
);