<?php

namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    public $categories;

    function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function indexAction()
    {
        /*
        //Desta forma estamos utilizando DI, nao e uma boa pratica
        $categories = $this->getServiceLocator()->get('categories');
        return new ViewModel(array('categories' => $categories));
        */

        //Desta forma utilizamos uma Factory, sem DI
        return new ViewModel(array('categories' => $this->categories));
    }
}
