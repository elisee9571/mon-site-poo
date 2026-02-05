<?php

namespace App\Repository;

use App\Core\Database;

class ContactRepository
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }
}
