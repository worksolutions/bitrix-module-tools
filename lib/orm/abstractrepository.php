<?php
/**
 * @author Smotrov Dmitriy <smotrov@worksolutions.ru>
 */

namespace WS\Tools\ORM;


use Bitrix\Main\DB\Result;
use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\Query;

abstract class AbstractRepository {
    /** @var DataManager */
    private $_entityGateway;

    /**
     * @return DataManager
     */
    abstract protected function createEntityGateway();

    /**
     * @param array $data
     * @return AbstractEntity
     */
    abstract protected function createEntity(array $data = array());

    /**
     * @param AbstractEntity $entity
     * @return integer|mixed
     */
    protected function getEntityPrimary($entity) {
        return $entity->getPrimary();
    }

    /**
     * @param AbstractEntity $entity
     * @param $id
     */
    protected function setEntityPrimary($entity, $id) {
        $entity->setPrimary($id);
    }

    /**
     * @param AbstractEntity $entity
     * @return mixed
     */
    protected function existsEntity($entity) {
        return (bool)$this->getEntityPrimary($entity);
    }

    protected function createCollection() {
        return new BaseCollection();
    }

    /**
     * @param AbstractEntity $entity
     * @return array
     */
    protected function getEntityData($entity) {
        return $entity->getData();
    }

    protected function getEntityGateway() {
        if (!$this->_entityGateway) {
            $this->_entityGateway = $this->createEntityGateway();
        }

        return $this->_entityGateway;
    }

    public function find($params) {
        if (is_int($params)) {
            return $this->findById($params);
        }

        if ($params instanceof QueryCriteriaInterface) {
            return $this->findByCriteria($params);
        }

        if ($params instanceof Query) {
            return $this->findByQueryBuilder($params);
        }

        return $this->findByParams($params);
    }

    public function findByQueryBuilder(Query $queryBuilder) {
        $queryResult = $queryBuilder->exec();

        return $this->_fetchCollectionByQueryResult($queryResult);
    }

    public function findByParams(array $params) {
        $queryResult = $this->getEntityGateway()->getList($params);

        return $this->_fetchCollectionByQueryResult($queryResult);
    }

    public function findById($id) {
        $queryResult = $this->getEntityGateway()->getById($id);

        return $this->_fetchCollectionByQueryResult($queryResult)->pop();
    }

    public function findByCriteria(QueryCriteriaInterface $criteria) {

        $queryBuilder = $this->getEntityGateway()->query();
        $criteria->hydrateQueryBuilder($queryBuilder);

        $queryResult = $queryBuilder->exec();

        return $this->_fetchCollectionByQueryResult($queryResult);
    }

    private function _fetchCollectionByQueryResult(Result $queryResult) {
        $collection = $this->createCollection();

        while ($arQuery = $queryResult->fetch()) {
            $entity = $this->createEntity($arQuery);
            $collection->push($entity);
        }

        return $collection;
    }

    public function save($entity) {
        if ($this->existsEntity($entity)) {
            return $this->updateEntity($entity);
        }

        return $this->insertEntity($entity);
    }

    /**
     * @param AbstractEntity $entity
     * @return \Bitrix\Main\Entity\AddResult
     */
    protected function insertEntity($entity) {
        $data = $this->getEntityData($entity);

        $queryResult = $this->getEntityGateway()->add($data);

        if ($queryResult->isSuccess()) {
            $this->setEntityPrimary($entity, $queryResult->getId());
        }

        return $queryResult;
    }

    /**
     * @param AbstractEntity $entity
     * @return \Bitrix\Main\Entity\UpdateResult
     */
    protected function updateEntity($entity) {
        $primary = $this->getEntityPrimary($entity);
        $data = $this->getEntityData($entity);

        return $this->getEntityGateway()->update($primary, $data);
    }
}