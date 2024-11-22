<?php

$sneakers = (new Sneaker())->getSneakers();

?>

<section class="container">
    <div>
        <?= Alert::getAlerts(); ?>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
            Administrar zapatillas
        </h2>
        <a href="index.php?sec=create-sneaker" class="btn btn-success">Crear nueva zapatilla</a>
    </div>
    <table class="table table-borderless">
        <thead>
            <tr>
                <th>ID</th>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Marca</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($sneakers as $sneaker): ?>
                <tr>
                    <td><?= $sneaker->getId() ?></td>
                    <td><img src="../images/sneakers/<?= $sneaker->getImage() ?>" alt="<?=$sneaker->getName() ?>" width="70" height="50"></td>
                    <td><?= $sneaker->getName() ?></td>
                    <td><?= $sneaker->getDescription() ?></td>
                    <td>$<?= $sneaker->getPrice() ?></td>
                    <td><?= $sneaker->getBrand() ?></td>
                    <td><?= $sneaker->getCategory() ?></td>
                    <td class="col-1">
                        <a href="index.php?sec=edit-sneaker&id=<?= $sneaker->getId() ?>" class="btn btn-outline-success btn-sm m-1 w-100">Editar</a>
                        <a href="index.php?sec=delete-sneaker&id=<?= $sneaker->getId() ?>" class="btn btn-danger btn-sm m-1 w-100">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
