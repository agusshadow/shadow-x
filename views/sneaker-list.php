<?php

$search = isset($_GET['search']) ? $_GET['search'] : '';
$brandId = isset($_GET['brandId']) ? $_GET['brandId'] : '';
$categoryId = isset($_GET['categoryId']) ? $_GET['categoryId'] : '';

$filters = [
    'search' => $search,
    'brandId' => $brandId,
    'categoryId' => $categoryId
];

$brands = (new Brand())->getAll();
$categories = (new Category())->getAll();
$sneakers = (new Sneaker())->getSneakersByFilter($filters);

?>

<section class="container">
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
        Zapatillas
    </h2>
    <div class="my-3">
        <a class="text-success text-decoration-none" href="index.php?sec=sneakers-by-brand">Ver zapatillas por marca</a> |
        <a class="text-success text-decoration-none" href="index.php?sec=sneakers-by-category">Ver zapatillas por categoria</a>
    </div>
    <form class="d-flex flex-wrap gap-2 mb-4" method="GET">
        <input type="hidden" name="sec" value="sneaker-list">
        <input type="hidden" name="brandId" value="<?= $brandId ?>">
        <div class="d-flex">
            <input class="form-control" type="search" placeholder="Buscar" aria-label="Search" name="search" id="search" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
        </div>
        <div>
            <label for="brandSelect" class="form-label visually-hidden">Marca</label>
            <select class="form-select" name="brandId" id="brandSelect">
                <option value="" disabled <?= empty($_GET['brandId']) ? 'selected' : ''; ?>>Marca</option>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?= $brand->getId() ?>" 
                        <?= isset($_GET['brandId']) && $_GET['brandId'] == $brand->getId() ? 'selected' : ''; ?>>
                        <?= $brand->getName() ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="categorySelect" class="form-label visually-hidden">Categoría</label>
            <select class="form-select" name="categoryId" id="categorySelect">
                <option value="" disabled <?= empty($_GET['categoryId']) ? 'selected' : ''; ?>>Categoría</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category->getId() ?>" 
                        <?= isset($_GET['categoryId']) && $_GET['categoryId'] == $category->getId() ? 'selected' : ''; ?>>
                        <?= $category->getName() ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="my-auto">
            <button class="btn btn-success" type="submit">Buscar</button>
            <?php if ($search ||  $categoryId || $brandId): ?>
                <a href="index.php?sec=sneaker-list" class="btn btn-danger">Limpiar filtros</a>
            <?php endif; ?>
        </div>
    </form>
    <div class="row row-cols-4 gap-3 py-4 py-md-5">
        <?php if (empty($sneakers)): ?>
            <div class="w-100">
                <p class="text-center">No se encontraron resultados para tu búsqueda.</p>
            </div>
        <?php else: ?>
            <?php 
                foreach ($sneakers as $sneaker) {
                    require __DIR__ . '/../views/sneaker.php';
                }
            ?>
        <?php endif; ?>
    </div>
</section>
