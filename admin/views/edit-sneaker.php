<?php

$sneakerId = $_GET['id'] ?? null;
$sneaker = (new Sneaker())->getSneakerById($sneakerId);

$brands = (new Brand())->getAll();
$categories = (new Category())->getAll();
$sizes = (new Size())->getAll();

$sizesWithStock = $sneaker->getSizesWithStock($sneakerId);

$sizesAssoc = [];
foreach ($sizesWithStock as $sizeWithStock) {
    $sizesAssoc[$sizeWithStock['size_id']] = $sizeWithStock['stock'];
}

$brandId = $sneaker->getBrandId();
$categoryId = $sneaker->getCategoryId();

?>

<section class="container">
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">Editar Zapatilla</h2>
    <form method="POST" action="actions/sneaker/edit.php?id=<?= $sneaker->getId() ?>" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $sneaker->getId() ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $sneaker->getName() ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descripción</label>
            <textarea class="form-control" id="description" name="description" rows="4" required><?= $sneaker->getDescription() ?></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Precio</label>
            <input type="number" class="form-control" id="price" name="price" value="<?= $sneaker->getPrice() ?>" required step="0.01">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="../images/sneakers/<?= $sneaker->getImage() ?>" alt="Imagen actual" class="img-thumbnail mt-3" width="100">
            <p class="mt-2">Nombre actual: <?= $sneaker->getImage() ?></p>
        </div>
        <div class="mb-3">
            <label for="brand_id" class="form-label">Marca</label>
            <select class="form-select" name="brand_id" id="brand_id" required>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?= $brand->getId() ?>" <?= $brand->getId() == $brandId ? 'selected' : ''; ?>>
                        <?= $brand->getName() ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Categoría</label>
            <select class="form-select" name="category_id" id="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->getId() ?>" <?= $category->getId() == $categoryId ? 'selected' : ''; ?>>
                        <?= $category->getName() ?>
                    </option>
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
                                <input type="checkbox" class="form-check-input me-2" id="size<?= $size->getId() ?>" name="sizes[<?= $size->getId() ?>]" value="<?= $size->getId() ?>"
                                    <?= isset($sizesAssoc[$size->getId()]) ? 'checked' : ''; ?>>
                                <label class="form-check-label w-25" for="size<?= $size->getId() ?>"><?= $size->getSize() ?></label>
                                <input type="number" class="form-control w-25" name="stock_<?= $size->getId() ?>" placeholder="Stock" value="<?= $sizesAssoc[$size->getId()] ?? 0 ?>" min="0">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-6">
                    <span>Mujer</span>
                    <?php foreach ($sizes as $size): ?>
                        <?php if ($size->getGender() == 'Women'): ?>
                            <div class="form-check d-flex align-items-center">
                                <input type="checkbox" class="form-check-input me-2" id="size<?= $size->getId() ?>" name="sizes[<?= $size->getId() ?>]" value="<?= $size->getId() ?>"
                                    <?= isset($sizesAssoc[$size->getId()]) ? 'checked' : ''; ?>>
                                <label class="form-check-label w-25" for="size<?= $size->getId() ?>"><?= $size->getSize() ?></label>
                                <input type="number" class="form-control w-25" name="stock_<?= $size->getId() ?>" placeholder="Stock" value="<?= $sizesAssoc[$size->getId()] ?? 0 ?>" min="0">
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>  
            </div>
        </div>
        <div class="mb-3">
            <small class="d-block">Fecha de creacion: <?= $sneaker->getCreatedAt()?></small>
        </div>
        <button type="submit" class="btn btn-success">Guardar cambios</button>
        <a href="index.php?sec=admin-sneakers" class="btn btn-secondary">Cancelar</a>
    </form>
</section>
