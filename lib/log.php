<?php
/**
 * Created by PhpStorm.
 * User: Sokolovsky
 * Date: 12.02.2015
 * Time: 10:57
 */

namespace WS\Tools;


/**
 * Easy logging data
 * Class Log
 * @package WS\Tools
 */
class Log {

    const SEVERITY_SECURITY = "SECURITY";
    const SEVERITY_ERROR    = "ERROR";
    const SEVERITY_WARNING  = "WARNING";
    const SEVERITY_INFO     = "INFO";
    const SEVERITY_DEBUG    = "DEBUG";

    /**
     * Users defaults
     */
    const AUDIT_TYPE_USER_AUTHORIZE = "USER_AUTHORIZE";
    const AUDIT_TYPE_USER_LOGOUT    = "USER_LOGOUT";
    const AUDIT_TYPE_USER_REGISTER  = "USER_REGISTER";
    const AUDIT_TYPE_USER_INFO      = "USER_INFO";
    const AUDIT_TYPE_USER_PASSWORD_CHANGED = "USER_PASSWORD_CHANGED";
    const AUDIT_TYPE_USER_DELETE    = "USER_DELETE";
    const AUDIT_TYPE_USER_GROUP_CHANGED = "USER_GROUP_CHANGED";
    /**
     * User groups defaults
     */
    const AUDIT_TYPE_GROUP_POLICY_CHANGED = "GROUP_POLICY_CHANGED";
    const AUDIT_TYPE_MODULE_RIGHTS_CHANGED = "MODULE_RIGHTS_CHANGED";
    /**
     * Iblocks defaults
     */
    const AUDIT_TYPE_IBLOCK_SECTION_ADD = "IBLOCK_SECTION_ADD";
    const AUDIT_TYPE_IBLOCK_SECTION_EDIT = "IBLOCK_SECTION_EDIT";
    const AUDIT_TYPE_IBLOCK_SECTION_DELETE = "IBLOCK_SECTION_DELETE";
    const AUDIT_TYPE_IBLOCK_ELEMENT_ADD = "IBLOCK_ELEMENT_ADD";
    const AUDIT_TYPE_IBLOCK_ELEMENT_EDIT = "IBLOCK_ELEMENT_EDIT";
    const AUDIT_TYPE_IBLOCK_ELEMENT_DELETE = "IBLOCK_ELEMENT_DELETE";
    const AUDIT_TYPE_IBLOCK_ADD = "IBLOCK_ADD";
    const AUDIT_TYPE_IBLOCK_EDIT = "IBLOCK_EDIT";
    const AUDIT_TYPE_IBLOCK_DELETE = "IBLOCK_DELETE";

    private $_severity, $_type, $_moduleId, $_description, $_itemId;

    private $_stateSaved = false;

    public function put() {
        if ($this->_stateSaved) {
            throw new \Exception("Log instance saved before");
        }
        $this->_stateSaved = true;
        return \CEventLog::Log($this->_severity, $this->_type, $this->_moduleId, $this->_itemId, $this->_description);
    }

    public function __construct($type) {
        $this->_type = $type;
        $this->_severity = self::SEVERITY_DEBUG;
        $this->_moduleId = "main";
    }

    /**
     * @param $value
     * @return $this
     */
    public function severity($value) {
        $this->_severity = $value;
        return $this;
    }

    /**
     * @return $this
     */
    public function severityAsSecurity() {
        return $this->severity(self::SEVERITY_SECURITY);
    }
    /**
     * @return $this
     */
    public function severityAsError() {
        return $this->severity(self::SEVERITY_ERROR);
    }
    /**
     * @return $this
     */
    public function severityAsWarning() {
        return $this->severity(self::SEVERITY_WARNING);
    }
    /**
     * @return $this
     */
    public function severityAsInfo() {
        return $this->severity(self::SEVERITY_INFO);
    }
    /**
     * @return $this
     */
    public function severityAsDebug() {
        return $this->severity(self::SEVERITY_DEBUG);
    }

    /**
     * @param $value
     * @return $this
     */
    public function moduleId($value) {
        $this->_moduleId = $value;
        return $this;
    }

    /**
     * @param $value
     * @return $this
     */
    public function itemId($value) {
        $this->_itemId = $value;
        return $this;
    }

    /**
     * @param mixed $value Any value (scalar, array, object!)
     * @return $this
     */
    public function description($value) {
        // processing object
        if (is_object($value)) {
            $obj = new \ReflectionObject($value);
            $props = array_filter($obj->getProperties(), function (\ReflectionProperty $property) use ($obj) {
                return !is_object($property->getValue($obj));
            });
            /** @var \ReflectionProperty $property */
            $value = array();
            foreach ($props as $property) {
                $value[$property->getName()] = $property->getValue($obj);
            }
        }
        // processing array
        if (is_array($value)) {
            $value = json_encode($value, defined("JSON_PRETTY_PRINT") ? JSON_PRETTY_PRINT : 0);
        }
        $this->_description = $value;
        return $this;
    }
}