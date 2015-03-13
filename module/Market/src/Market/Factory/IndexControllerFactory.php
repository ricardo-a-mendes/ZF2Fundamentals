<?php

namespace Market\Factory;

use Market\Controller\IndexController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class IndexControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        //Recuperando todos os servicos
        /* @var $allServices \Zend\Di\ServiceLocator */
        $allServices = $serviceLocator->getServiceLocator();

        /* @var $sm \Zend\ServiceManager\ServiceManager */
        $sm = $allServices->get('ServiceManager');

        //Recuperando o servico de adapter do DB
        $listingsTable = $sm->get('listings-table');

        //Instanciando e injetando informações dentro da PostController
        $indexController = new IndexController();

        //Injetando o adapeter de DB
        $indexController->setListingsTable($listingsTable);

        return $indexController;
    }

}
