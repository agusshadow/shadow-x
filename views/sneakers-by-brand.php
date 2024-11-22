<?php

$brands = (new Brand())->getAll();

?>

<section class="container">
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
        Zapatillas por marca
    </h2>
    <div class="row">
        <?php foreach ($brands as $brand): ?>
            <div class="col-12 mb-4">
                <h3 class="text-success"><?php echo($brand->getName()); ?></h3>
                <?php
                    $sneakers = (new Sneaker())->getSneakersByBrand($brand->getId());
                    if (!empty($sneakers)):
                ?>
                    <div class="row">
                        <?php foreach ($sneakers as $sneaker): ?>
                            <div class="col-md-4 mb-4">
                                <?php
                                    require __DIR__ . '/../views/sneaker.php';
                                ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p>No hay sneakers disponibles para esta marca.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</section>
