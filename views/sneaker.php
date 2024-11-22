<div class="card p-0 border-0" style="width: 18rem;">
    <a href="index.php?sec=sneaker-detail&id=<?= $sneaker->getId() ?>" class="unset d-block" style="text-decoration: none; color: inherit;">
        <img class="card-img-top rounded p-3" alt="<?= $sneaker->getName() ?>" src="./images/sneakers/<?= $sneaker->getImage() ?>">
        <div class="card-body">
            <h3 class="card-title fw-bold h5 text-black mb-0"><?= $sneaker->getName() ?></h3>
            <p class="card-text text-secondary"><?= $sneaker->getBrand() ?> | <?= $sneaker->getCategory() ?></p>
            <p class="text-primary fs-6 text-black fw-bolder"><?= $sneaker->getPriceWithUsdPrefix() ?></p>
        </div>
    </a>
</div>
