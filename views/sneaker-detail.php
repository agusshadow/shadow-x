<?php

$id = $_GET['id'];

$sneaker = (new Sneaker())->getSneakerById($id);
$sizes = $sneaker->getSizes(); 

?>

<section class="container">
    <div class="row">
        <div class="col-12 col-md-6 p-4">
            <img src="./images/sneakers/<?= $sneaker->getImage() ?>" class="img-fluid sticky-top pt-3" alt="<?= $sneaker->getName() ?>">
        </div>
        <div class="col-12 col-md-6 p-3 p-md-4">
            <div>
                <h2 class="mt-3 mt-md-5 fw-bold h1"><?= $sneaker->getName() ?></h2>
                <p class="text-secondary"><?= $sneaker->getBrand() ?></p>
            </div>
            <p class="fs-4 fw-bolder"><?= $sneaker->getPriceWithUsdPrefix() ?></p>
            <div class="form-group mt-5">
                <label class="mb-2" for="sizeSelect">Selecciona un talle</label>
                <select class="form-control" id="sizeSelect">
                    <?php foreach ($sizes as $size): ?>
                        <option value="<?= $size->getId(); ?>">
                            <?= $size->getSize() . ' US - ' . ucfirst(strtolower($size->getGender())); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <a href="#" class="btn btn-success my-4 px-3 py-2">Agregar al carrito</a>
            <div class="descripcion">
                <h3 class="mt-4 mt-md-5 h4">Descripción</h3>
                <p class="text-secondary"><?= $sneaker->getDescription() ?></p>
            </div>
        </div>
    </div>
</section>
