<div class="card p-0 border-0" style="width: 18rem;">
    <a href="index.php?sec=detalle-producto&id=<?= $product->getId() ?>" class="unset d-block" style="text-decoration: none; color: inherit;">
        <img class="card-img-top rounded" alt="<?= $product->getName() ?>" src="<?= $product->getImage() ?>">
        <div class="card-body">
            <h3 class="card-title fw-bold h5 text-black mb-0"><?= $product->getName() ?></h3>
            <p class="card-text text-secondary"><?= $product->getBrand() ?></p>
            <p class="text-primary fs-6 text-black fw-bolder">US$ <?= $product->getPrice() ?></p>
        </div>
    </a>
</div>
