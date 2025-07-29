<?php

$categoryId = $_GET['id'] ?? null;
$category = Category::getById($categoryId);

?>

<section class="container">
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">Editar Categoria</h2>
    <form method="POST" action="actions/category/edit.php?id=<?= $category->getId() ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $category->getName() ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?= ($category->getDescription()); ?></textarea>
        </div>
        <div class="mb-3">
            <small class="d-block">Fecha de creacion: <?= $category->getCreatedAt()?></small>
        </div>
        <button type="submit" class="btn btn-success">Actualizar categoria</button>
    </form>
</section>
