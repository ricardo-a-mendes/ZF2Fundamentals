<?php

namespace Market\Factory;

use Market\Form\PostFilter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PostFilterFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $sm)
    {
        $categories = $sm->get('categories');

        //Instanciando e injetando informações dentro da PostFilter
        $filter = new PostFilter();
        $filter->setCategories($categories);
        $filter->buildFilter();

        return $filter;
    }

}
