<?php
/**
 * @author Smotrov Dmitriy <smotrov@worksolutions.ru>
 */

namespace WS\Tools\ORM;


use Bitrix\Main\Entity\Query;

interface QueryCriteriaInterface {
    public function hydrateQueryBuilder(Query $query);
}