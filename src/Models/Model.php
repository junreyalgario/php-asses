<?php

namespace SMS\Models;

use SMS\Db\Database;

abstract class Model {

    protected $db;

    protected function __construct()
    {
        $this->db = new Database(
            CONFIG['mysql']['host'],
            CONFIG['mysql']['username'],
            CONFIG['mysql']['password'],
            CONFIG['mysql']['port'],
            CONFIG['mysql']['db_name']
        );

        $this->db->connect();
    }

    public function __destruct()
    {
        // $this->db->close();
    }
}