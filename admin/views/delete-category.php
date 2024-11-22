<?php

$categoryId = $_GET['id'] ?? null;
$category = (new Category())->getById($categoryId);

?>

<section class="container">
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
        Eliminar Categoria
    </h2>
    <h3>¿Está seguro que desea eliminar la categoria <span class="fw-bold"><?= $category->getName() ?></span>?</h3>
    <div class="mt-3">
        <a href="actions/category/delete.php?id=<?= $category->getId() ?>" role="button" class="btn btn-danger">Eliminar</a>
        <a href="index.php?sec=admin-brands" class="btn btn-secondary">Cancelar</a>
    </div>
</section>
