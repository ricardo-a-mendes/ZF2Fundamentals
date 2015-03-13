<?php

namespace Market\Factory;

use Market\Controller\ViewController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ViewControllerFactory implements FactoryInterface
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
        $viewController = new ViewController();

        //Injetando o adapeter de DB
        $viewController->setListingsTable($listingsTable);

        return $viewController;
    }

}
