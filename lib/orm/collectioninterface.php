<?php
/**
 * @author Smotrov Dmitriy <smotrov@worksolutions.ru>
 */

namespace WS\Tools\ORM;


interface CollectionInterface {

    public function push($entity);

    public function pop();

}