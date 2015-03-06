<?php

namespace Market\Factory;

use Market\Form\PostForm;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $categories = $sm->get('categories');

        //Instanciando e injetando informações dentro da FormController
        $form = new PostForm();
        $form->setCategories($categories);
        $form->setInputFilter($sm->get('market-post-filter'));
        $form->buildForm();

        return $form;
    }

}
