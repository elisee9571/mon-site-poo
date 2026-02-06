<h1><?= $title ?></h1>

<?php if ($product->getPicture()): ?>
    <img src="<?= $product->getPicture() ?>" alt="" width="500" loading="lazy">
<?php endif; ?>

<div>
    <p>Voici mon prix : <?= $product->getPrice() ?></p>
    <p>Voici ma description : <?= $product->getDescription() ?></p>
</div>


