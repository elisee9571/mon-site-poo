<?php

namespace App\Repository;

use App\Core\Database;
use App\Model\Product;

class ProductRepository
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function findById(int $id): Product
    {
        $query = $this->db->prepare("SELECT * FROM product WHERE id = :id");
        $query->setFetchMode(\PDO::FETCH_CLASS, Product::class);
        $query->execute(['id' => $id]);

        return $query->fetch();
    }
}
