<?php

namespace SMS\Models;

use SMS\Db\Database;
use SMS\Models\Model;

class Product extends Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getAll()
    {
        return $this->db->fetch(
            'SELECT * FROM product'
        );
    }

    public function add($product, $stock, $price)
    {
        $sql = 'INSERT INTO 
                    product(product, stock, price) 
                VALUES(:product, :stock, :price)';
        $params = [':product' => $product, ':stock' => $stock, ':price' => $price];
        
        return $this->db->insert($sql, $params);
    }

}