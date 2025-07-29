<?php
$sizes = Size::getAll();
?>

<section class="container">
    <div>
        <?= Alert::getAlerts(); ?>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
            Administrar talles
        </h2>
        <a href="index.php?sec=create-size" class="btn btn-success">Crear nuevo talle</a>
    </div>
    <table class="table table-borderless">
        <thead>
            <tr>
                <th>ID</th>
                <th>Talle</th>
                <th>Género</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sizes as $size): ?>
                <tr>
                    <td><?= $size->getId() ?></td>
                    <td><?= $size->getSize() ?></td>
                    <td><?= $size->getGender() ?></td>
                    <td class="col-1">
                        <a href="index.php?sec=delete-size&id=<?= $size->getId() ?>" class="btn btn-danger btn-sm m-1 w-100">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
