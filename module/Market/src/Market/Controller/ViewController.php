<?php

namespace Market\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * @property \Market\Model\ListingsTable $listingsTable Listings Table
 */
class ViewController extends AbstractActionController
{

    use ListingsTableTrait;

    public function indexAction()
    {
        $category = $this->params()->fromRoute('category');

        $listings = $this->listingsTable->getListingsByCategory($category);

        return new ViewModel(array('category' => $category, 'listings' => $listings));
    }

    public function itemAction()
    {
        $itemId = $this->params()->fromRoute('itemId');

        if (empty($itemId))
        {
            $this->flashMessenger()->addMessage('Item não encontrado');
            return $this->redirect()->toRoute('market');
        }

        $item = $this->listingsTable->getListingsById((int)$itemId);

        return new ViewModel(array('item' => $item));
    }
}
