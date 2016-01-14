<?php

namespace WS\Tools\ORM\Db\Filter;

use WS\Tools\ORM\Db\Filter;

/**
 * Фильтр элементов информационных блоков.
 * 
 * В данный момент не поддерживается сложная логика.
 *
 * @author Максим Соколовский (my.sokolovsky@gmail.com)
 */
class IblockElement extends Filter {

    private $logicOr = array();
    
    public function inRange($attr, $from, $to) {
        return $this->addCondition($attr, '><', array($from, $to));
    }

    public function notInRange($attr, $from, $to) {
        return $this->addCondition($attr, '!><', array($from, $to));
    }
    
    public function hasSubstr($attr, $value) {
        return $this->addCondition($attr, '?', $value);
    }

    /**
     * @param array $first
     * @param array $second
     * @return $this
     */
    public function logicOr($first, $second) {
        $parts = func_get_args();
        $logicOr = array();
        foreach ($parts as $block) {
            $logicOr[] = $blockFilter = new static;
            foreach ($block as $blockItem) {
                $blockFilter->{$blockItem[1]}($blockItem[0], $blockItem[2]);
            }
        }
        $this->logicOr[] = $logicOr;
        return $this;
    }

    /**
     * @return array
     */
    public function getLogicOr() {
        return $this->logicOr;
    }

    public function toArray() {
        $res = parent::toArray();
        if (empty($this->logicOr)) {
            return $res;
        }
        if (!empty($this->logicOr)) {
            $res['or'] = array(
                'logic' => 'or'
            );
        }
        foreach ($this->logicOr as $orItem) {
            $resItem = array();
            /** @var IblockElement $orItemFilter */
            foreach ($orItem as $orItemFilter) {
                $resItem[] = $orItemFilter->toArray();
            }
            $res['or'][] = $resItem;
        }
        return $res;
    }
}
