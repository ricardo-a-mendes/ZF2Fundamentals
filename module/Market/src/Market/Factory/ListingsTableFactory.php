<?php

namespace Market\Factory;

use Market\Model\ListingsTable;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ListingsTableFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('general-adapter');

        return new ListingsTable(ListingsTable::$tableName, $adapter);
    }

}
