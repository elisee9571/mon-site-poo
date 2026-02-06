<h1><?= $title ?></h1>

<div class="d-flex gap-3">
    <?php foreach ($products as $product): ?>
        <div class="card" style="width: 18rem;">
            <img src="<?= $product->getPicture() ?: '' ?>" class="card-img-top" alt="..." height="200" loading="lazy" style="object-fit: cover">
            <div class="card-body">
                <h5 class="card-title"><?= $product->getTitle() ?></h5>
                <p class="card-text"><?= $product->getprice() ?> €</p>
                <p class="card-text"><?= $product->getDescription() ?></p>
                <a href="/product/<?= $product->getSlug() ?>/<?= $product->getId() ?>" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>
