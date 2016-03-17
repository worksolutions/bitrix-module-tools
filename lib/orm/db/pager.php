<?php

namespace WS\Tools\ORM\Db;

/**
 * Class for work with pagination
 *
 * @author my.sokolovsky@gmail.com
 * 
 * @property-read integer $curPage Current Page
 * @property-read integer $elementsInPage Count elements per page
 * @property-read integer $countElements Total amount of elements
 * @property-read integer $next Next page number
 * @property-read integer $prev Previous page number
 * @property-read integer $first First page number
 * @property-read integer $last Last page number
 * @property-read integer $count Total amount of pages
 */
class Pager {

    private $_curPage, $_elementsInPage, $_countElements;
    
    private $_next, $_prev, $_count, $_first, $_last;

    /**
     * @param integer $curPage        Current Page
     * @param integer $elementsInPage Count elements per page
     * @param string $tableId Table string identifier
     */
    public function __construct($curPage, $elementsInPage, $tableId = false) {
        $this->_curPage = (int)$curPage;
        $this->_elementsInPage = (int)$elementsInPage;
        if ($tableId) {
            $this->setPagerParamsFromOptions($tableId);
        }
    }
    
    /**
     * Can get the result of the work pagination
     * @return boolean 
     */
    public function isResulted() {
        return !is_null($this->_countElements);
    }

    /**
     * Checking the $prop for non-empty
     *
     * @param string $prop
     * @return bool
     * @throws \Exception
     */
    public function isNotEmpty($prop) {
        $hiddenName = '_'.$prop;
        if (!property_exists($this, $hiddenName)) {
            throw new \Exception("Property `$prop` not exists");
        }
    }
    
    public function setCountElements($value) {
        $this->_countElements = (int) $value;
        $this->init();
    }
    
    private function init() {
        if (is_null($this->_countElements)) {
            return;
        }
        $this->_first = 1;
        $floatCountPages = $this->_countElements/$this->_elementsInPage;
        $countFullPages = (int)$floatCountPages;
        $this->_count = $countFullPages;
        if ($countFullPages < $floatCountPages) {
            $this->_count += 1;
        }
        unset($countFullPages, $floatCountPages);
        
        if ($this->_curPage > $this->_count) {
            $this->_curPage = $this->_count;
        }
        if ($this->_curPage > 1) {
            $this->_prev = $this->_curPage - 1;
        }
        if ($this->_curPage < $this->_count) {
            $this->_next = $this->_curPage + 1;
        }
        $this->_last = $this->_count;
    }
    
    public function __get($name) {
        $hiddenName = '_'.$name;
        if (property_exists($this, $hiddenName)) {
            $value = $this->{$hiddenName};
            if (!is_null($value)) {
                return $value;
            }
            throw new \Exception("Property $name is empty.");
        }
        throw new \Exception("Property $name not available.");
    }

    private function setPagerParamsFromOptions($tableId) {
        $unique = md5($tableId);
        $bSess = \CPageOption::GetOptionString("main", "nav_page_in_session", "Y") == "Y";
        if (isset($_REQUEST["SIZEN_"])) {
            $this->_elementsInPage = (int)$_REQUEST["SIZEN_"];
            if ($bSess) {
                $_SESSION["NAV_PAGE_SIZE"][$unique] = $this->_elementsInPage;
            }
        }
        elseif ($bSess && isset($_SESSION["NAV_PAGE_SIZE"][$unique])) {
            $this->_elementsInPage = $_SESSION["NAV_PAGE_SIZE"][$unique];
        }
        else {
            $aOptions = array();
            if($tableId) {
                $aOptions = \CUserOptions::GetOption("list", $tableId);
            }
            if(intval($aOptions["page_size"]) > 0) {
                $this->_elementsInPage = intval($aOptions["page_size"]);
            }
        }
    }
}
