<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Events;


class EventType {

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
        self::IBLOCK_PROPERTY_BUILD_LIST => array('iblock',' OnIBlockPropertyBuildList'),
        self::IBLOCK_START_IBLOCK_ELEMENT_ADD => array('iblock',' OnStartIBlockElementAdd'),
        self::IBLOCK_START_IBLOCK_ELEMENT_UPDATE => array('iblock',' OnStartIBlockElementUpdate'),
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
