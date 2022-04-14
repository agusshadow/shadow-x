<section class="container">
    <div class="row row-cols-4 gap-3">
          

    <?php  

    require_once __DIR__ . '/../clases/Producto.php';

    $juegos = (new Producto())->traerJuegos();
    echo '<pre>';
    print_r($juegos);
    echo '</pre>';

    foreach ($juegos as $juego) {
    require __DIR__ . '/../vistas/producto.php';
    }

    ?>


    </div>
</section>









