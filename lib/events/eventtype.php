<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Events;


class EventType {

    const MAIN_PAGE_START = 'main-page-start';
    const MAIN_ADMIN_CONTEXT_MENU_SHOW = 'main-admin-context-menu-show';
    const MAIN_ADMIN_LIST_DISPLAY = 'main_admin_list_display';
    const MAIN_ADMIN_TAB_CONTROL_BEGIN = 'main_admin_tab_control_begin';
    const MAIN_AFTER_AJAX_RESPONSE = 'main_after_ajax_response';
    const MAIN_AFTER_EPILOG = 'main_after_epilog';
    const MAIN_AFTER_GROUP_ADD = 'main_after_group_add';
    const MAIN_AFTER_GROUP_UPDATE = 'main_after_group_update';
    const MAIN_AFTER_USER_ADD = 'main_after_user_add';
    const MAIN_AFTER_USER_AUTHORIZE = 'main_after_user_authorize';
    const MAIN_AFTER_USER_LOGIN = 'main_after_user_login';
    const MAIN_AFTER_USER_LOGIN_BY_HASH = 'main_after_user_login_by_hash';
    const MAIN_AFTER_USER_LOGOUT = 'main_after_user_logout';
    const MAIN_AFTER_USER_REGISTER = 'main_after_user_register';
    const MAIN_AFTER_USER_SIMPLE_REGISTER = 'main_after_user_simple_register';
    const MAIN_AFTER_USER_UPDATE = 'main_after_user_update';
    const MAIN_BEFORE_CHANGE_FILE = 'main_before_change_file';
    const MAIN_BEFORE_EVENT_ADD = 'main_before_event_add';
    const MAIN_BEFORE_EVENT_MESSAGE_DELETE = 'main_before_event_message_delete';
    const MAIN_BEFORE_EVENT_SEND = 'main_before_event_send';
    const MAIN_BEFORE_GROUP_ADD = 'main_before_group_add';
    const MAIN_BEFORE_GROUP_DELETE = 'main_before_group_delete';
    const MAIN_BEFORE_GROUP_UPDATE = 'main_before_group_update';
    const MAIN_BEFORE_LANGUAGE_DELETE = 'main_before_language_delete';
    const MAIN_BEFORE_PROLOG = 'main_before_prolog';
    const MAIN_BEFORE_SITE_DELETE = 'main_before_site_delete';
    const MAIN_BEFORE_USER_ADD = 'main_before_user_add';
    const MAIN_BEFORE_USER_DELETE = 'main_before_user_delete';
    const MAIN_BEFORE_USER_LOGIN = 'main_before_user_login';
    const MAIN_BEFORE_USER_LOGIN_BY_HASH = 'main_before_user_login_by_hash';
    const MAIN_BEFORE_USER_LOGOUT = 'main_before_user_logout';
    const MAIN_BEFORE_USER_REGISTER = 'main_before_user_register';
    const MAIN_BEFORE_USER_SIMPLE_REGISTER = 'main_before_user_simple_register';
    const MAIN_BEFORE_USER_UPDATE = 'main_before_user_update';
    const MAIN_BUILD_GLOBAL_MENU = 'main_build_global_menu';
    const MAIN_CHANGE_PERMISSIONS = 'main_change_permissions';
    const MAIN_END_BUFFER_CONTENT = 'main_end_buffer_content';
    const MAIN_EPILOG = 'main_epilog';
    const MAIN_EVENT_MESSAGE_DELETE = 'main_event_message_delete';
    const MAIN_EXTERNAL_AUTH_LIST = 'main_external_auth_list';
    const MAIN_FILE_DELETE = 'main_file_delete';
    const MAIN_GROUP_DELETE = 'main_group_delete';
    const MAIN_LANGUAGE_DELETE = 'main_language_delete';
    const MAIN_PANEL_CREATE = 'main_panel_create';
    const MAIN_PROLOG = 'main_prolog';
    const MAIN_SEND_USER_INFO = 'main_send_user_info';
    const MAIN_SITE_DELETE = 'main_site_delete';
    const MAIN_USER_DELETE = 'main_user_delete';
    const MAIN_USER_LOGIN_EXTERNAL = 'main_user_login_external';

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
