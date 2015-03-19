<?php

namespace Market\Model;

use Zend\Db\TableGateway\TableGateway;

class ListingsTable extends TableGateway
{

    public static $tableName = 'listings';

    public function __construct($table, \Zend\Db\Adapter\AdapterInterface $adapter, $features = null, \Zend\Db\ResultSet\ResultSetInterface $resultSetPrototype = null, \Zend\Db\Sql\Sql $sql = null)
    {
        parent::__construct($table, $adapter, $features, $resultSetPrototype, $sql);
    }

    public function getListingsByCategory($category)
    {
        return $this->select(array(
                    'category' => $category));
    }

    public function getListingsById($itemId)
    {
        return $this->select(array(
                    'listings_id' => $itemId))->current();
    }

    public function getLeatestListings()
    {
        $select = new \Zend\Db\Sql\Select();
        $select->from(self::$tableName)
                ->order('listings_id DESC')
                ->limit(1);

        return $this->selectWith($select)->current();
    }

    public function addPosting($data)
    {
        /*
        list($city, $country) = explode(',', $data['cityCode']);
        $data['city'] = trim($city);
        $data['country'] = trim($country);

        $date = new \DateTime();

        if ($data['expires'])
        {
            if ($data['expires'] == 30)
            {
                $date->add(new \DateInterval("P1M"));
            }
            else
            {
                $date->add(new \DateInterval("P{$data['expires']}D"));
            }
        }

        $data['date_expires'] = $date->format('Y-m-d H:i:s');
        unset($data['cityCode'], $data['expires'], $data['captcha'], $data['submit']);
        */
        unset($data['submit']);
        $this->insert($data);
    }

}
