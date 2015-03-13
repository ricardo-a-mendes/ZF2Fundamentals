<?php

namespace Market\Model;

use Zend\Db\TableGateway\TableGateway;

class ListingsTable extends TableGateway
{
    public static $tableName = 'listings';

    public function __construct($table, \Zend\Db\Adapter\AdapterInterface $adapter, $features = null, \Zend\Db\ResultSet\ResultSetInterface $resultSetPrototype = null, \Zend\Db\Sql\Sql $sql = null)
    {
        parent::__construct($table, $adapter, $features, $resultSetPrototype, $sql);
    }

    public function getListingsByCategory($category)
    {
        return $this->select(array('category' => $category));
    }

    public function getListingsById($itemId)
    {
        return $this->select(array('listings_id' => $itemId))->current();
    }
}