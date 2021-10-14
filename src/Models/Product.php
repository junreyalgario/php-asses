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

    public function find($col, $val)
    {
        $sql = "SELECT * FROM product
                WHERE $col = $val";

        return $this->db->fetch($sql);
    }

    public function add($product, $stock, $price)
    {
        $sql = 'INSERT INTO 
                    product(product, stock, price) 
                VALUES(:product, :stock, :price)';
        $params = [':product' => $product, ':stock' => $stock, ':price' => $price];

        return $this->db->insert($sql, $params);
    }

    public function update($product)
    {
        $sql = 'UPDATE product 
                SET product = :product, stock = :stock, price = :price
                WHERE id = :id';
        
        return $this->db->query($sql, $product);
    }

    public function clear()
    {
        $sql = 'DELETE FROM product';
        return $this->db->query($sql, null);
    }

}