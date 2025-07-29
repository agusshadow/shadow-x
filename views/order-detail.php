<?php

$userData = $_SESSION['user'] ?? null;

$orderId = $_GET['id'] ?? null;
if (!$orderId) {
    header("Location: index.php?sec=orders");
    exit;
}

$order = Order::getById((int)$orderId);

if (!$order || $order->getUserId() !== (int)$userData['id']) {
    header("Location: index.php?sec=orders");
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
    <h2 class="pt-4 pt-md-5 mb-4 text-success fw-bold">Detalle de la Orden</h2>

    <div class="row">
        <div class="col-12 col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">Información de la orden</h5>
                    <p><strong>ID:</strong> <?= $order->getId() ?></p>
                    <p><strong>Fecha:</strong> <?= date('d/m/Y H:i', strtotime($order->getCreatedAt())) ?></p>
                    <p><strong>Nombre completo:</strong> <?= $order->getFullName() ?></p>
                    <p><strong>Teléfono:</strong> <?= $order->getPhone() ?></p>
                    <p><strong>Ciudad:</strong> <?= $order->getCity() ?></p>
                    <p><strong>Código Postal:</strong> <?= $order->getPostalCode() ?></p>
                    <p><strong>Dirección:</strong> <?= $order->getShippingAddress() ?></p>
                    <p><strong>Método de pago:</strong> <?= $paymentMap[$order->getPaymentMethod()] ?? ucfirst($order->getPaymentMethod()) ?></p>
                    <p>
                        <strong>Estado:</strong>
                        <?php 
                        $status = $order->getStatus();
                        $badgeClass = match($status) {
                            'pending' => 'bg-warning text-dark',
                            'paid' => 'bg-info',
                            'shipped' => 'bg-primary',
                            'completed' => 'bg-success',
                            'cancelled' => 'bg-danger',
                            default => 'bg-secondary'
                        };
                        ?>
                        <span class="badge <?= $badgeClass ?>">
                            <?= $statusMap[$status] ?? ucfirst($status) ?>
                        </span>
                    </p>
                    <p class="fw-bold"><strong>Total:</strong> US$ <?= number_format($order->getTotalAmount(), 2) ?></p>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">Productos comprados</h5>
                    <?php if (empty($order->getItems())): ?>
                        <p>No se encontraron productos para esta orden.</p>
                    <?php else: ?>
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Talle</th>
                                    <th>Cantidad</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order->getItems() as $item): ?>
                                    <tr>
                                        <td><?= $item['sneaker_name'] ?></td>
                                        <td><?= $item['size_label'] ?> US - <?= ucfirst(strtolower($item['gender'])) ?></td>
                                        <td><?= (int)$item['quantity'] ?></td>
                                        <td class="text-end">US$ <?= number_format($item['price'] * $item['quantity'], 2) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <a href="index.php?sec=orders" class="btn btn-outline-success mt-3">Volver a mis órdenes</a>
</section>
