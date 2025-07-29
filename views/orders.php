<?php
$userData = $_SESSION['user'] ?? null;
if (!$userData) {
    header("Location: index.php?sec=login");
    exit;
}

$orders = Order::getByUserId($userData['id']);
?>

<section class="container">
    <h2 class="pt-4 pt-md-5 mb-4 text-success fw-bold">Mis Órdenes</h2>

    <?php if (empty($orders)): ?>
        <div class="alert alert-info">
            Aún no realizaste ninguna compra.
        </div>
        <a href="index.php?sec=sneaker-list" class="btn btn-success mt-3">Explorar productos</a>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach ($orders as $order): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                Orden #<?= $order->getId() ?>
                            </h5>
                            <p class="mb-1">
                                <strong>Fecha:</strong> <?= date('d/m/Y', strtotime($order->getCreatedAt())) ?>
                            </p>
                            <p class="mb-1">
                                <strong>Método de pago:</strong>
                                <?php
                                $paymentMap = [
                                    'transfer' => 'Transferencia bancaria',
                                    'credit_card' => 'Tarjeta de crédito'
                                ];
                                echo $paymentMap[$order->getPaymentMethod()] ?? ucfirst($order->getPaymentMethod());
                                ?>
                            </p>
                            <p class="mb-1">
                                <strong>Total:</strong> US$ <?= number_format($order->getTotalAmount(), 2) ?>
                            </p>
                            <p class="mb-1">
                                <strong>Estado:</strong>
                                <?php
                                $statusMap = [
                                    'pending'   => 'Pendiente',
                                    'paid'      => 'Pagado',
                                    'shipped'   => 'Enviado',
                                    'completed' => 'Completado',
                                    'cancelled' => 'Cancelado'
                                ];
                                $status = $order->getStatus();
                                $statusLabel = $statusMap[$status] ?? ucfirst($status);
                                ?>
                                <span class="badge 
                                    <?php
                                    switch ($status) {
                                        case 'pending': echo 'bg-warning text-dark'; break;
                                        case 'paid': echo 'bg-info'; break;
                                        case 'shipped': echo 'bg-primary'; break;
                                        case 'completed': echo 'bg-success'; break;
                                        case 'cancelled': echo 'bg-danger'; break;
                                        default: echo 'bg-secondary'; break;
                                    }
                                    ?>">
                                    <?= $statusLabel ?>
                                </span>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <a href="index.php?sec=order-detail&id=<?= $order->getId() ?>" class="btn btn-outline-success w-100">
                                Ver detalle
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</section>
