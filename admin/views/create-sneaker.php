<?php

$brands = (new Brand())->getAll();
$categories = (new Category())->getAll();
$sizes = (new Size())->getAll();

?>

<section class="container">
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
        Crear Zapatilla
    </h2>
    <form method="POST" action="actions/sneaker/create.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <div class="mb-3">
            <label for="brand" class="form-label">Marca</label>
            <select class="form-select" id="brand" name="brand_id" required>
                <option value="" disabled selected>Seleccionar Marca</option>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?= $brand->getId() ?>"><?= $brand->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Categoría</label>
            <select class="form-select" id="category" name="category_id" required>
                <option value="" disabled selected>Seleccionar Categoría</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->getId() ?>"><?= $category->getName() ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="sizes" class="form-label">Seleccionar Talles</label>
            <div id="sizes" class="form-group row">
                
                <div class="col-md-6">
                    <span>Hombre</span>
                    <?php foreach ($sizes as $size): ?>
                        <?php if ($size->getGender() == 'Men'): ?>
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-2" id="size<?= $size->getId() ?>" name="sizes[<?= $size->getId() ?>]" value="<?= $size->getId() ?>">
                                <label class="form-check-label w-25" for="size<?= $size->getId() ?>"><?= $size->getSize() ?></label>
                                <input type="number" class="form-control w-25" name="stock_<?= $size->getId() ?>" placeholder="Stock" min="0">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="col-md-6">
                    <span>Mujer</span>
                    <?php foreach ($sizes as $size): ?>
                        <?php if ($size->getGender() == 'Women'): ?>
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-2" id="size<?= $size->getId() ?>" name="sizes[<?= $size->getId() ?>]" value="<?= $size->getId() ?>">
                                <label class="form-check-label w-25" for="size<?= $size->getId() ?>"><?= $size->getSize() ?></label>
                                <input type="number" class="form-control w-25" name="stock_<?= $size->getId() ?>" placeholder="Stock" min="0">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                
            </div>
        </div>
        <button type="submit" class="btn btn-success">Crear zapatilla</button>
    </form>
</section>
