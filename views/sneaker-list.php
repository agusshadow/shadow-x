<?php

require_once __DIR__ . '/../classes/Sneaker.php';

$brand = isset($_GET['brand']) ? $_GET['brand'] : '';

$sneakers = isset($_GET['brand']) ? (new Sneaker())->getSneakerByBrand($brand) : (new Sneaker())->getSneakers();
?>

<section class="container">
    <h2 class="pt-4 pt-md-5 text-success fw-bold text-center">Zapatillas <?= $brand ?></h2>
    <div class="row row-cols-4 gap-3 py-4 py-md-5 justify-content-center">
    <?php  

        foreach ($sneakers as $sneaker) {
            require __DIR__ . '/../views/sneaker.php';
        }

    ?>
    </div>
</section>






