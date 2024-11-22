<?php

$brandId = $_GET['id'] ?? null;
$brand = Brand::getById($brandId);

?>

<section class="container">
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">Editar Marca</h2>
    <form method="POST" action="actions/brand/edit.php?id=<?= $brand->getId() ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $brand->getName() ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?= $brand->getDescription() ?></textarea>
        </div>
        <div class="mb-3">
            <small class="d-block">Fecha de creacion: <?= $brand->getCreatedAt()?></small>
        </div>
        <button type="submit" class="btn btn-success">Actualizar marca</button>
    </form>
</section>
