<?php
$categories = (new Category())->getAll();
?>

<section class="container">
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
            Administrar categorias
        </h2>
        <a href="index.php?sec=create-category" class="btn btn-success">Crear nueva categoria</a>
    </div>
    <table class="table table-borderless">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha de Creación</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= $category->getId() ?></td>
                    <td><?= $category->getName() ?></td>
                    <td><?= $category->getDescription() ?></td>
                    <td><?= $category->getCreatedAt() ?></td>
                    <td class="col-1">
                        <a href="index.php?sec=edit-category&id=<?= $category->getId() ?>" class="btn btn-outline-success btn-sm m-1 w-100">Editar</a>
                        <a href="index.php?sec=delete-category&id=<?= $category->getId() ?>" class="btn btn-danger btn-sm m-1 w-100">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>