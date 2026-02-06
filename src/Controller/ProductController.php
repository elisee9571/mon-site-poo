<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\EntityManager;
use App\Model\Product;
use App\Repository\ProductRepository;
use App\Service\UtilitiesService;

class ProductController extends Controller
{
    public function index(): void
    {
        $productRepository = new ProductRepository();
        $products = $productRepository->findAll();

        $this->render('product/index', [
            'title' => 'Produits',
            'products' => $products
        ]);
    }

    public function new(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = new Product();

            if (!empty($_FILES['picture']['tmp_name'])) {
                $ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
                $filename = uniqid('products_', true) . '.' . $ext;

                $destDir = dirname(__DIR__) . '/../public/uploads/products';
                if (!is_dir($destDir)) mkdir($destDir, 0775, true);

                move_uploaded_file($_FILES['picture']['tmp_name'], $destDir . '/' . $filename);

                $product->setPicture('/uploads/products/' . $filename);
            }

            $product->setTitle($_POST['title'])
                ->setSlug(UtilitiesService::slugify($_POST['title']))
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
            throw new \Exception('Product not found');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['picture']['tmp_name'])) {
                $ext = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
                $filename = uniqid('products_', true) . '.' . $ext;

                $destDir = dirname(__DIR__) . '/../public/uploads/products';
                if (!is_dir($destDir)) mkdir($destDir, 0775, true);

                move_uploaded_file($_FILES['picture']['tmp_name'], $destDir . '/' . $filename);

                $product->setPicture('/uploads/products/' . $filename);
            }

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

    public function show(string $slug, int $id): void
    {
        $productRepository = new ProductRepository();
        $product = $productRepository->findById($id) ?: $productRepository->findBySlug($slug);

        if (!$product) {
            throw new \Exception('Product not found');
        }

        if ($product->getSlug() !== $slug || $product->getId() !== $id) {
            $this->redirect("/product/{$product->getSlug()}/{$product->getId()}");
        }

        $this->render('product/show', [
            'title' => $product->getTitle(),
            'product' => $product
        ]);
    }

    public function delete(int $id): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_METHOD'] === 'DELETE') {
            $productRepository = new ProductRepository();
            $product = $productRepository->findById($id);

            if (!$product) {
                throw new \Exception('Product not found');
            }

            $entityManager = new EntityManager();
            $entityManager->delete($product);

            $this->redirect('/');
        }
    }
}
