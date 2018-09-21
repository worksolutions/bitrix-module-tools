<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Access;

use WS\Tools\Base;

class AccessManager extends Base {

    /**
     * @var array
     */
    protected $actions;

    private $accessList = array();

    /**
     * @var \CUser
     */
    private $currentUser;

    public function __construct() {
        global $USER;
        $this->currentUser = $USER;

        if (!($this->currentUser instanceof \CUser)) {
            $this->currentUser = null;
        }
    }

    /**
     * @param $type
     * @param mixed|null $resource
     * @return Access
     */
    public function getAccess($type, $resource = null) {
        $list = $this->accessList[$type] ?: array();
        /** @var Access $access */
        foreach ($list as $access) {
            if ($access->getResource() === $resource) {
                return $access;
            }
        }
        $access = new $type($this->currentUser, $this->actions[$type] ?: array(), $resource);
        $this->accessList[$type][] = $access;
        return $access;
    }
}
