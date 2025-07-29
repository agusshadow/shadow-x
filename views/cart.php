<?php
$cart = new Cart();
$items = $cart->getItems();
?>

<section class="container">
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
        Carrito
    </h2>

    <?php if (empty($items)): ?>
        <p>No hay productos en el carrito.</p>
        <a href="index.php?sec=sneaker-list" class="btn btn-success mt-3">Explorar productos</a>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($items as $key => $item): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <a href="index.php?sec=sneaker-detail&id=<?= urlencode($item['id']) ?>">
                            <img src="./images/sneakers/<?= htmlspecialchars($item['image']) ?>" width="60" class="me-3" alt="<?= htmlspecialchars($item['name']) ?>">
                        </a>
                        <div>
                            <a href="index.php?sec=sneaker-detail&id=<?= urlencode($item['id']) ?>" class="text-decoration-none text-dark fw-bold">
                                <?= htmlspecialchars($item['name']) ?>
                            </a><br>
                            <small><?= htmlspecialchars($item['size']['label']) ?></small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="me-3">US$ <?= number_format($item['price'], 2) ?></span>

                        <form method="POST" action="actions/cart/update.php" class="d-inline">
                            <input type="hidden" name="key" value="<?= htmlspecialchars($key) ?>">
                            <button type="submit" name="action" value="decrease" class="btn btn-sm btn-outline-secondary">-</button>
                        </form>

                        <span class="mx-2"><?= (int)$item['quantity'] ?></span>

                        <form method="POST" action="actions/cart/update.php" class="d-inline">
                            <input type="hidden" name="key" value="<?= htmlspecialchars($key) ?>">
                            <button type="submit" name="action" value="increase" class="btn btn-sm btn-outline-secondary">+</button>
                        </form>

                        <span class="ms-3 fw-bold">
                            US$ <?= number_format($item['price'] * $item['quantity'], 2) ?>
                        </span>

                        <a href="actions/cart/remove.php?key=<?= urlencode($key) ?>" class="btn btn-sm btn-outline-danger ms-3">Eliminar</a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="mt-3">
            <strong>Total:</strong> US$ <?= number_format($cart->getTotal(), 2) ?>
        </div>

        <div class="d-flex space-between">
            <form method="POST" action="actions/cart/clear.php" class="mt-3 d-inline">
                <button type="submit" class="btn btn-danger">Vaciar carrito</button>
            </form>

            <a href="index.php?sec=checkout" class="btn btn-success mt-3 ms-2">Finalizar compra</a>
        </div>

    <?php endif; ?>
</section>
