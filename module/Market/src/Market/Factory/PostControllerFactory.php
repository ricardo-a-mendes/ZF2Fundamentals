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
        /* @var $allServices \Zend\Di\ServiceLocator */
        $allServices = $serviceLocator->getServiceLocator();

        /* @var $sm \Zend\ServiceManager\ServiceManager */
        $sm = $allServices->get('ServiceManager');

        //Recuperando o servico do modulo 'Aplication' (outro escopo)
        $categories = $sm->get('categories');

        //Instanciando e injetando informações dentro da PostController
        $postController = new PostController();

        //Injetando as categorias no controller
        $postController->setCategories($categories);

        //Injetando o Formulario no controller
        $postController->setPostForm($sm->get('market-post-form'));

        return $postController;
    }

}
