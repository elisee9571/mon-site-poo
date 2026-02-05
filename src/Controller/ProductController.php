<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\EntityManager;
use App\Model\Product;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;

class ProductController extends Controller
{
    public function new(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = new Product();

            $product->setTitle($_POST['title'])
                ->setDescription($_POST['description'])
                ->setPrice($_POST['price']);

            $entityManager = new EntityManager();
            $entityManager->persist($product);
            $entityManager->flush();

            $this->redirect('/product/new');
        }

        $this->render('product/new', [
            'title' => 'Créer un produit',
        ]);
    }

    public function edit(int $id): void
    {
        $productRepository = new ProductRepository();
        $product = $productRepository->findById($id);

        if (!$product) {
            throw new \Exception('User not found');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product->setTitle($_POST['title'])
                ->setDescription($_POST['description'])
                ->setPrice($_POST['price']);

            $entityManager = new EntityManager();
            $entityManager->persist($product);
            $entityManager->flush();

            $this->redirect("/product/$id/edit");
        }

        $this->render('product/edit', [
            'title' => 'Modifier un produit',
            'product' => $product
        ]);
    }
}
