<?php

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: index.php?sec=sneaker-list");
    exit;
}

$order = Order::getById((int)$id);
if (!$order) {
    header("Location: index.php?sec=sneaker-list");
    exit;
}

$paymentMethodRaw = $order->getPaymentMethod();
$paymentMethodMap = [
    'transfer' => 'Transferencia bancaria',
    'credit_card' => 'Tarjeta de crédito'
];
$paymentMethodLabel = $paymentMethodMap[$paymentMethodRaw] ?? ucfirst($paymentMethodRaw);

$statusRaw = $order->getStatus();
$statusMap = [
    'pending'   => 'Pendiente',
    'paid'      => 'Pagado',
    'shipped'   => 'Enviado',
    'completed' => 'Completado',
    'canceled'  => 'Cancelado'
];
$statusLabel = $statusMap[$statusRaw] ?? ucfirst($statusRaw);
?>

<section class="container">
    <?php if ($paymentMethodRaw === 'transfer'): ?>
        <h2 class="pt-4 pt-md-5 mb-4 text-warning fw-bold">Pago pendiente de acreditación</h2>
        <p class="mb-3">
            Tu pedido fue registrado correctamente. Para completar el proceso, realiza la transferencia bancaria utilizando los datos a continuación.
            <br>El pedido se completará cuando se acredite el pago.
        </p>

        <div class="border rounded p-3 mb-4 bg-light">
            <h4 class="fw-bold mb-3">Datos para transferencia bancaria</h4>
            <p class="mb-1"><strong>Banco:</strong> Banco Ficticio S.A.</p>
            <p class="mb-1"><strong>CBU:</strong> 1234567890123456789012</p>
            <p class="mb-1"><strong>Alias:</strong> zapatillas.tienda</p>
            <p class="mb-1"><strong>Titular:</strong> ShadowX S.R.L.</p>
            <p class="text-secondary mt-2">
                Al finalizar tu compra, envíanos el comprobante para validar tu pago.
            </p>
        </div>
    <?php else: ?>
        <h2 class="pt-4 pt-md-5 mb-4 text-success fw-bold">¡Gracias por tu compra!</h2>
        <p class="mb-3">
            Tu pedido se registró con éxito. A continuación tienes el resumen de la orden:
        </p>
    <?php endif; ?>

    <div class="mb-4">
        <h4 class="fw-bold mb-3">Datos de la orden</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="border rounded p-3 h-100">
                    <p class="mb-1"><strong>ID de orden:</strong> <?= htmlspecialchars($order->getId()) ?></p>
                    <p class="mb-1"><strong>Nombre completo:</strong> <?= htmlspecialchars($order->getFullName()) ?></p>
                    <p class="mb-1"><strong>Teléfono:</strong> <?= htmlspecialchars($order->getPhone()) ?></p>
                    <p class="mb-1"><strong>Ciudad:</strong> <?= htmlspecialchars($order->getCity()) ?></p>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="border rounded p-3 h-100">
                    <p class="mb-1"><strong>Código postal:</strong> <?= htmlspecialchars($order->getPostalCode()) ?></p>
                    <p class="mb-1"><strong>Dirección de envío:</strong> <?= htmlspecialchars($order->getShippingAddress()) ?></p>
                    <p class="mb-1"><strong>Método de pago:</strong> <?= htmlspecialchars($paymentMethodLabel) ?></p>
                    <p class="mb-1"><strong>Total:</strong> US$ <?= number_format($order->getTotalAmount(), 2) ?></p>
                    <p class="mb-0"><strong>Estado:</strong> <?= htmlspecialchars($statusLabel) ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4">
        <h4 class="fw-bold mb-3">Productos comprados</h4>
        <ul class="list-group">
            <?php foreach ($order->getItems() as $item): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?= htmlspecialchars($item['sneaker_name']) ?></strong><br>
                        <small><?= htmlspecialchars($item['size_label']) ?> US - <?= ucfirst(strtolower($item['gender'])) ?></small><br>
                        <small>Cantidad: <?= (int)$item['quantity'] ?></small>
                    </div>
                    <div>
                        US$ <?= number_format($item['price'] * $item['quantity'], 2) ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <a href="index.php?sec=sneaker-list" class="btn btn-success mt-3">Seguir explorando productos</a>
</section>
