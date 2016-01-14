<?php

namespace WS\Tools\ORM\BitrixEntity;

use WS\Tools\ORM\Entity;

/**
 * Сущность "Пользователь"
 *
 * @property integer                $id                 ID                  Идентификатор
 * @property integer                $xmlId              XML_ID              Идентификатор пользователя для связи с внешними источниками
 * @property \WS\Tools\ORM\DateTime $modificationDate   TIMESTAMP_X         Дата последнего изменения
 * @property string                 $login              LOGIN               Имя входа
 * @property string                 $passwordHash       PASSWORD            Хеш пароля
 * @property string                 $cookiePasswordHash STORED_HASH         Хеш пароля хранимый в куках браузера
 * @property string                 $checkword          CHECKWORD           Контрольная строка смены пароля
 * @property boolean                $isActive           ACTIVE              Признак активности
 * @property string                 $name               NAME Имя
 * @property string                 $lastName           LAST_NAME           Фамилия
 * @property string                 $secondName         SECOND_NAME         Отчество
 * @property string                 $email              EMAIL
 * @property \WS\Tools\ORM\DateTime $lastLoginDate      LAST_LOGIN          Дата последней авторизации
 * @property \WS\Tools\ORM\DateTime $lastActivitiDate   LAST_ACTIVITY_DATE  Дата последнего хита на сайте
 * @property \WS\Tools\ORM\DateTime $registerDate       DATE_REGISTER       Дата регистрации
 * @property string                 $lid                LID                 Идентификатор сайта по умолчанию для уведомлений
 * @property string                 $adminNotes         ADMIN_NOTES         Заметки администратора
 * @property string                 $externalAuthId     EXTERNAL_AUTH_ID    Код источника внешней авторизации
 *
 * @property \WS\Tools\ORM\BitrixEntity\UserGroup[] $groups GROUPS_ID
 *
 * @property string                 $personalProfesion  PERSONAL_PROFESSION Профессия
 * @property string                 $personalWWW        PERSONAL_WWW        WWW-страница
 * @property string                 $personalIcq        PERSONAL_ICQ        icq
 * @property string                 $personalGender     PERSONAL_GENDER     Пол
 * @property \WS\Tools\ORM\DateTime $personalBirthday   PERSONAL_BIRTHDATE  Дата рождения
 * @property \WS\Tools\ORM\BitrixEntity\File $personalPhoto PERSONAL_PHOTO  Фотография
 * @property string                 $personalPhone      PERSONAL_PHONE      Телефон
 * @property string                 $personalFax        PERSONAL_FAX        Факс
 * @property string                 $personalMobile     PERSONAL_MOBILE     Мобильный телефон
 * @property string                 $personalPager      PERSONAL_PAGER      Пэйджер
 * @property string                 $personalStreet     PERSONAL_STREET     Улица, дом
 * @property string                 $personalMailBox    PERSONAL_MAILBOX    Почтовый ящик
 * @property string                 $personalCity       PERSONAL_CITY       Город
 * @property string                 $personalState      PERSONAL_STATE      Область / край
 * @property string                 $personalZip        PERSONAL_ZIP        Индекс
 * @property string                 $personalCountry    PERSONAL_COUNTRY    Страна
 * @property string                 $personalNotes      PERSONAL_NOTES      Дополнительные заметки
 * 
 * @property string                 $workCompany        WORK_COMPANY        Наименование компании
 * @property string                 $workDepartment     WORK_DEPARTMENT     Департамент / Отдел
 * @property string                 $workPosition       WORK_POSITION       Должность
 * @property string                 $workWWW            WORK_WWW            WWW-страница
 * @property string                 $workPhone          WORK_PHONE          Телефон
 * @property string                 $workFax            WORK_FAX            Факс
 * @property string                 $workPager          WORK_PAGER          Пэйджер
 * @property string                 $workStreet         WORK_STREET         Улица, дом
 * @property string                 $workMailBox        WORK_MAILBOX        Почтовый ящик
 * @property string                 $workCity           WORK_CITY           Город
 * @property string                 $workState          WORK_STATE          Область / край
 * @property string                 $workZip            WORK_ZIP            Индекс
 * @property string                 $workCountry        WORK_COUNTRY        Страна
 * @property string                 $workProfile        WORK_PROFILE        Направления деятельности
 * @property \WS\Tools\ORM\BitrixEntity\File $workLogo  WORK_LOGO           Логотип
 * @property string                 $workNotes          WORK_NOTES          Дополнительные заметки
 * @property string                 $password           PASSWORD
 * @property string                 $passwordConfirm    CONFIRM_PASSWORD
 * @property string                 $skype              UF_SKYPE
 * @property string                 $hideComments       UF_HIDE_COMMENTS    Скрывать комментарии в списке
 * @property string                 $hideProjects       UF_HIDE_PROJECTS    Скрывать проекты в списке
 * @property string                 $reverseComments    UF_REVERSE_COMMENTS Выводить комментарии в обратном порядке
 * @property \WS\Tools\ORM\BitrixEntity\PropEnumElement role UF_ROLE
 *
 * @gateway user
 * @bitrixClass CUser
 *
 * @author Максим Соколовский (my.sokolovsky@gmail.com)
 */
class User extends Entity {

    public function getFullName() {
        $name = trim($this->lastName . " " . $this->name);
        return $name ? : $this->email;
    }
}
