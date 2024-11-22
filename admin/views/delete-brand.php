<?php

$brandId = $_GET['id'] ?? null;
$brand = (new Brand())->getById($brandId);

if (!$brand) {
    die("Marca no encontrada.");
}

?>

<section class="container">
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
        Eliminar Marca
    </h2>
    <h3>¿Está seguro que desea eliminar la marca <span class="fw-bold"><?= $brand->getName() ?></span>?</h3>
    <div class="mt-3">
        <a href="actions/brand/delete.php?id=<?= $brand->getId() ?>" role="button" class="btn btn-danger">Eliminar</a>
        <a href="index.php?sec=admin-brands" class="btn btn-secondary">Cancelar</a>
    </div>
</section>
