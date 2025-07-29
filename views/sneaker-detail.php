<?php

$id = $_GET['id'];

$sneaker = (new Sneaker())->getSneakerById($id);
$sizes = $sneaker->getSizes(); 

?>

<section class="container">
    <div class="row">
        <div class="col-12 col-md-6 p-4">
            <img src="./images/sneakers/<?= htmlspecialchars($sneaker->getImage()) ?>" class="img-fluid sticky-top pt-3" alt="<?= htmlspecialchars($sneaker->getName()) ?>">
        </div>
        <div class="col-12 col-md-6 p-3 p-md-4">
            <div>
                <h2 class="mt-3 mt-md-5 fw-bold h1"><?= htmlspecialchars($sneaker->getName()) ?></h2>
                <p class="text-secondary"><?= htmlspecialchars($sneaker->getBrand()) ?></p>
            </div>

            <p class="fs-4 fw-bolder"><?= $sneaker->getPriceWithUsdPrefix() ?></p>

            <form method="POST" action="actions/cart/add.php" class="mt-4">
                <input type="hidden" name="sneaker_id" value="<?= $sneaker->getId(); ?>">

                <div class="form-group mb-3">
                    <label class="mb-2" for="sizeSelect">Selecciona un talle</label>
                    <select class="form-control mb-3" id="sizeSelect" name="size_id" required>
                        <?php foreach ($sizes as $size): ?>
                            <option value="<?= $size->getId(); ?>">
                                <?= $size->getSize() . ' US - ' . ucfirst(strtolower($size->getGender())); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-group mb-3">
                        <label class="mb-2" for="quantitySelect">Cantidad</label>
                        <input 
                            type="number" 
                            id="quantitySelect" 
                            name="quantity" 
                            value="1" 
                            min="1" 
                            class="form-control" 
                            required>
                    </div>
                </div>

                <button type="submit" class="btn btn-success px-3 py-2">Agregar al carrito</button>
            </form>

            <div class="descripcion">
                <h3 class="mt-4 mt-md-5 h4">Descripción</h3>
                <p class="text-secondary"><?= nl2br(htmlspecialchars($sneaker->getDescription())) ?></p>
            </div>
        </div>
    </div>
</section>
