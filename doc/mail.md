#### [Главная страница](../README.md)

## Упрощение отправки почтовых сообщений

В основном упрощение интерфейса заключается в передаче второго параметра ```CEvent::Send```, часто происходит ошибочная ситуация
когда письмо нужно отправлять и из публичной части сайта (SITE_ID) и из административного интерфейса (LANGUAGE_ID). При этом заранее неизвестно
местоположение отправки сообщения (код в обработчике).  Модули коробки ```Битрикса``` справляются так:

```php
<?php

$rsSites = CSite::GetList($by="sort", $order="desc", Array());
$arSites = array();
while ($arSite = $rsSites->Fetch()) {
    $arSites[] = $arSite['ID'];
}

CEvent::Send(
    "NEW_USER",
    $arSites,
    array(
	'USER_ID' => 15,
	'LOGIN' => 'ivanov',
	'EMAIL' => 'ivanov@gmail.com',
	'NAME' => 'Василий',
	'LAST_NAME' => 'Иванов',
	'USER_IP' => '123.456.234.55',
	'USER_HOST' => '',
    )
);

```

```WS-Tools``` упрощает использование и сокращает перечень действий разработчика. Возможно дальнейшее расширение функционала отправки почты.

```php
<?php

$module = \WS\Tools\Module::getInstance();

// почтовый сервис
$mail = $module->mail();

// создание посылки
$newUserPackage = $mail->createPackage("NEW_USER");

// наполнение посылки данными
$newUserPackage->setFields(array(
	'USER_ID' => 15,
	'LOGIN' => 'ivanov',
	'EMAIL' => 'ivanov@gmail.com',
	'NAME' => 'Василий',
	'LAST_NAME' => 'Иванов',
	'USER_IP' => '123.456.234.55',
	'USER_HOST' => '',
));

// отправка посылки через почтовый сервис
$mail->send($newUserPackage);
```
