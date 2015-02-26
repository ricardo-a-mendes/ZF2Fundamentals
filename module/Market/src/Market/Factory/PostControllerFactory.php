<?php

namespace Market\Factory;

use Market\Controller\PostController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        //Recuperando todos os servicos
        $allServices = $serviceLocator->getServiceLocator();
        $sm = $allServices->get('ServiceManager');

        //Recuperando o servico do modulo 'Aplication' (outro escopo)
        $categories = $sm->get('categories');

        //Instanciando e injetando informações dentro da PostController
        $postController = new PostController();
        $postController->setCategories($categories);

        return $postController;
    }

}
