<?php 

require_once __DIR__ . '/../clases/Producto.php';

$id = $_GET['id'];

$juego = (new Producto())->traerPorId($id);

?>

<section class="container py-4">

    <div class="row">
        <div class="col-12 col-md-6 p-4">
        <img src="imagenes/portadas-juegos/<?= $juego->getImagen() ?>" class="img-fluid sticky-top pt-3" alt="<?= $juego->getAlt() ?>">
        </div>
        <div class="col-12 col-md-6 p-3 p-md-4">
            <h2 class="mt-3 mt-md-5 fw-bold h1"><?= $juego->getNombre() ?></h2>
            <p class="text-secondary">Plataforma: <?= $juego->getPlataforma() ?></p>
            <p class="text-primary fs-5">$ <?= $juego->getPrecio() ?></p>
            <div class="d-flex">
                <a href="#" class="btn btn-primary me-2 px-3 py-2">Comprar ahora</a>
                <a href="#" class="btn btn-primary px-3 py-2">Agregar al carrito</a>
            </div>
            <div class="descripcion">
                <h3 class="mt-4 mt-md-5 h4">Descripcion</h3>
                <p class="text-secondary"><?= $juego->getDescripcion() ?></p>
            </div>
            
        </div>
    </div>

    <div class="ratio ratio-16x9 pb-5 mb-4">
        <iframe class="mt-5 pb-4"  src="<?= $juego->getUrl() ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>

</section>