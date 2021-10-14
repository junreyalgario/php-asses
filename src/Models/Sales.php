<?php

namespace SMS\Models;

use SMS\Db\Database;
use SMS\Models\Model;

class Sales extends Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function add($productId, $qntty, $amount)
    {
        $sql = 'INSERT INTO 
                    sale(product_id, quantity, amount) 
                VALUES(:product_id, :quantity, :amount)';
        $params = [':product_id' => $productId, ':quantity' => $qntty, ':amount' => $amount];

        return $this->db->insert($sql, $params);
    }

    public function getAll()
    {
        return $this->db->fetch(
            'SELECT * FROM sale
                INNER JOIN product ON sale.product_id = product.id'
        );
    }

    public function getTotalSale()
    {
        return $this->db->fetch(
            'SELECT SUM(amount) as sales FROM sale'
        )[0]->sales;
    }

    public function clear()
    {
        $sql = 'DELETE FROM sale';
        return $this->db->query($sql, null);
    }
}