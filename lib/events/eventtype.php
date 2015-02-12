<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Events;


class EventType {

    //--------------------------- Главный модуль ------------------------------//

    /**
     * Загрузка страницы
     */
    const MAIN_PAGE_START = 'main-page-start';

    /**
     * Событие позволяет модифицировать или добавить собственные кнопки на панель
     */
    const MAIN_ADMIN_CONTEXT_MENU_SHOW = 'main-admin-context-menu-show';

    /**
     *  Событие позволяет модифицировать объект списка, в частности,
     * добавить произвольные групповые действия над элементами списка,
     * добавить команды в меню действий элемента списка и т.п.
     */
    const MAIN_ADMIN_LIST_DISPLAY = 'main-admin-list-display';

    /**
     * Событие позволяет изменить или добавить собственные вкладки формы редактирования
     */
    const MAIN_ADMIN_TAB_CONTROL_BEGIN = 'main-admin-tab-control-begin';

    const MAIN_AFTER_AJAX_RESPONSE = 'main-after-ajax-response';

    /**
     * Событие "OnAfterEpilog" возникает в конце выполняемой части эпилога сайта (после события OnEpilog).
     */
    const MAIN_AFTER_EPILOG = 'main-after-epilog';

    /**
     * Событие вызывается в методе CGroup::Add после добавления группы,
     * и может быть использовано для действий, связанных с группой.
     */
    const MAIN_AFTER_GROUP_ADD = 'main-after-group-add';

    /**
     * Событие вызывается в методе CGroup::Update после изменения полей группы,
     * и может быть использовано для дополнительных действий, связанных с группой.
     */
    const MAIN_AFTER_GROUP_UPDATE = 'main-after-group-update';

    /**
     * Событие "OnAfterUserAdd" вызывается после попытки добавления нового пользователя методом CUser::Add.
     */
    const MAIN_AFTER_USER_ADD = 'main-after-user-add';

    /**
     * Обработчик события будет вызван из метода CUser::Authorize после авторизации пользователя,
     * передавая в параметре user_fields массив всех полей авторизованного пользователя.
     */
    const MAIN_AFTER_USER_AUTHORIZE = 'main-after-user-authorize';

    /**
     * Событие "OnAfterUserLogin" вызывается в методе CUser::Login после попытки авторизовать пользователя,
     * проверив имя входа arParams['LOGIN'] и пароль arParams['PASSWORD'].
     */
    const MAIN_AFTER_USER_LOGIN = 'main-after-user-login';

    /**
     * Событие "OnAfterUserLoginByHash" вызывается в методе CUser::LoginByHash()
     * после проверки имени входа arParams['LOGIN'] и хеша от пароля arParams['HASH']
     * и попытки авторизовать пользователя. В параметре arParams['USER_ID'] будет передан
     * код пользователя которого удалось авторизовать, а также массив с сообщением об ошибке arParams['RESULT_MESSAGE'].
     */
    const MAIN_AFTER_USER_LOGIN_BY_HASH = 'main-after-user-login-by-hash';

    /**
     * Событие "OnAfterUserLogout" вызывается после завершения авторизации пользователя.
     */
    const MAIN_AFTER_USER_LOGOUT = 'main-after-user-logout';

    /**
     * Событие "OnAfterUserRegister" вызывается после попытки регистрации нового пользователя методом CUser::Register.
     */
    const MAIN_AFTER_USER_REGISTER = 'main-after-user-register';

    /**
     * Событие "OnAfterUserSimpleRegister" вызывается после попытки упрощённой регистрации
     * нового пользователя методом CUser::SimpleRegister.
     */
    const MAIN_AFTER_USER_SIMPLE_REGISTER = 'main-after-user-simple-register';

    /**
     * Событие OnAfterUserUpdate вызывается после попытки
     * изменения свойств пользователя методом CUser::Update.
     */
    const MAIN_AFTER_USER_UPDATE = 'main-after-user-update';

    /**
     * Событие "OnBeforeChangeFile" вызывается при изменении файла методом $APPLICATION->SaveFileContent,
     * перед его сохранением. Контент в событие передается по ссылке.
     */
    const MAIN_BEFORE_CHANGE_FILE = 'main-before-change-file';

    /**
     * Событие OnBeforeEventAdd вызывается в момент добавление почтового события в таблицу b_event.
     * Как правило, задача обработчика данного события - изменить или добавить какое-либо значение,
     * передаваемое в макросы почтового шаблона.
     */
    const MAIN_BEFORE_EVENT_ADD = 'main-before-event-add';

    /**
     * Событие "OnBeforeEventMessageDelete" вызывается перед удалением почтового шаблона.
     * Как правило задачи обработчика данного события - разрешить или запретить удаление почтового шаблона.
     */
    const MAIN_BEFORE_EVENT_MESSAGE_DELETE = 'main-before-event-message-delete';

    const MAIN_BEFORE_EVENT_SEND = 'main-before-event-send';

    /**
     * Событие вызывается в методе CGroup::Add до добавления группы,
     * и может быть использовано для отмены добавления или переопределения некоторых полей.
     */
    const MAIN_BEFORE_GROUP_ADD = 'main-before-group-add';

    /**
     * Событие "OnBeforeGroupDelete" вызывается перед удалением группы пользователей.
     * Как правило задачи обработчика данного события - разрешить или запретить удаление группы пользователей.
     */
    const MAIN_BEFORE_GROUP_DELETE = 'main-before-group-delete';

    /**
     * Событие вызывается в методе CGroup::Update до изменения полей группы,
     * и может быть использовано для отмены изменения или переопределения некоторых полей.
     */
    const MAIN_BEFORE_GROUP_UPDATE = 'main-before-group-update';

    /**
     * Событие "OnBeforeLanguageDelete" вызывается перед удалением языка.
     * Как правило задачи обработчика данного события - разрешить или запретить удаление языка.
     */
    const MAIN_BEFORE_LANGUAGE_DELETE = 'main-before-language-delete';

    /**
     * Событие "OnBeforeProlog" вызывается в выполняемой части пролога сайта (после события OnPageStart).
     */
    const MAIN_BEFORE_PROLOG = 'main-before-prolog';

    /**
     * Событие "OnBeforeSiteDelete" вызывается перед удалением сайта.
     * Как правило задачи обработчика данного события - разрешить или запретить удаление сайта.
     */
    const MAIN_BEFORE_SITE_DELETE = 'main-before-site-delete';

    /**
     * Событие вызывается в методе CUser::Add до вставки нового пользователя,
     * и может быть использовано для отмены вставки или переопределения некоторых полей.
     */
    const MAIN_BEFORE_USER_ADD = 'main-before-user-add';

    /**
     * Событие "OnBeforeUserDelete" вызывается перед удалением пользователя.
     * Как правило задачи обработчика данного события - разрешить или запретить удаление пользователя.
     */
    const MAIN_BEFORE_USER_DELETE = 'main-before-user-delete';

    /**
     * Событие "OnBeforeUserLogin" вызывается в методе CUser::Login до проверки имени входа arParams['LOGIN']
     * и пароля arParams['PASSWORD'] и попытки авторизовать пользователя,
     * и может быть использовано для прекращения процесса проверки или переопределения некоторых полей.
     */
    const MAIN_BEFORE_USER_LOGIN = 'main-before-user-login';

    /**
     * Событие "OnBeforeUserLoginByHash" вызывается в методе CUser::LoginByHash()
     * до проверки имени входа arParams['LOGIN'], хеша от пароля arParams['HASH'] и попытки авторизовать пользователя.
     */
    const MAIN_BEFORE_USER_LOGIN_BY_HASH = 'main-before-user-login-by-hash';

    /**
     * Вызывается перед завершением сеанса авторизации пользователя методом CUser::Logout
     * и может быть использовано для отмены завершения сеанса.
     */
    const MAIN_BEFORE_USER_LOGOUT = 'main-before-user-logout';

    /**
     * Событие "OnBeforeUserRegister" вызывается до попытки регистрации нового пользователя методом CUser::Register
     * и может быть использовано для прекращения процесса регистрации или переопределения некоторых полей.
     */
    const MAIN_BEFORE_USER_REGISTER = 'main-before-user-register';

    /**
     * Событие "OnBeforeUserSimpleRegister" вызывается до попытки упрощённой регистрации нового пользователя
     * методом CUser::SimpleRegister и может быть использовано для прекращения
     * процесса регистрации или переопределения некоторых полей.
     */
    const MAIN_BEFORE_USER_SIMPLE_REGISTER = 'main-before-user-simple-register';

    /**
     * Событие вызывается в методе CUser::Update до изменения параметров пользователя,
     * и может быть использовано для отмены изменения или переопределения некоторых полей.
     */
    const MAIN_BEFORE_USER_UPDATE = 'main-before-user-update';

    const MAIN_BUILD_GLOBAL_MENU = 'main-build-global-menu';

    /**
     * Событие "OnChangePermissions" вызывается при изменении прав доступа к файлу
     * или папке методом $APPLICATION->SetFileAccessPermission.
     */
    const MAIN_CHANGE_PERMISSIONS = 'main-change-permissions';

    const MAIN_END_BUFFER_CONTENT = 'main-end-buffer-content';

    /**
     * Событие "OnEpilog" вызывается в конце визуальной части эпилога сайта.
     */
    const MAIN_EPILOG = 'main-epilog';

    /**
     * Событие "OnEventMessageDelete" вызывается во время удаления почтового шаблона.
     * Как правило задачи обработчика данного события - очистить базу данных от записей связанных
     * с удаляемым почтовым шаблоном.
     */
    const MAIN_EVENT_MESSAGE_DELETE = 'main-event-message-delete';

    /**
     * Событие "OnExternalAuthList" вызывается для получения списка источников
     * внешней авторизации при вызове метода CUser::GetExternalAuthList.
     */
    const MAIN_EXTERNAL_AUTH_LIST = 'main-external-auth-list';

    /**
     * Событие может использоваться для удаления производной от файла информации
     * (созданных при загрузке картинки эскизов и т.п.).
     */
    const MAIN_FILE_DELETE = 'main-file-delete';

    /**
     * Событие "OnGroupDelete" вызывается в момент удаления группы пользователей.
     * Как правило задачи обработчика данного события - очистить базу данных от записей связанных
     * с удаляемой группой пользователей.
     */
    const MAIN_GROUP_DELETE = 'main-group-delete';

    /**
     * Событие "OnLanguageDelete" вызывается во время удаления языка.
     * Как правило задачи обработчика данного события - очистить базу данных
     * от записей связанных с удаляемым языком.
     */
    const MAIN_LANGUAGE_DELETE = 'main-language-delete';

    /**
     * Событие "OnPanelCreate" вызывается в момент сбора данных для построения панели управления в публичной части сайта.
     * Как правило задачи обработчика данного события - добавлять свои кнопки в панель управления сайтом.
     */
    const MAIN_PANEL_CREATE = 'main-panel-create';

    /**
     * Событие "OnProlog" вызывается в начале визуальной части пролога сайта.
     */
    const MAIN_PROLOG = 'main-prolog';

    /**
     * Событие "OnSendUserInfo" вызывается в методе CUser::SendUserInfo и
     * предназначено для возможности переопределения параметров для отправки почтового события USER_INFO.
     */
    const MAIN_SEND_USER_INFO = 'main-send-user-info';

    /**
     * Событие "OnSiteDelete" вызывается во время удаления сайта.
     * Как правило задачи обработчика данного события - очистить базу данных
     * от записей связанных с удаляемым сайтом.
     */
    const MAIN_SITE_DELETE = 'main-site-delete';

    /**
     * Событие "OnUserDelete" вызывается в момент удаления пользователя.
     * Как правило задачи обработчика данного события - очистить базу данных
     * от записей связанных с удаляемым пользователем.
     */
    const MAIN_USER_DELETE = 'main-user-delete';

    /**
     * Событие OnUserLoginExternal предназначено для возможности проверки имени входа и пароля во внешнем источнике.
     */
    const MAIN_USER_LOGIN_EXTERNAL = 'main-user-login-external';

    /**
     * Событие OnEventLogGetAuditTypes предназначено для добавления описания кода типа сообщения Журнала событий.
     */
    const MAIN_EVENT_LOG_GET_AUDIT_TYPES = 'main-event-log-get-audit-types';

    //--------------------------- Информационные блоки ------------------------------//

    /**
     * Событие "OnAfterIBlockAdd" вызывается после попытки добавления
     * нового информационного блока методом CIBlock::Add.
     */
    const IBLOCK_AFTER_IBLOCK_ADD = 'iblock-after-iblock-add';

    /**
     * Событие "OnAfterIBlockElementAdd" вызывается после попытки добавления
     * нового элемента информационного блока методом CIBlockElement::Add.
     */
    const IBLOCK_AFTER_IBLOCK_ELEMENT_ADD = 'iblock-after-iblock-element-add';

    /**
     * Событие "OnAfterIBlockElementDelete" вызывается после того,
     * как элемент и вся связанная с ним информация были удалены из базы данных.
     */
    const IBLOCK_AFTER_IBLOCK_ELEMENT_DELETE = 'iblock-after-iblock-element-delete';

    /**
     * Событие "OnAfterIBlockElementSetPropertyValues" вызывается после попытки сохранения
     * значений всех свойств элемента инфоблока методом CIBlockElement::SetPropertyValues.
     */
    const IBLOCK_AFTER_IBLOCK_ELEMENT_SET_PROPERTY_VALUES = 'iblock-after-iblock-element-set-property-values';

    /**
     * Событие "OnAfterIBlockElementSetPropertyValuesEx" вызывается после попытки сохранения
     * значений свойств элемента инфоблока методом CIBlockElement::SetPropertyValuesEx.
     */
    const IBLOCK_AFTER_IBLOCK_ELEMENT_SET_PROPERTY_VALUES_EX = 'iblock-after-iblock-element-set-property-values-ex';

    /**
     * Событие "OnAfterIBlockElementUpdate" вызывается после
     * попытки изменения элемента информационного блока методом CIBlockElement::Update.
     */
    const IBLOCK_AFTER_IBLOCK_ELEMENT_ELEMENT_UPDATE = 'iblock-after-iblock-element-element-update';

    /**
     * Событие "OnAfterIBlockPropertyAdd" вызывается после попытки добавления
     * нового свойства информационного блока методом CIBlockProperty::Add.
     */
    const IBLOCK_AFTER_IBLOCK_PROPERTY_ADD = 'iblock-after-iblock-property-add';

    /**
     * Событие "OnAfterIBlockPropertyUpdate" вызывается после попытки изменения
     * свойства информационного блока методом CIBlockProperty::Update.
     */
    const IBLOCK_AFTER_IBLOCK_PROPERTY_UPDATE = 'iblock-after-iblock-property-update';

    /**
     * Событие "OnAfterIBlockSectionAdd" вызывается после попытки добавления
     * нового раздела информационного блока методом CIBlockSection::Add.
     */
    const IBLOCK_AFTER_IBLOCK_SECTION_ADD = 'iblock-after-iblock-section-add';

    /**
     * Событие "OnAfterIBlockSectionUpdate" вызывается после попытки
     * изменения раздела информационного блока методом CIBlockSection::Update.
     */
    const IBLOCK_AFTER_IBLOCK_SECTION_UPDATE = 'iblock-after-iblock-section-update';

    /**
     * Событие "OnAfterIBlockUpdate" вызывается после попытки изменения информационного
     * блока методом CIBlock::Update.
     */
    const IBLOCK_AFTER_IBLOCK_UPDATE = 'iblock-after-iblock-update';

    /**
     * Событие вызывается в методе CIBlock::Add до вставки информационного блока,
     * и может быть использовано для отмены вставки или переопределения некоторых полей.
     */
    const IBLOCK_BEFORE_IBLOCK_ADD = 'iblock-before-iblock-add';

    /**
     * Вызывается перед удалением информационного блока.
     */
    const IBLOCK_BEFORE_IBLOCK_DELETE = 'iblock-before-iblock-delete';

    /**
     * Событие вызывается в методе CIBlockElement::Add до вставки элемента информационного блока,
     * и может быть использовано для отмены вставки или переопределения некоторых полей.
     */
    const IBLOCK_BEFORE_IBLOCK_ELEMENT_ADD = 'iblock-before-iblock-element-add';

    /**
     * Событие "OnBeforeIBlockElementDelete" вызывается перед удалением элемента методом CIBlockElement::Delete.
     * Как правило задачи обработчика данного события - разрешить или запретить удаление.
     */
    const IBLOCK_BEFORE_IBLOCK_ELEMENT_DELETE = 'iblock-before-iblock-element-delete';

    /**
     * Событие вызывается в методе CIBlockElement::Update до изменения элемента информационного блока,
     * и может быть использовано для отмены изменения или для переопределения некоторых полей.
     */
    const IBLOCK_BEFORE_IBLOCK_ELEMENT_UPDATE = 'iblock-before-iblock-element-update';

    /**
     * Событие вызывается в методе CIBlockProperty::Add до вставки свойства в инфоблок,
     * и может быть использовано для отмены вставки или переопределения некоторых полей.
     */
    const IBLOCK_BEFORE_IBLOCK_PROPERTY_ADD = 'iblock-before-iblock-property-add';

    /**
     * Событие "OnBeforeIBlockPropertyDelete" вызывается перед удалением свойства методом CIBlockProperty::Delete.
     * Как правило задачи обработчика данного события - разрешить или запретить удаление.
     */
    const IBLOCK_BEFORE_IBLOCK_PROPERTY_DELETE = 'iblock-before-iblock-property-delete';

    /**
     * Событие вызывается в методе CIBlockProperty::Update до изменения свойства информационного блока,
     * и может быть использовано для отмены изменения или для переопределения некоторых полей.
     */
    const IBLOCK_BEFORE_IBLOCK_PROPERTY_UPDATE = 'iblock-before-iblock-property-update';

    /**
     * Событие вызывается в методе CIBlockSection::Add до вставки информационного блока,
     * и может быть использовано для отмены вставки или переопределения некоторых полей.
     */
    const IBLOCK_BEFORE_IBLOCK_SECTION_ADD = 'iblock-before-iblock-section-add';

    /**
     * Событие "OnBeforeIBlockSectionDelete" вызывается перед удалением раздела методом CIBlockSection::Delete.
     * Как правило задачи обработчика данного события - разрешить или запретить удаление.
     */
    const IBLOCK_BEFORE_IBLOCK_SECTION_DELETE = 'iblock-before-iblock-section-delete';

    /**
     * Событие вызывается в методе CIBlockSection::Update до изменения раздела информационного блока,
     * и может быть использовано для отмены изменения или для переопределения некоторых полей.
     */
    const IBLOCK_BEFORE_IBLOCK_SECTION_UPDATE = 'iblock-before-iblock-section-update';

    /**
     * Событие вызывается в методе CIBlock::Update до изменения информационного блока,
     * и может быть использовано для отмены изменения или переопределения некоторых полей.
     */
    const IBLOCK_BEFORE_IBLOCK_UPDATE = 'iblock-before-iblock-update';

    /**
     * Вызывается в момент удаления информационного блока.
     */
    const IBLOCK_DELETE = 'iblock-delete';

    /**
     * Вызывается в момент удаления элемента информационного блока.
     */
    const IBLOCK_ELEMENT_DELETE = 'iblock-element-delete';

    /**
     * Событие вызывается при построении списка пользовательских свойств.
     */
    const IBLOCK_PROPERTY_BUILD_LIST = 'iblock-property-build-list';

    /**
     * Событие вызывается в методе CIBlockElement::Add до добавления элемента инфоблока
     * перед проверкой правильности заполнения полей,
     * и может быть использовано для отмены выполнения других обработчиков событий.
     */
    const IBLOCK_START_IBLOCK_ELEMENT_ADD = 'iblock-start-iblock-element-add';

    /**
     * Событие вызывается в методе CIBlockElement::Update до изменения элемента информационного блока
     * перед проверкой правильности заполнения полей,
     * и может быть использовано для отмены изменения или для переопределения некоторых полей.
     */
    const IBLOCK_START_IBLOCK_ELEMENT_UPDATE = 'iblock-start-iblock-element-update';

    //--------------------------- Интернет магазин ------------------------------//

    //---------------- События, связанные с изменением типов плательщиков -----------------//
    /**
     * Вызывается перед добавлением типа плательщика, может быть использовано для отмены или модификации данных.
     */
    const SALE_BEFORE_PERSON_TYPE_ADD = 'sale-before-person-type-add';

    /**
     * Вызывается перед изменением типа плательщика, может быть использовано для отмены или модификации данных.
     */
    const SALE_BEFORE_PERSON_TYPE_UPDATE = 'sale-before-person-type-update';

    /**
     * Вызывается после добавления типа плательщика.
     */
    const SALE_PERSON_TYPE_ADD = 'sale-person-type-add';

    /**
     * Вызывается после изменения типа плательщика.
     */
    const SALE_PERSON_TYPE_UPDATE = 'sale-person-type-update';

    /**
     * Вызывается перед удалением типа плательщика, может быть использовано для отмены.
     */
    const SALE_BEFORE_PERSON_TYPE_DELETE = 'sale-before-person-type-delete';

    /**
     * Вызывается после удаления типа плательщика
     */
    const SALE_PERSON_TYPE_DELETE = 'sale-person-type-delete';

    //---------------- События, связанные с местоположениями -----------------//

    /**
     * Вызывается после добавления города.
     */
    const SALE_CITY_ADD = 'sale-city-add';

    /**
     * Вызывается после удаления города.
     */
    const SALE_CITY_DELETE = 'sale-city-delete';

    /**
     * Вызывается после изменения города.
     */
    const SALE_CITY_UPDATE = 'sale-city-update';

    /**
     * Вызывается перед добавлением города
     */
    const SALE_BEFORE_CITY_ADD = 'sale-before-city-add';

    /**
     * Вызывается перед удалением города.
     */
    const SALE_BEFORE_CITY_DELETE = 'sale-before-city-delete';

    /**
     * Вызывается перед обновлением города
     */
    const SALE_BEFORE_CITY_UPDATE = 'sale-before-city-update';

    /**
     * Вызывается после удаления региона.
     */
    const SALE_REGION_DELETE = 'sale-region-delete';

    /**
     * Вызывается до удаления региона, может быть использовано для отмены удаления.
     */
    const SALE_BEFORE_REGION_DELETE = 'sale-before-region-delete';

    /**
     * Вызывается после обновления региона.
     */
    const SALE_REGION_UPDATE = 'sale-region-update';

    /**
     * Вызывается до обновления региона, может быть использовано для отмены или модификации данных
     */
    const SALE_BEFORE_REGION_UPDATE = 'sale-before-region-update';

    /**
     * Вызывается перед добавлением региона.
     */
    const SALE_BEFORE_REGION_ADD = 'sale-before-region-add';

    /**
     * Вызывается после добавлением региона
     */
    const SALE_REGION_ADD = 'sale-region-add';

    /**
     * Вызывается после добавления страны
     */
    const SALE_COUNTRY_ADD = 'sale-country-add';

    /**
     * Вызывается после удаления страны.
     */
    const SALE_COUNTRY_DELETE = 'sale-country-delete';

    /**
     * Вызывается после изменения страны
     */
    const SALE_COUNTRY_UPDATE = 'sale-country-update';

    /**
     * Вызывается перед добавлением страны.
     */
    const SALE_BEFORE_COUNTRY_ADD = 'sale-before-country-add';

    /**
     * Вызывается перед удалением страны.
     */
    const SALE_BEFORE_COUNTRY_DELETE = 'sale-before-country-delete';

    /**
     * Вызывается перед обновлением страны.
     */
    const SALE_BEFORE_COUNTRY_UPDATE = 'sale-before-country-update';

    /**
     * Вызывается после удаления местоположения
     */
    const SALE_LOCATION_DELETE = 'sale-location-delete';

    /**
     * Вызывается после удаления всех местоположений.
     */
    const SALE_LOCATION_DELETE_ALL = 'sale-location-delete-all';

    /**
     * Вызывается после добавления местоположения
     */
    const SALE_LOCATION_ADD = 'sale-location-add';

    /**
     * Вызывается после обновления местоположения.
     */
    const SALE_LOCATION_UPDATE = 'sale-location-update';

    /**
     * Вызывается перед добавлением местоположения
     */
    const SALE_BEFORE_LOCATION_ADD = 'sale-before-location-add';

    /**
     * Вызывается перед удалением местоположения.
     */
    const SALE_BEFORE_LOCATION_DELETE = 'sale-before-location-delete';

    /**
     * Вызывается перед удалением всех местоположений.
     */
    const SALE_BEFORE_LOCATION_DELETE_ALL = 'sale-before-location-delete_all';

    /**
     * Вызывается перед изменением местоположения.
     */
    const SALE_BEFORE_LOCATION_UPDATE = 'sale-before-location-update';

    /**
     * Вызывается после добавления группы местоположений
     */
    const SALE_LOCATION_GROUP_ADD = 'sale-location-group-add';

    /**
     * Вызывается после удаления группы местоположений.
     */
    const SALE_LOCATION_GROUP_DELETE = 'sale-location-group-delete';

    /**
     * Вызывается после после группы местоположений
     */
    const SALE_LOCATION_GROUP_UPDATE = 'sale-location-group-update';

    /**
     * Вызывается перед добавлением группы местоположений.
     */
    const SALE_BEFORE_LOCATION_GROUP_ADD = 'sale-before-location-group-add';

    /**
     * Вызывается перед удалением группы местоположений.
     */
    const SALE_BEFORE_LOCATION_GROUP_DELETE = 'sale-before-location-group-delete';

    /**
     * Вызывается перед изменением группы местоположений.
     */
    const SALE_BEFORE_LOCATION_GROUP_UPDATE = 'sale-before-location-group-update';

    //---------------- События, связанные с изменением заказов -----------------//

    /**
     * Вызывается перед добавлением заказа, может быть использовано для отмены или модификации данных.
     */
    const SALE_BEFORE_ORDER_ADD = 'sale-before-order-add';

    /**
     * Вызывается после добавления заказа.
     */
    const SALE_ORDER_ADD = 'sale-order-add';

    /**
     * Вызывается перед изменением заказа, может быть использовано для отмены или модификации данных.
     */
    const SALE_BEFORE_ORDER_UPDATE = 'sale-before-order-update';

    /**
     * Вызывается после изменения заказа.
     */
    const SALE_ORDER_UPDATE = 'sale-order-update';

    /**
     * Вызывается перед удалением заказа, может быть использовано для отмены.
     */
    const SALE_BEFORE_ORDER_DELETE = 'sale-before-order-delete';

    /**
     * Вызывается после удаления заказа
     */
    const SALE_ORDER_DELETE = 'sale-order-delete';

    /**
     * Вызывается после калькуляции заказа. В событии передается &arOrder, те можно вносить правки в массив
     * заказа в обработчике события.
     */
    const SALE_CALCULATE_ORDER = 'sale-calculate-order';

    /**
     * Вызывается после расчёта скидки на заказ.
     */
    const SALE_CALCULATE_ORDER_DISCOUNT = 'sale-calculate-order-discount';

    /**
     * Вызывается после расчёта доставки.
     */
    const SALE_CALCULATE_ORDER_DELIVERY = 'sale-calculate-order-delivery';

    /**
     * Вызывается после расчёта налога на доставку.
     */
    const SALE_CALCULATE_ORDER_DELIVERY_TAX = 'sale-calculate-order-delivery-tax';

    /**
     * Вызывается после определения платёжной системы.
     */
    const SALE_CALCULATE_ORDER_PAY_SYSTEM = 'sale-calculate-order-pay-system';

    /**
     * Вызывается после определения типа плательщика.
     */
    const SALE_CALCULATE_ORDER_PERSON_TYPE = 'sale-calculate-order-person-type';

    /**
     * Вызывается после формирования свойств плательщика.
     */
    const SALE_CALCULATE_ORDER_PROPS = 'sale-calculate-order-props';

    /**
     * Вызывается после формирования массива заказа из корзины.
     */
    const SALE_CALCULATE_ORDER_SHOPPING_CART = 'sale_calculate_order_shopping_cart';

    /**
     * Вызывается после определения налогов.
     */
    const SALE_CALCULATE_ORDER_SHOPPING_CART_TAX = 'sale-calculate-order-shopping-cart-tax';

    //---------------- События, связанные с изменением статусов заказа -----------------//

    /**
     * Вызывается перед добавлением статуса заказа, может быть использовано для отмены или модификации данных.
     */
    const SALE_BEFORE_STATUS_ADD = 'sale-before-status-add';

    /**
     * Вызывается после добавления статуса заказа.
     */
    const SALE_STATUS_ADD = 'sale-status-add';

    /**
     * Вызывается перед изменением статуса заказа, может быть использовано для отмены или модификации данных.
     */
    const SALE_BEFORE_STATUS_UPDATE = 'sale-before-status-update';

    /**
     * Вызывается после изменения статуса заказа.
     */
    const SALE_STATUS_UPDATE = 'sale-status-update';

    /**
     * Вызывается перед удалением статуса заказа, может быть использовано для отмены.
     */
    const SALE_BEFORE_STATUS_DELETE = 'sale-before-status-delete';

    /**
     * Вызывается после удаления статуса заказа
     */
    const SALE_STATUS_DELETE = 'sale-status-delete';

    //---------------- События, связанные с изменением аффилиатов -----------------//

    /**
     * Вызывается до добавления аффилиата.
     */
    const SALE_BEFORE_B_AFFILIATE_ADD = 'sale-before-b-affiliate-add';

    /**
     * Вызывается после добавления аффилиата.
     */
    const SALE_AFTER_B_AFFILIATE_ADD = 'sale-after-b-affiliate-add';

    /**
     * Вызывается до обновления
     */
    const SALE_BEFORE_AFFILIATE_UPDATE = 'sale-before-affiliate-update';

    /**
     * Вызывается после обновления
     */
    const SALE_AFTER_AFFILIATE_UPDATE = 'sale-after-affiliate-update';
    const SALE_BEFORE_AFFILIATE_DELETE = 'sale-before-affiliate-delete';
    const SALE_AFTER_AFFILIATE_DELETE = 'sale-after-affiliate-delete';
    const SALE_BEFORE_AFFILIATE_CALCULATE = 'sale-before-affiliate-calculate';
    const SALE_AFTER_AFFILIATE_CALCULATE = 'sale-after-affiliate-calculate';
    const SALE_BEFORE_PAY_AFFILIATE = 'sale-before-pay-affiliate';
    const SALE_AFTER_PAY_AFFILIATE = 'sale-after-pay-affiliate';
    const SALE_BEFORE_AFFILIATE_PLAN_ADD = 'sale-before-affiliate-plan-add';
    const SALE_AFTER_AFFILIATE_PLAN_ADD = 'sale-after-affiliate-plan-add';
    const SALE_BEFORE_AFFILIATE_PLAN_UPDATE = 'sale-before-affiliate-plan-update';
    const SALE_AFTER_AFFILIATE_PLAN_UPDATE = 'sale-after-affiliate-plan-update';
    const SALE_BEFORE_AFFILIATE_PLAN_DELETE = 'sale-before-affiliate-plan-delete';
    const SALE_AFTER_AFFILIATE_PLAN_DELETE = 'sale-after-affiliate-plan-delete';


    //---------------- События, связанные с изменением состояния заказов -----------------//

    /**
     * Вызывается перед изменением флага оплаты заказа, может быть использовано для отмены.
     */
    const SALE_BEFORE_PAY_ORDER = 'sale-before-pay-order';

    /**
     * Вызывается после изменения флага оплаты заказа.
     */
    const SALE_PAY_ORDER = 'sale-pay-order';

    /**
     * Вызывается перед изменением флага разрешения доставки заказа, может быть использовано для отмены.
     */
    const SALE_BEFORE_DELIVERY_ORDER = 'sale-before-delivery-order';

    /**
     * Вызывается после изменения флага разрешения доставки заказа.
     */
    const SALE_DELIVERY_ORDER = 'sale-delivery-order';

    /**
     * Вызывается перед изменением флага отмены заказа, может быть использовано для отмены.
     */
    const SALE_BEFORE_CANCEL_ORDER = 'sale-before-cancel-order';

    /**
     * Вызывается после изменения флага отмены заказа.
     */
    const SALE_CANCEL_ORDER_ORDER = 'sale-cancel-order-order';

    /**
     * Вызывается перед изменением статуса заказа, может быть использовано для отмены.
     */
    const SALE_BEFORE_STATUS_ORDER = 'sale-before-status-order';

    /**
     * Вызывается после изменения статуса заказа.
     */
    const SALE_STATUS_ORDER = 'sale-status-order';

    //---------------- События, связанные с изменением состояния заказов -----------------//

    /**
     * Вызывается перед добавлением записи в корзину,
     * может быть использовано для отмены или модификации данных.
     */
    const SALE_BEFORE_BASKET_ADD = 'sale-before-basket-add';

    /**
     * Вызывается после добавления записи в корзину.
     */
    const SALE_BASKET_ADD = 'sale-basket-add';

    /**
     * Вызывается перед изменением записи в корзине, может быть использовано для отмены или модификации данных.
     */
    const SALE_BEFORE_BASKET_UPDATE = 'sale-before-basket-update';

    /**
     * Вызывается после изменения записи в корзине.
     */
    const SALE_BASKET_UPDATE = 'sale-basket-update';
    /**
     * Событие, вызываемое перед удалением записи о том, что инфоблок является торговым каталогом.
     */
    const CATALOG_BEFORE_CATALOG_DELETE = 'catalog-before-catalog-delete';

    /**
     * Вызывается перед изменением корзины после проверки массива $arFields.
     */
    const SALE_BEFORE_BASKET_UPDATE_AFTER_CHECK = 'sale-before-basket-update-after-check';

    /**
     * Вызывается перед удалением записи из корзины, может быть использовано для отмены.
     */
    const SALE_BEFORE_BASKET_DELETE = 'sale-before-basket-delete';

    /**
     * Вызывается после удаления записи из корзины
     */
    const SALE_BASKET_DELETE = 'sale-basket-delete';

    /**
     * Добавляет переданные купоны. Событие является системным.
     */
    const SALE_SET_COUPON_LIST = 'sale-set-coupon-list';

    /**
     * Удаляет из списка переданные купоны. Событие является системным.
     */
    const SALE_CLEAR_COUPON_LIST = 'sale-clear-coupon-list';

    /**
     * Полностью удаляет список купонов. Событие является системным.
     */
    const SALE_DELETE_COUPON_LIST = 'sale-delete-coupon-list';

    //---------------- События, связанные с отправкой почтовых шаблонов -----------------//

    /**
     * Вызывается перед отправкой письма о новом заказе, может быть использовано для модификации данных,
     * изменения идентификатора типа почтового события,
     * по которому будет осуществлена отправка, и отмены отправки письма.
     */
    const SALE_ORDER_NEW_SEND_EMAIL = 'sale-order-new-send-email';

    /**
     * Вызывается перед отправкой письма о разрешении доставки заказа, может быть использовано для модификации данных,
     * изменения идентификатора типа почтового события,
     * по которому будет осуществлена отправка, и отмены отправки письма.
     */
    const SALE_ORDER_DELIVER_SEND_EMAIL = 'sale-order-deliver-send-email';

    /**
     * Вызывается перед отправкой письма об оплате заказа, может быть использовано для модификации данных,
     * изменения идентификатора типа почтового события, по которому будет осуществлена отправка,
     * и отмены отправки письма.
     */
    const SALE_ORDER_PAY_SEND_EMAIL = 'sale-order-pay-send-email';

    /**
     * Вызывается перед отправкой письма об отмене заказа, может быть использовано для модификации данных,
     * изменения идентификатора типа почтового события, по которому будет осуществлена отправка,
     * и отмены отправки письма.
     */
    const SALE_ORDER_CANCEL_SEND_EMAIL = 'sale-order-cancel-send-email';

    /**
     * Вызывается в момент формирования письма клиенту о смене статуса заказа.
     * Может быть использовано для переопределения текста письма или его дополнения
     * (для этого обработчик события должен возвращать необходимый текст).
     */
    const SALE_STATUS_EMAIL = 'sale_status_email';

    /**
     * Вызывается перед отправкой письма о cмене статуса заказа, может быть использовано для модификации данных,
     * изменения идентификатора типа почтового события, по которому будет осуществлена отправка,
     * и отмены отправки письма.
     */
    const SALE_ORDER_STATUS_SEND_EMAIL = 'sale-order-status-send-email';

    /**
     * Вызывается перед отправкой письма о напоминании оплаты заказа, может быть использовано для модификации данных,
     * изменения идентификатора типа почтового события, по которому будет осуществлена отправка,
     * и отмены отправки письма.
     */
    const SALE_ORDER_REMIND_SEND_EMAIL = 'sale-order-remind-send-email';

    /**
     * Вызывается перед отправкой письма о добавлении заказа на продление подписки,
     * может быть использовано для модификации данных, изменения идентификатора типа почтового события,
     * по которому будет осуществлена отправка, и отмены отправки письма.
     */
    const SALE_ORDER_RECURRING_SEND_EMAIL = 'sale-order-recurring-send-email';

    /**
     * Вызывается перед отправкой письма об отмене заказа на продление подписки,
     * может быть использовано для модификации данных, изменения идентификатора типа почтового события,
     * по которому будет осуществлена отправка, и отмены отправки письма.
     */
    const SALE_ORDER_RECURRING_CANCEL_SEND_EMAIL = 'sale-order-recurring-cancel-send-email';

    //---------------- События, связанные с компонентами -----------------//

    /**
     * Вызывается в компоненте bitrix:sale.order.ajax после формирования списка доступных типов плательщика,
     * может быть использовано для модификации данных.
     */
    const SALE_COMPONENT_ORDER_ONE_STEP_PERSON_TYPE = 'sale-component-order-one-step-person-type';

    /**
     * Вызывается в компоненте bitrix:sale.order.ajax после формирования списка доступных свойств заказа,
     * может быть использовано для модификации данных.
     */
    const SALE_COMPONENT_ORDER_ONE_STEP_ORDER_PROPS = 'sale-component-order-one-step-order-props';

    /**
     * Вызывается в компоненте bitrix:sale.order.ajax после формирования списка доступных служб доставки,
     * может быть использовано для модификации данных.
     */
    const SALE_COMPONENT_ORDER_ONE_STEP_DELIVERY = 'sale-component-order-one-step-delivery';

    /**
     * Вызывается в компоненте bitrix:sale.order.ajax после формирования списка доступных платежных систем,
     * может быть использовано для модификации данных.
     */
    const SALE_COMPONENT_ORDER_ONE_STEP_PAY_SYSTEM = 'sale-component-order-one-step-pay-system';

    /**
     * Вызывается в компоненте bitrix:sale.order.ajax после формирования всех данных компонента
     * на этапе заполнения формы заказа, может быть использовано для модификации данных.
     */
    const SALE_COMPONENT_ORDER_ONE_STEP_PROCESS = 'sale-component-order-one-step-process';

    /**
     * Вызывается в компоненте bitrix:sale.order.ajax после создания заказа и всех его параметров,
     * после отправки письма, но до редиректа на страницу с информацией о созданном заказе и оплате заказа.
     */
    const SALE_COMPONENT_ORDER_ONE_STEP_COMPLETE = 'sale-component-order-one-step-complete';

    /**
     * Вызывается в компоненте bitrix:sale.order.ajax после создания заказа и всех его параметров,
     * после отправки письма, перед выводом страницы об успешно созданном заказе и оплате заказа.
     */
    const SALE_COMPONENT_ORDER_ONE_STEP_FINAL = 'sale-component-order-one-step-final';

    /**
     * Вызывается в компоненте bitrix:sale.order.full после создания заказа и всех его параметров.
     */
    const SALE_COMPONENT_ORDER_COMPLETE = 'sale-component-order-complete';

    /**
     * Вызывается в компоненте bitrix:sale.order.ajax перед подсчётом скидки при оформлении заказа.
     * Можно использовать в том числе для присвоения/отъёма у пользователя купонов соответствующих скидок
     * для расчёта индивидуальной скидки.
     */
    const SALE_COMPONENT_ORDER_ONE_STEP_DISCOUNT_BEFORE = 'sale-component-order-one-step-discount-before';


    /**
     * Событие, вызываемое перед добавлением склада.
     */
    const CATALOG_BEFORE_CATALOG_STORE_ADD = 'catalog-before-catalog-store-add';

    /**
     * Событие, вызываемое перед удалением склада.
     */
    const CATALOG_BEFORE_CATALOG_STORE_DELETE = 'catalog-before-catalog-store-delete';

    /**
     * Событие, вызываемое перед обновлением параметров склада.
     */
    const CATALOG_BEFORE_CATALOG_STORE_UPDATE = 'catalog-before-catalog-store-update';

    /**
     * Событие, вызываемое перед добавлением нового купона.
     */
    const CATALOG_BEFORE_COUPON_ADD = 'catalog-before-coupon-add';

    /**
     * Событие, вызываемое перед удалением купона.
     */
    const CATALOG_BEFORE_COUPON_DELETE = 'catalog-before-coupon-delete';

    /**
     * Событие, вызываемое перед обновлением купона.
     */
    const CATALOG_BEFORE_COUPON_UPDATE = 'catalog-before-coupon-update';

    /**
     * Событие, вызываемое перед добавлением новой скидки.
     */
    const CATALOG_BEFORE_DISCOUNT_ADD = 'catalog-before-discount-add';

    /**
     * Событие, вызываемое перед удалением скидки.
     */
    const CATALOG_BEFORE_DISCOUNT_DELETE = 'catalog-before-discount-delete';

    /**
     * Событие, перед обновлением скидки.
     */
    const CATALOG_BEFORE_DISCOUNT_UPDATE = 'catalog-before-discount-update';

    /**
     * Событие, вызываемое перед добавлением типа цены.
     */
    const CATALOG_BEFORE_GROUP_ADD = 'catalog-before-group-add';

    /**
     * Событие, вызываемое перед удалением типа цены.
     */
    const CATALOG_BEFORE_GROUP_DELETE = 'catalog-before-group-delete';

    /**
     * Событие, вызываемое перед обновлением типа цены.
     */
    const CATALOG_BEFORE_GROUP_UPDATE = 'catalog-before-group-update';

    /**
     * Событие, вызываемое перед добавлением новой цены товара.
     */
    const CATALOG_BEFORE_PRICE_ADD = 'catalog-before-price-add';

    /**
     * Событие, вызываемое перед удалением новой цены товара.
     */
    const CATALOG_BEFORE_PRICE_DELETE = 'catalog-before-price-delete';

    /**
     * Событие, вызываемое перед обновлением новой цены товара.
     */
    const CATALOG_BEFORE_PRICE_UPDATE = 'catalog-before-price-update';

    /**
     * Событие, вызываемое перед добавлением товара.
     */
    const CATALOG_BEFORE_PRODUCT_ADD = 'catalog-before-product-add';

    /**
     * Событие, вызываемое перед удалением существующих цен товара.
     */
    const CATALOG_BEFORE_PRODUCT_PRICE_DELETE = 'catalog-before-product-price-delete';

    /**
     * Событие, вызываемое перед обновлением параметров товара.
     */
    const CATALOG_BEFORE_PRODUCT_UPDATE = 'catalog-before-product-update';

    /**
     * Событие, вызываемое перед созданием новой записи о добавлении товара на склад.
     */
    const CATALOG_BEFORE_STORE_PRODUCT_ADD = 'catalog-before-product-update';

    /**
     * Событие, вызываемое перед удалением записи из таблицы остатков товара с кодом ID.
     */
    const CATALOG_BEFORE_STORE_PRODUCT_DELETE = 'catalog-before-product-delete';

    /**
     * Событие, вызываемое перед изменением записи в таблице остатков товара.
     */
    const CATALOG_BEFORE_STORE_PRODUCT_UPDATE = 'catalog-before-product-update';

    /**
     * Событие, вызываемое при удалении записи о том, что инфоблок является торговым каталогом.
     */
    const CATALOG_CATALOG_DELETE = 'catalog-catalog-delete';

    /**
     * Событие, вызываемое в случае успешного добавления нового склада.
     */
    const CATALOG_CATALOG_STORE_ADD = 'catalog-catalog-store-add';

    /**
     * Событие, вызываемое при удалении существующего склада.
     */
    const CATALOG_CATALOG_STORE_DELETE = 'catalog-catalog-store-delete';

    /**
     * Событие, вызываемое в случае успешного изменения параметров склада.
     */
    const CATALOG_CATALOG_STORE_UPDATE = 'catalog-catalog-store-update';

    /**
     * Событие, позволяет заменить стандартный метод вычисления цены, получающейся после применения цепочки скидок.
     */
    const CATALOG_COUNT_PRICE_WITH_DISCOUNT = 'catalog-count-price-with-discount';

    /**
     * Событие, вызываемое перед окончанием работы метода CCatalogProduct::CountPriceWithDiscount. Позволяет выполнить некоторые действия над полученным результатом работы этого метода.
     */
    const CATALOG_COUNT_PRICE_WITH_DISCOUNT_RESULT = 'catalog-count-price-with-discount-result';

    /**
     * Событие, вызываемое в случае успешного добавления купона.
     */
    const CATALOG_COUPON_ADD = 'catalog-coupon-add';

    /**
     * Событие, вызываемое при удалении существующего купона.
     */
    const CATALOG_COUPON_DELETE = 'catalog-coupon-delete';

    /**
     * Событие, вызываемое в случае успешного изменения информации о купоне.
     */
    const CATALOG_COUPON_UPDATE = 'catalog-coupon-update';

    /**
     * Событие, вызываемое в случае успешного добавления скидки.
     */
    const CATALOG_DISCOUNT_ADD = 'catalog-discount-add';

    /**
     * Событие,  вызываемое при удалении существующей скидки.
     */
    const CATALOG_DISCOUNT_DELETE = 'catalog-discount-delete';

    /**
     * Событие,  вызываемое при обновлении существующей скидки.
     */
    const CATALOG_DISCOUNT_UPDATE = 'catalog-discount-update';

    /**
     * Событие, вызываемое в функции CatalogGenerateCoupon(). Позволяет заменить стандартный метод генерации кода купона.
     */
    const CATALOG_DISCOUNT_COUPON = 'catalog-discount-coupon';

    /**
     * Событие, вызываемое в функции CatalogGenerateCoupon(). Позволяет заменить стандартный метод генерации кода купона.
     */
    const CATALOG_GENERATE_COUPON = 'catalog-discount-coupon';

    /**
     * Событие, вызываемое в методе CCatalogDiscount::GetDiscount. Позволяет заменить стандартный метод выбора скидок.
     */
    const CATALOG_GET_DISCOUNT = 'catalog-get-discount';

    /**
     * Событие, вызываемое при вычислении скидки на цену с кодом productPriceID товара для пользователя, принадлежащего к группам пользователей arUserGroups. Позволяет изменить логику работы метода CCatalogDiscount::GetDiscountByPrice.
     */
    const CATALOG_GET_DISCOUNT_BY_PRICE = 'catalog-get-discount-by-price';

    /**
     * Событие, вызываемое при вычислении скидки на товар с кодом productID для пользователя, принадлежащего к группам пользователей arUserGroups.
     */
    const CATALOG_GET_DISCOUNT_BY_PRODUCT = 'catalog-get-discount-by-product';

    /**
     * Событие, вызываемое перед окончанием работы метода CCatalogDiscount::GetDiscount. Позволяет выполнить некоторые действия над полученными результатами работы этого метода.
     */
    const CATALOG_GET_DISCOUNT_RESULT = 'catalog-get-discount-result';

    /**
     * Событие, вызываемое в методе CCatalogProduct::GetNearestQuantityPrice. Позволяет заменить стандартный метод поиска количества товара, доступного для покупки.
     */
    const CATALOG_GET_NEAREST_QUANTITY_PRICE = 'catalog-get-nearest-quantity-price';

    /**
     * Событие, вызываемое перед окончанием работы метода CCatalogProduct::GetNearestQuantityPrice. Позволяет выполнить некоторые действия над полученным результатом работы этого метода.
     */
    const CATALOG_GET_NEAREST_QUANTITY_PRICE_RESULT = 'catalog-get-nearest-quantity-price-result';

    /**
     * Событие, вызываемое в методе CCatalogProduct::GetOptimalPrice. Позволяет заменить стандартный метод
     * выборки наименьшей цены для товара (использование этого обработчика для реализации алгоритмов,
     * требующих информации о корзине, невозможно).
     */
    const CATALOG_GET_OPTIMAL_PRICE = 'catalog-get-optimal-price';

    /**
     * Событие, вызываемое перед окончанием работы метода CCatalogProduct::GetOptimalPrice.
     * Позволяет выполнить некоторые действия над полученным результатом работы этого метода.
     */
    const CATALOG_GET_OPTIMAL_PRICE_RESULT = 'catalog-get-optimal-price-result';

    /**
     * Событие, вызываемое в случае успешного создания нового типа цены.
     */
    const CATALOG_GROUP_ADD = 'catalog-group-add';

    /**
     * Событие, вызываемое при удалении существующего типа цены в методе CCatalogGroup::Delete.
     */
    const CATALOG_GROUP_DELETE = 'catalog-group-delete';

    /**
     * Событие, вызываемое в случае успешного изменения типа цены.
     */
    const CATALOG_GROUP_UPDATE = 'catalog-group-update';

    /**
     * Событие, вызываемое в случае успешного создания нового ценового предложения (новой цены) для товара.
     */
    const CATALOG_PRICE_ADD = 'catalog_price_add';

    /**
     * Событие, вызываемое при удалении существующей цены товара в методе CPrice::Delete().
     * На вход получает ID цены товара (см. CPrice::Delete )
     */
    const CATALOG_PRICE_DELETE = 'catalog-price-delete';

    /**
     * Событие, вызываемое в случае успешного изменения ценового предложения (цены) товара.
     */
    const CATALOG_PRICE_UPDATE = 'catalog-price-update';

    /**
     * Событие, вызываемое в случае успешного добавления параметров товара к элементу каталога.
     */
    const CATALOG_PRODUCT_ADD = 'catalog-product-add';

    /**
     * Событие, вызываемое в процессе удаления существующих цен товара в методе CPrice::DeleteByProduct().
     * На вход получает ID товара и массив ID цен, не подлежащих удалению.
     */
    const CATALOG_PRODUCT_PRICE_DELETE = 'catalog-product-price-delete';

    /**
     * Событие, вызываемое в случае успешного изменения параметров товара.
     */
    const CATALOG_PRODUCT_UPDATE = 'catalog-product-update';

    /**
     * Событие, вызываемое в случае успешного создания новой записи о добавлении товара на склад.
     */
    const CATALOG_STORE_PRODUCT_ADD = 'catalog-store-product-add';

    /**
     * Событие, вызываемое в случае успешного удаления записи из таблицы остатков товара на складе
     * (метод CCatalogStoreProductAll::Delete).
     */
    const CATALOG_STORE_PRODUCT_DELETE = 'catalog-store-product-delete';

    /**
     * Событие, вызываемое в случае успешного изменения записи в таблице остатков товара
     * с кодом ID в методе CCatalogStoreProductAll::Update.
     */
    const CATALOG_STORE_PRODUCT_UPDATE = 'catalog-store-product-update';

    static $params = array(
        self::MAIN_PAGE_START => array('main', 'OnPageStart'),
        self::MAIN_ADMIN_CONTEXT_MENU_SHOW => array('main', 'OnAdminContextMenuShow'),
        self::MAIN_ADMIN_LIST_DISPLAY => array('main', 'OnAdminListDisplay'),
        self::MAIN_ADMIN_TAB_CONTROL_BEGIN => array('main', 'OnAdminTabControlBegin'),
        self::MAIN_AFTER_AJAX_RESPONSE => array('main','onAfterAjaxResponse'),
        self::MAIN_AFTER_EPILOG => array('main','OnAfterEpilog'),
        self::MAIN_AFTER_GROUP_ADD => array('main','OnAfterGroupAdd'),
        self::MAIN_AFTER_GROUP_UPDATE => array('main','OnAfterGroupUpdate'),
        self::MAIN_AFTER_USER_ADD => array('main','OnAfterUserAdd'),
        self::MAIN_AFTER_USER_AUTHORIZE => array('main','OnAfterUserAuthorize'),
        self::MAIN_AFTER_USER_LOGIN => array('main','OnAfterUserLogin'),
        self::MAIN_AFTER_USER_LOGIN_BY_HASH => array('main','OnAfterUserLoginByHash'),
        self::MAIN_AFTER_USER_LOGOUT => array('main','OnAfterUserLogout'),
        self::MAIN_AFTER_USER_REGISTER => array('main','OnAfterUserRegister'),
        self::MAIN_AFTER_USER_SIMPLE_REGISTER => array('main','OnAfterUserSimpleRegister'),
        self::MAIN_AFTER_USER_UPDATE => array('main','OnAfterUserUpdate'),
        self::MAIN_BEFORE_CHANGE_FILE => array('main','OnBeforeChangeFile'),
        self::MAIN_BEFORE_EVENT_ADD => array('main','OnBeforeEventAdd'),
        self::MAIN_BEFORE_EVENT_MESSAGE_DELETE => array('main','OnBeforeEventMessageDelete'),
        self::MAIN_BEFORE_EVENT_SEND => array('main','OnBeforeEventSend'),
        self::MAIN_BEFORE_GROUP_ADD => array('main','OnBeforeGroupAdd'),
        self::MAIN_BEFORE_GROUP_DELETE => array('main','OnBeforeGroupDelete'),
        self::MAIN_BEFORE_GROUP_UPDATE => array('main','OnBeforeGroupUpdate'),
        self::MAIN_BEFORE_LANGUAGE_DELETE => array('main','OnBeforeLanguageDelete'),
        self::MAIN_BEFORE_PROLOG => array('main','OnBeforeProlog'),
        self::MAIN_BEFORE_SITE_DELETE => array('main','OnBeforeSiteDelete'),
        self::MAIN_BEFORE_USER_ADD => array('main','OnBeforeUserAdd'),
        self::MAIN_BEFORE_USER_DELETE => array('main','OnBeforeUserDelete'),
        self::MAIN_BEFORE_USER_LOGIN => array('main','OnBeforeUserLogin'),
        self::MAIN_BEFORE_USER_LOGIN_BY_HASH => array('main','OnBeforeUserLoginByHash'),
        self::MAIN_BEFORE_USER_LOGOUT => array('main','OnBeforeUserLogout'),
        self::MAIN_BEFORE_USER_REGISTER => array('main','OnBeforeUserRegister'),
        self::MAIN_BEFORE_USER_SIMPLE_REGISTER => array('main','OnBeforeUserSimpleRegister'),
        self::MAIN_BEFORE_USER_UPDATE => array('main','OnBeforeUserUpdate'),
        self::MAIN_BUILD_GLOBAL_MENU => array('main','OnBuildGlobalMenu'),
        self::MAIN_CHANGE_PERMISSIONS => array('main','OnChangePermissions'),
        self::MAIN_END_BUFFER_CONTENT => array('main','OnEndBufferContent'),
        self::MAIN_EPILOG => array('main','OnEpilog'),
        self::MAIN_EVENT_MESSAGE_DELETE => array('main','OnEventMessageDelete'),
        self::MAIN_EXTERNAL_AUTH_LIST => array('main','OnExternalAuthList'),
        self::MAIN_FILE_DELETE => array('main','OnFileDelete'),
        self::MAIN_GROUP_DELETE => array('main','OnGroupDelete'),
        self::MAIN_LANGUAGE_DELETE => array('main','OnLanguageDelete'),
        self::MAIN_PANEL_CREATE => array('main','OnPanelCreate'),
        self::MAIN_PROLOG => array('main','OnProlog'),
        self::MAIN_SEND_USER_INFO => array('main','OnSendUserInfo'),
        self::MAIN_SITE_DELETE => array('main','OnSiteDelete'),
        self::MAIN_USER_DELETE => array('main','OnUserDelete'),
        self::MAIN_USER_LOGIN_EXTERNAL => array('main','OnUserLoginExternal'),
        self::MAIN_EVENT_LOG_GET_AUDIT_TYPES => array('main','OnEventLogGetAuditTypes'),

        self::IBLOCK_AFTER_IBLOCK_ADD => array('iblock','OnAfterIBlockAdd'),
        self::IBLOCK_AFTER_IBLOCK_ELEMENT_ADD => array('iblock','OnAfterIBlockElementAdd'),
        self::IBLOCK_AFTER_IBLOCK_ELEMENT_DELETE => array('iblock','OnAfterIBlockElementDelete'),
        self::IBLOCK_AFTER_IBLOCK_ELEMENT_SET_PROPERTY_VALUES => array('iblock','OnAfterIBlockElementSetPropertyValues'),
        self::IBLOCK_AFTER_IBLOCK_ELEMENT_SET_PROPERTY_VALUES_EX => array('iblock','OnAfterIBlockElementSetPropertyValuesEx'),
        self::IBLOCK_AFTER_IBLOCK_ELEMENT_ELEMENT_UPDATE => array('iblock','OnAfterIBlockElementUpdate'),
        self::IBLOCK_AFTER_IBLOCK_PROPERTY_ADD => array('iblock','OnAfterIBlockPropertyAdd'),
        self::IBLOCK_AFTER_IBLOCK_PROPERTY_UPDATE => array('iblock','OnAfterIBlockPropertyUpdate'),
        self::IBLOCK_AFTER_IBLOCK_SECTION_ADD => array('iblock','OnAfterIBlockSectionAdd'),
        self::IBLOCK_AFTER_IBLOCK_SECTION_UPDATE => array('iblock','OnAfterIBlockSectionUpdate'),
        self::IBLOCK_AFTER_IBLOCK_UPDATE => array('iblock','OnAfterIBlockUpdate'),
        self::IBLOCK_BEFORE_IBLOCK_ADD => array('iblock','OnBeforeIBlockAdd'),
        self::IBLOCK_BEFORE_IBLOCK_DELETE => array('iblock','OnBeforeIBlockDelete'),
        self::IBLOCK_BEFORE_IBLOCK_ELEMENT_ADD => array('iblock','OnBeforeIBlockElementAdd'),
        self::IBLOCK_BEFORE_IBLOCK_ELEMENT_DELETE => array('iblock','OnBeforeIBlockElementDelete'),
        self::IBLOCK_BEFORE_IBLOCK_ELEMENT_UPDATE => array('iblock','OnBeforeIBlockElementUpdate'),
        self::IBLOCK_BEFORE_IBLOCK_PROPERTY_ADD => array('iblock','OnBeforeIBlockPropertyAdd'),
        self::IBLOCK_BEFORE_IBLOCK_PROPERTY_DELETE => array('iblock','OnBeforeIBlockPropertyDelete'),
        self::IBLOCK_BEFORE_IBLOCK_PROPERTY_UPDATE => array('iblock','OnBeforeIBlockPropertyUpdate'),
        self::IBLOCK_BEFORE_IBLOCK_SECTION_ADD => array('iblock','OnBeforeIBlockSectionAdd'),
        self::IBLOCK_BEFORE_IBLOCK_SECTION_DELETE => array('iblock','OnBeforeIBlockSectionDelete'),
        self::IBLOCK_BEFORE_IBLOCK_SECTION_UPDATE => array('iblock','OnBeforeIBlockSectionUpdate'),
        self::IBLOCK_BEFORE_IBLOCK_UPDATE => array('iblock','OnBeforeIBlockUpdate'),
        self::IBLOCK_DELETE => array('iblock','OnIBlockDelete'),
        self::IBLOCK_ELEMENT_DELETE => array('iblock','OnIBlockElementDelete'),
        self::IBLOCK_PROPERTY_BUILD_LIST => array('iblock','OnIBlockPropertyBuildList'),
        self::IBLOCK_START_IBLOCK_ELEMENT_ADD => array('iblock','OnStartIBlockElementAdd'),
        self::IBLOCK_START_IBLOCK_ELEMENT_UPDATE => array('iblock','OnStartIBlockElementUpdate'),

        self::SALE_BEFORE_PERSON_TYPE_ADD => array('sale','OnBeforePersonTypeAdd'),
        self::SALE_PERSON_TYPE_ADD => array('sale','OnPersonTypeAdd'),
        self::SALE_BEFORE_PERSON_TYPE_UPDATE => array('sale','OnBeforePersonTypeUpdate'),
        self::SALE_PERSON_TYPE_UPDATE => array('sale','OnPersonTypeUpdate'),
        self::SALE_BEFORE_PERSON_TYPE_DELETE => array('sale','OnBeforePersonTypeDelete'),
        self::SALE_PERSON_TYPE_DELETE => array('sale','OnPersonTypeDelete'),

        self::SALE_CITY_ADD => array('sale','OnCityAdd'),
        self::SALE_CITY_DELETE => array('sale','OnCityDelete'),
        self::SALE_CITY_UPDATE => array('sale','OnCityUpdate'),
        self::SALE_BEFORE_CITY_ADD => array('sale','OnBeforeCityAdd'),
        self::SALE_BEFORE_CITY_DELETE => array('sale','OnBeforeCityDelete'),
        self::SALE_BEFORE_CITY_UPDATE => array('sale','OnBeforeCityUpdate'),
        self::SALE_REGION_DELETE => array('sale','OnRegionDelete'),
        self::SALE_BEFORE_REGION_DELETE => array('sale','OnBeforeRegionDelete'),
        self::SALE_REGION_UPDATE => array('sale','OnRegionUpdate'),
        self::SALE_BEFORE_REGION_UPDATE => array('sale','OnBeforeRegionUpdate'),
        self::SALE_BEFORE_REGION_ADD => array('sale','OnBeforeRegionAdd'),
        self::SALE_REGION_ADD => array('sale','OnRegionAdd'),
        self::SALE_COUNTRY_ADD => array('sale','OnCountryAdd'),
        self::SALE_COUNTRY_DELETE => array('sale','OnCountryDelete'),
        self::SALE_COUNTRY_UPDATE => array('sale','OnCountryUpdate'),
        self::SALE_BEFORE_COUNTRY_ADD => array('sale','OnBeforeCountryAdd'),
        self::SALE_BEFORE_COUNTRY_DELETE => array('sale','OnBeforeCountryDelete'),
        self::SALE_BEFORE_COUNTRY_UPDATE => array('sale','OnBeforeCountryUpdate'),
        self::SALE_LOCATION_DELETE => array('sale','OnLocationDelete'),
        self::SALE_LOCATION_DELETE_ALL => array('sale','OnLocationDeleteAll'),
        self::SALE_LOCATION_ADD => array('sale','OnLocationAdd'),
        self::SALE_LOCATION_UPDATE => array('sale','OnLocationUpdate'),
        self::SALE_BEFORE_LOCATION_ADD => array('sale','OnBeforeLocationAdd'),
        self::SALE_BEFORE_LOCATION_DELETE => array('sale','OnBeforeLocationDelete'),
        self::SALE_BEFORE_LOCATION_DELETE_ALL => array('sale','OnBeforeLocationDeleteAll'),
        self::SALE_BEFORE_LOCATION_UPDATE => array('sale','OnBeforeLocationUpdate'),
        self::SALE_LOCATION_GROUP_ADD => array('sale','OnLocationGroupAdd'),
        self::SALE_LOCATION_GROUP_DELETE => array('sale','OnLocationGroupDelete'),
        self::SALE_LOCATION_GROUP_UPDATE => array('sale','OnLocationGroupUpdate'),
        self::SALE_BEFORE_LOCATION_GROUP_ADD => array('sale','OnBeforeLocationGroupAdd'),
        self::SALE_BEFORE_LOCATION_GROUP_DELETE => array('sale','OnBeforeLocationGroupDelete'),
        self::SALE_BEFORE_LOCATION_GROUP_UPDATE => array('sale','OnBeforeLocationGroupUpdate'),

        self::SALE_BEFORE_ORDER_ADD => array('sale','OnBeforeOrderAdd'),
        self::SALE_ORDER_ADD => array('sale','OnOrderAdd'),
        self::SALE_BEFORE_ORDER_UPDATE => array('sale','OnBeforeOrderUpdate'),
        self::SALE_ORDER_UPDATE => array('sale','OnOrderUpdate'),
        self::SALE_BEFORE_ORDER_DELETE => array('sale','OnBeforeOrderDelete'),
        self::SALE_ORDER_DELETE => array('sale','OnOrderDelete'),
        self::SALE_CALCULATE_ORDER => array('sale','OnSaleCalculateOrder'),
        self::SALE_CALCULATE_ORDER_DISCOUNT => array('sale','OnSaleCalculateOrderDiscount'),
        self::SALE_CALCULATE_ORDER_DELIVERY => array('sale','OnSaleCalculateOrderDelivery'),
        self::SALE_CALCULATE_ORDER_DELIVERY_TAX => array('sale','OnSaleCalculateOrderDeliveryTax'),
        self::SALE_CALCULATE_ORDER_PAY_SYSTEM => array('sale','OnSaleCalculateOrderPaySystem'),
        self::SALE_CALCULATE_ORDER_PERSON_TYPE => array('sale','OnSaleCalculateOrderPersonType'),
        self::SALE_CALCULATE_ORDER_PROPS => array('sale','OnSaleCalculateOrderProps'),
        self::SALE_CALCULATE_ORDER_SHOPPING_CART => array('sale','OnSaleCalculateOrderShoppingCart'),
        self::SALE_CALCULATE_ORDER_SHOPPING_CART_TAX => array('sale','OnSaleCalculateOrderShoppingCartTax'),

        self::SALE_BEFORE_STATUS_ADD => array('sale','OnBeforeStatusAdd'),
        self::SALE_STATUS_ADD => array('sale','OnStatusAdd'),
        self::SALE_BEFORE_STATUS_UPDATE => array('sale','OnBeforeStatusUpdate'),
        self::SALE_STATUS_UPDATE => array('sale','OnStatusUpdate'),
        self::SALE_BEFORE_STATUS_DELETE => array('sale','OnBeforeStatusDelete'),
        self::SALE_STATUS_DELETE => array('sale','OnStatusDelete'),
        self::SALE_BEFORE_B_AFFILIATE_ADD => array('sale','OnBeforeBAffiliateAdd'),
        self::SALE_AFTER_B_AFFILIATE_ADD => array('sale','OnAfterBAffiliateAdd'),
        self::SALE_BEFORE_AFFILIATE_UPDATE => array('sale','OnBeforeAffiliateUpdate'),
        self::SALE_AFTER_AFFILIATE_UPDATE => array('sale','OnAfterAffiliateUpdate'),
        self::SALE_BEFORE_AFFILIATE_DELETE => array('sale','OnBeforeAffiliateDelete'),
        self::SALE_AFTER_AFFILIATE_DELETE => array('sale','OnAfterAffiliateDelete'),
        self::SALE_BEFORE_AFFILIATE_CALCULATE => array('sale','OnBeforeAffiliateCalculate'),
        self::SALE_AFTER_AFFILIATE_CALCULATE => array('sale','OnAfterAffiliateCalculate'),
        self::SALE_BEFORE_PAY_AFFILIATE => array('sale','OnBeforePayAffiliate'),
        self::SALE_AFTER_PAY_AFFILIATE => array('sale','OnAfterPayAffiliate'),
        self::SALE_BEFORE_AFFILIATE_PLAN_ADD => array('sale','OnBeforeAffiliatePlanAdd'),
        self::SALE_AFTER_AFFILIATE_PLAN_ADD => array('sale','OnAfterAffiliatePlanAdd'),
        self::SALE_BEFORE_AFFILIATE_PLAN_UPDATE => array('sale','OnBeforeAffiliatePlanUpdate'),
        self::SALE_AFTER_AFFILIATE_PLAN_UPDATE => array('sale','OnAfterAffiliatePlanUpdate'),
        self::SALE_BEFORE_AFFILIATE_PLAN_DELETE => array('sale','OnBeforeAffiliatePlanDelete'),
        self::SALE_AFTER_AFFILIATE_PLAN_DELETE => array('sale','OnAfterAffiliatePlanDelete'),

        self::SALE_BEFORE_PAY_ORDER => array('sale','OnSaleBeforePayOrder'),
        self::SALE_PAY_ORDER => array('sale','OnSalePayOrder'),
        self::SALE_BEFORE_DELIVERY_ORDER => array('sale','OnSaleBeforeDeliveryOrder'),
        self::SALE_DELIVERY_ORDER => array('sale','OnSaleDeliveryOrder'),
        self::SALE_BEFORE_CANCEL_ORDER => array('sale','OnSaleBeforeCancelOrder'),
        self::SALE_CANCEL_ORDER_ORDER => array('sale','OnSaleCancelOrder'),
        self::SALE_BEFORE_STATUS_ORDER => array('sale','OnSaleBeforeStatusOrder'),
        self::SALE_STATUS_ORDER => array('sale','OnSaleStatusOrder'),

        self::SALE_BEFORE_BASKET_ADD => array('sale','OnBeforeBasketAdd'),
        self::SALE_BASKET_ADD => array('sale','OnBasketAdd'),
        self::SALE_BEFORE_BASKET_UPDATE => array('sale','OnBeforeBasketUpdate'),
        self::SALE_BASKET_UPDATE => array('sale','OnBasketUpdate'),
        self::SALE_BEFORE_BASKET_UPDATE_AFTER_CHECK => array('sale','OnBeforeBasketUpdateAfterCheck'),
        self::SALE_BEFORE_BASKET_DELETE => array('sale','OnBeforeBasketDelete'),
        self::SALE_BASKET_DELETE => array('sale','OnBasketDelete'),
        self::SALE_SET_COUPON_LIST => array('sale','OnSetCouponList'),
        self::SALE_CLEAR_COUPON_LIST => array('sale','OnClearCouponList'),
        self::SALE_DELETE_COUPON_LIST => array('sale','OnDeleteCouponList'),

        self::SALE_ORDER_NEW_SEND_EMAIL => array('sale','OnOrderNewSendEmail'),
        self::SALE_ORDER_DELIVER_SEND_EMAIL => array('sale','OnOrderDeliverSendEmail'),
        self::SALE_ORDER_PAY_SEND_EMAIL => array('sale','OnOrderPaySendEmail'),
        self::SALE_ORDER_CANCEL_SEND_EMAIL => array('sale','OnOrderCancelSendEmail'),
        self::SALE_STATUS_EMAIL => array('sale','OnSaleStatusEMail'),
        self::SALE_ORDER_STATUS_SEND_EMAIL => array('sale','OnOrderStatusSendEmail'),
        self::SALE_ORDER_REMIND_SEND_EMAIL => array('sale','OnOrderRemindSendEmail'),
        self::SALE_ORDER_RECURRING_SEND_EMAIL => array('sale','OnOrderRecurringSendEmail'),
        self::SALE_ORDER_RECURRING_CANCEL_SEND_EMAIL => array('sale','OnOrderRecurringCancelSendEmail'),

        self::SALE_COMPONENT_ORDER_ONE_STEP_PERSON_TYPE => array('sale','OnSaleComponentOrderOneStepPersonType'),
        self::SALE_COMPONENT_ORDER_ONE_STEP_ORDER_PROPS => array('sale','OnSaleComponentOrderOneStepOrderProps'),
        self::SALE_COMPONENT_ORDER_ONE_STEP_DELIVERY => array('sale','OnSaleComponentOrderOneStepDelivery'),
        self::SALE_COMPONENT_ORDER_ONE_STEP_PAY_SYSTEM => array('sale','OnSaleComponentOrderOneStepPaySystem'),
        self::SALE_COMPONENT_ORDER_ONE_STEP_PROCESS => array('sale','OnSaleComponentOrderOneStepProcess'),
        self::SALE_COMPONENT_ORDER_ONE_STEP_COMPLETE => array('sale','OnSaleComponentOrderOneStepComplete'),
        self::SALE_COMPONENT_ORDER_ONE_STEP_FINAL => array('sale','OnSaleComponentOrderOneStepFinal'),
        self::SALE_COMPONENT_ORDER_COMPLETE => array('sale','OnSaleComponentOrderComplete'),

        self::CATALOG_BEFORE_CATALOG_DELETE => array('catalog', 'OnBeforeCatalogDelete'),
        self::CATALOG_BEFORE_CATALOG_STORE_ADD => array('catalog', 'OnBeforeCatalogStoreAdd'),
        self::CATALOG_BEFORE_CATALOG_STORE_DELETE => array('catalog', 'OnBeforeCatalogStoreDelete'),
        self::CATALOG_BEFORE_CATALOG_STORE_UPDATE => array('catalog', 'OnBeforeCatalogStoreUpdate'),
        self::CATALOG_BEFORE_COUPON_ADD => array('catalog', 'OnBeforeCouponAdd'),
        self::CATALOG_BEFORE_COUPON_DELETE => array('catalog', 'OnBeforeCouponDelete'),
        self::CATALOG_BEFORE_COUPON_UPDATE => array('catalog', 'OnBeforeCouponUpdate'),
        self::CATALOG_BEFORE_DISCOUNT_DELETE => array('catalog', 'OnBeforeDiscountDelete'),
        self::CATALOG_BEFORE_DISCOUNT_UPDATE => array('catalog', 'OnBeforeDiscountUpdate'),
        self::CATALOG_BEFORE_GROUP_ADD => array('catalog', 'OnBeforeGroupAdd'),
        self::CATALOG_BEFORE_GROUP_DELETE => array('catalog', 'OnBeforeGroupDelete'),
        self::CATALOG_BEFORE_GROUP_UPDATE => array('catalog', 'OnBeforeGroupUpdate'),
        self::CATALOG_BEFORE_PRICE_ADD => array('catalog', 'OnBeforePriceAdd'),
        self::CATALOG_BEFORE_PRICE_DELETE => array('catalog', 'OnBeforePriceDelete'),
        self::CATALOG_BEFORE_PRICE_UPDATE => array('catalog', 'OnBeforePriceUpdate'),
        self::CATALOG_BEFORE_PRODUCT_ADD => array('catalog', 'OnBeforeProductAdd'),
        self::CATALOG_BEFORE_PRODUCT_PRICE_DELETE => array('catalog', 'OnBeforeProductPriceDelete'),
        self::CATALOG_BEFORE_PRODUCT_UPDATE => array('catalog', 'OnBeforeProductUpdate'),
        self::CATALOG_BEFORE_STORE_PRODUCT_ADD => array('catalog', 'OnBeforeStoreProductAdd'),
        self::CATALOG_BEFORE_STORE_PRODUCT_DELETE => array('catalog', 'OnBeforeStoreProductDelete'),
        self::CATALOG_BEFORE_STORE_PRODUCT_UPDATE => array('catalog', 'OnBeforeStoreProductUpdate'),
        self::CATALOG_CATALOG_DELETE => array('catalog', 'OnCatalogDelete'),
        self::CATALOG_CATALOG_STORE_ADD => array('catalog', 'OnCatalogStoreAdd'),
        self::CATALOG_CATALOG_STORE_DELETE => array('catalog', 'OnCatalogStoreDelete'),
        self::CATALOG_CATALOG_STORE_UPDATE => array('catalog', 'OnCatalogStoreUpdate'),
        self::CATALOG_COUNT_PRICE_WITH_DISCOUNT => array('catalog', 'OnCountPriceWithDiscount'),
        self::CATALOG_COUNT_PRICE_WITH_DISCOUNT_RESULT => array('catalog', 'OnCountPriceWithDiscountResult'),
        self::CATALOG_COUPON_ADD => array('catalog', 'OnCouponAdd'),
        self::CATALOG_COUPON_DELETE => array('catalog', 'OnCouponDelete'),
        self::CATALOG_COUPON_UPDATE => array('catalog', 'OnCouponUpdate'),
        self::CATALOG_DISCOUNT_ADD => array('catalog', 'OnDiscountAdd'),
        self::CATALOG_DISCOUNT_DELETE => array('catalog', 'OnDiscountDelete'),
        self::CATALOG_DISCOUNT_UPDATE => array('catalog', 'OnDiscountUpdate'),
        self::CATALOG_DISCOUNT_COUPON => array('catalog', 'OnDiscountCoupon'),
        self::CATALOG_GENERATE_COUPON => array('catalog', 'OnGenerateCoupon'),
        self::CATALOG_GET_DISCOUNT => array('catalog', 'OnGetDiscount'),
        self::CATALOG_GET_DISCOUNT_BY_PRICE => array('catalog', 'OnGetDiscountByPrice'),
        self::CATALOG_GET_DISCOUNT_BY_PRODUCT => array('catalog', 'OnGetDiscountByProduct'),
        self::CATALOG_GET_DISCOUNT_RESULT => array('catalog', 'OnGetDiscountResult'),
        self::CATALOG_GET_NEAREST_QUANTITY_PRICE => array('catalog', 'OnGetNearestQuantityPrice'),
        self::CATALOG_GET_NEAREST_QUANTITY_PRICE_RESULT => array('catalog', 'OnGetNearestQuantityPriceResult'),
        self::CATALOG_GET_OPTIMAL_PRICE => array('catalog', 'OnGetOptimalPrice'),
        self::CATALOG_GET_OPTIMAL_PRICE_RESULT => array('catalog', 'OnGetOptimalPriceResult'),
        self::CATALOG_GROUP_ADD => array('catalog', 'OnGroupAdd'),
        self::CATALOG_GROUP_DELETE => array('catalog', 'OnGroupDelete'),
        self::CATALOG_GROUP_UPDATE => array('catalog', 'OnGroupUpdate'),
        self::CATALOG_PRICE_ADD => array('catalog', 'OnPriceAdd'),
        self::CATALOG_PRICE_DELETE => array('catalog', 'OnPriceDelete'),
        self::CATALOG_PRICE_UPDATE => array('catalog', 'OnPriceUpdate'),
        self::CATALOG_PRODUCT_ADD => array('catalog', 'OnProductAdd'),
        self::CATALOG_PRODUCT_PRICE_DELETE => array('catalog', 'OnProductPriceDelete'),
        self::CATALOG_PRODUCT_UPDATE => array('catalog', 'OnProductUpdate'),
        self::CATALOG_STORE_PRODUCT_ADD => array('catalog', 'OnStoreProductAdd'),
        self::CATALOG_STORE_PRODUCT_DELETE => array('catalog', 'OnStoreProductDelete'),
        self::CATALOG_STORE_PRODUCT_UPDATE => array('catalog', 'OnStoreProductUpdate'),

    );

    private $_module, $_subject;

    /**
     * @param $module
     * @param $subject
     * @throws \Exception
     */
    private function __construct($module, $subject) {
        if (!$module || !$subject) {
            throw new \Exception("Params not exists");
        }
        $this->_module = $module;
        $this->_subject = $subject;
    }

    /**
     * @param $code
     * @return \WS\Tools\Events\EventType
     * @throws \Exception
     */
    static public function create($code) {
        $params = static::$params[$code];
        if (!$params) {
            throw new \Exception();
        }
        return static::createByParams($params[0], $params[1]);
    }

    /**
     * @param $module
     * @param $subject
     * @return static
     */
    static public function createByParams($module, $subject) {
        return new static($module, $subject);
    }

    /**
     * @return string
     */
    public function getModule() {
        return $this->_module;
    }

    /**
     * @return string
     */
    public function getSubject() {
        return $this->_subject;
    }
}
