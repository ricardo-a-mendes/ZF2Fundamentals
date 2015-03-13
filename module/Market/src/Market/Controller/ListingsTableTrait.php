<?php

namespace Market\Controller;

use Market\Model\ListingsTable;

trait ListingsTableTrait
{
    public $listingsTable;

    function setListingsTable(ListingsTable $listingsTable)
    {
        $this->listingsTable = $listingsTable;
    }


}
