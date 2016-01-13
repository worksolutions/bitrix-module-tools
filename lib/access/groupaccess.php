<?php
/**
 * @author Maxim Sokolovsky <sokolovsky@worksolutions.ru>
 */

namespace WS\Tools\Access;

class GroupAccess extends ResourceAccess {
    public function getRoles() {
        return $this->getUserGroups();
    }

    /**
     * @param $group
     * @return bool
     */
    public function isInGroup($group) {
        return in_array($group, $this->getUserGroups());
    }
}
