<?php

$sizeId = $_GET['id'] ?? null;
$size = Size::getById($sizeId);

?>

<section class="container">
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
        Eliminar Talle
    </h2>

    <?php if ($size): ?>
        <h3>¿Está seguro que desea eliminar el talle <span class="fw-bold"><?= $size->getSize() ?></span> (<?= $size->getGender() ?>)?</h3>
        <div class="mt-3">
            <a href="actions/size/delete.php?id=<?= $size->getId() ?>" role="button" class="btn btn-danger">Eliminar</a>
            <a href="index.php?sec=admin-sizes" class="btn btn-secondary">Cancelar</a>
        </div>
    <?php else: ?>
        <div class="alert alert-danger">El talle solicitado no existe.</div>
        <a href="index.php?sec=admin-sizes" class="btn btn-secondary">Volver</a>
    <?php endif; ?>
</section>
