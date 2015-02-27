<?php

namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ViewController extends AbstractActionController
{
    public function indexAction()
    {
        $category = $this->params()->fromRoute('category');
        return new ViewModel(array('category' => $category));
    }

    public function itemAction()
    {
        $itemId = $this->params()->fromRoute('itemId');

        if (empty($itemId))
        {
            $this->flashMessenger()->addMessage('Item não encontrado');
            return $this->redirect()->toRoute('market');
        }

        return new ViewModel(array('itemId' => $itemId));
    }
}
