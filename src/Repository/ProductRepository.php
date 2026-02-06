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

    public function findAll(): array
    {
        $query = $this->db->prepare("SELECT * FROM product ORDER BY created_at DESC");
        $query->setFetchMode(\PDO::FETCH_CLASS, Product::class);
        $query->execute();

        return $query->fetchAll() ?: [];
    }

    public function findById(int $id): ?Product
    {
        $query = $this->db->prepare("SELECT * FROM product WHERE id = :id");
        $query->setFetchMode(\PDO::FETCH_CLASS, Product::class);
        $query->execute(['id' => $id]);

        return $query->fetch() ?: null;
    }

    public function findBySlug(string $slug): ?Product
    {
        $query = $this->db->prepare("SELECT * FROM product WHERE slug = :slug");
        $query->setFetchMode(\PDO::FETCH_CLASS, Product::class);
        $query->execute(['slug' => $slug]);

        return $query->fetch() ?: null;
    }
}
