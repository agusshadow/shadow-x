<section class="container">
    <h2 class="pt-4 pt-md-5 text-success fw-bold text-center">Zapatillas</h2>
    <div class="row row-cols-4 gap-3 py-4 py-md-5 justify-content-center">
<?php  

    require_once __DIR__ . '/../clases/Producto.php';

    $products = (new Product())->fetchProducts();

    foreach ($products as $product) {
        require __DIR__ . '/../vistas/producto.php';
    }

    ?>

</div>
    </div>
</section>






