<?php

$sneakerId = $_GET['id'] ?? null;
$sneaker = (new Sneaker())->getSneakerById($sneakerId);

?>

<section class="container">
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
        Eliminar Zapatilla
    </h2>
    <h3>Esta seguro que desea eliminar <span class="fw-bold"><?= $sneaker->getName()?></span>?</h3>
  <div class="mt-3">
      <a href="actions/sneaker/delete.php?id=<?= $sneaker->getId() ?>" role="button" class="btn btn-danger">Eliminar</a>
      <a href="index.php?sec=admin-sneakers" class="btn btn-secondary">Cancelar</a>
  </div>
</section>
