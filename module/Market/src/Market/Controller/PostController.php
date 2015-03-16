<?php

namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PostController extends AbstractActionController
{
    use ListingsTableTrait;

    public $categories;
    private $postForm;

    function setCategories($categories)
    {
        $this->categories = $categories;
    }

    public function setPostForm(\Market\Form\PostForm $postForm)
    {
        $this->postForm = $postForm;
    }

    public function indexAction()
    {
        /*
        //Desta forma estamos utilizando DI, nao e uma boa pratica
        $categories = $this->getServiceLocator()->get('categories');
        return new ViewModel(array('categories' => $categories));
        */

        //Desta forma utilizamos uma Factory, sem DI
        //return new ViewModel(array('categories' => $this->categories));

        $data = $this->params()->fromPost();
        $vm = new ViewModel(array('postForm' => $this->postForm, 'data' => $data));
        $vm->setTemplate('market/post/index.phtml');

        if ($this->getRequest()->isPost())
        {
            $this->postForm->setData($data);

            if ($this->postForm->isValid())
            {
                $this->listingsTable->addPosting($this->postForm->getData());
                $this->flashMessenger()->addMessage('Post recebido com sucesso!');
                $this->redirect()->toRoute('home');
            }
            else
            {
                $invalidView = new ViewModel();
                $invalidView->setTemplate('market/post/invalid.phtml');
                $invalidView->addChild($vm, 'main');

                return $invalidView;
            }
        }

        return $vm;
    }

}
