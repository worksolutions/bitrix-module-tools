<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Access;

use WS\Tools\Base;

abstract class Access extends Base {

    /**
     * @var \CUser
     */
    private $user;

    /**
     * @var array
     */
    private $actions;
    /**
     * @var null
     */
    private $resource;

    /**
     * @var array
     */
    private $groups = array();

    /**
     * @param \CUser $user
     * @param array $actions
     * @param mixed|null $resource
     */
    public function __construct($actions, \CUser $user = null, $resource = null) {
        $this->user = $user;
        foreach ($actions ?: array() as $itemActions => $roles) {
            $itemActions = explode(',', $itemActions);
            array_walk($itemActions, function (& $item) {
                $item = trim($item);
            });
            foreach ($itemActions as $action) {
                $this->actions[$action] = $roles;
            }
        }
        $this->resource = $resource;
    }

    /**
     * @return array|null
     */
    abstract public function getRoles();

    /**
     * @return mixed|null
     */
    public function getResource() {
        return $this->resource;
    }

    /**
     * @return array
     */
    public function getUserGroups() {
        if ($this->groups) {
            return $this->groups;
        }
        $ids = $this->user->GetUserGroupArray();
        $res = array();
        $dbRes = \CGroup::GetList($by = null, $order = null, array('ID' => implode('|', $ids)));
        while ($item = $dbRes->Fetch()) {
            $res[] = $item['STRING_ID'];
        }
        $this->groups = array_filter($res);
        return $this->groups;
    }

    /**
     * @return \CUser
     */
    public function getUser() {
        return $this->user;
    }

    /**
     * @param $action
     * @return bool
     */
    protected function fitAction($action) {
        $roles = $this->actions[$action];
        if (!$roles) {
            return false;
        }
        return (bool) array_intersect($this->getRoles(), $roles ?: array());
    }

    /**
     * @param mixed $action
     * @return bool
     */
    public function can($action) {
        return $this->fitAction($action);
    }
}
