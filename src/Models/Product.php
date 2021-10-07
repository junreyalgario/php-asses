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
        return $this->db->query(
            'SELECT * FROM product'
        );
    }

}