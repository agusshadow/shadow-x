<?php
$id = $_GET['id'] ?? null;
$order = $id ? Order::getById((int)$id) : null;

if (!$order) {
    header("Location: index.php?sec=admin-orders");
    exit;
}

$paymentMap = [
    'transfer'    => 'Transferencia bancaria',
    'credit_card' => 'Tarjeta de crédito'
];
$statusMap = [
    'pending'   => 'Pendiente',
    'paid'      => 'Pagado',
    'shipped'   => 'Enviado',
    'completed' => 'Completado',
    'cancelled' => 'Cancelado'
];
?>

<section class="container">
    <div>
        <?= Alert::getAlerts(); ?>
    </div>
    <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">Detalle de la orden #<?= $order->getId() ?></h2>

    <div class="mb-4">
        <h4 class="fw-bold">Datos del comprador</h4>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Usuario:</strong>
                    <?php if ($order->getUserId()): ?>
                        <?= $order->getUserId() ?>
                    <?php else: ?>
                        <em class="text-muted">Invitado</em>
                    <?php endif; ?>
                </p>
                <p><strong>Nombre completo:</strong> <?= $order->getFullName() ?></p>
                <p><strong>Teléfono:</strong> <?= $order->getPhone() ?></p>
                <p><strong>Ciudad:</strong> <?= $order->getCity() ?></p>
            </div>
            <div class="col-md-6">
                <p><strong>Código postal:</strong> <?= $order->getPostalCode() ?></p>
                <p><strong>Dirección de envío:</strong> <?= $order->getShippingAddress() ?></p>
                <p><strong>Método de pago:</strong>
                    <?= $paymentMap[$order->getPaymentMethod()] ?? ucfirst($order->getPaymentMethod()) ?>
                </p>
                <p><strong>Total:</strong> US$ <?= number_format($order->getTotalAmount(), 2) ?></p>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h4 class="fw-bold">Productos comprados</h4>
        <ul class="list-group">
            <?php foreach ($order->getItems() as $item): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?= $item['sneaker_name'] ?></strong><br>
                        <small><?= $item['size_label'] ?> US - <?= ucfirst(strtolower($item['gender'])) ?></small><br>
                        <small>Cantidad: <?= (int)$item['quantity'] ?></small>
                    </div>
                    <div>
                        US$ <?= number_format($item['price'] * $item['quantity'], 2) ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="mb-4">
        <h4 class="fw-bold">Estado actual: 
            <span class="text-primary">
                <?= $statusMap[$order->getStatus()] ?? ucfirst($order->getStatus()) ?>
            </span>
        </h4>

        <!-- Form para actualizar estado -->
        <form method="POST" action="actions/order/update-status.php?id=<?= $order->getId() ?>">
            <div class="mb-3">
                <label for="status" class="form-label">Cambiar estado</label>
                <select id="status" name="status" class="form-select" required>
                    <?php foreach ($statusMap as $value => $label): ?>
                        <option value="<?= $value ?>" <?= $order->getStatus() === $value ? 'selected' : '' ?>>
                            <?= $label ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Actualizar estado</button>
        </form>
    </div>

</section>
