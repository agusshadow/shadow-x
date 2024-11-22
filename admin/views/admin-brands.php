<?php

$brands = (new Brand())->getAll();

?>

<section class="container">
    <div>
        <?= Alert::getAlerts(); ?>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
            Administrar marcas
        </h2>
        <a href="index.php?sec=create-brand" class="btn btn-success">Crear nueva marca</a>
    </div>
    <table class="table table-borderless">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($brands as $brand): ?>
                <tr>
                    <td><?= $brand->getId() ?></td>
                    <td><?= $brand->getName() ?></td>
                    <td><?= $brand->getDescription() ?></td>
                    <td class="col-1">
                        <a href="index.php?sec=edit-brand&id=<?= $brand->getId() ?>" class="btn btn-outline-success btn-sm m-1 w-100">Editar</a>
                        <a href="index.php?sec=delete-brand&id=<?= $brand->getId() ?>" class="btn btn-danger btn-sm m-1 w-100">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
