<?php
$orders = Order::getAll();
?>

<section class="container">
    <div>
        <?= Alert::getAlerts(); ?>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="pt-4 pt-md-5 mb-5 text-success fw-bold">
            Administrar órdenes
        </h2>
    </div>

    <table class="table table-borderless align-middle">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre completo</th>
                <th>Método de pago</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Detalle</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr>
                    <td><?= $order->getId() ?></td>
                    <td><?= htmlspecialchars($order->getFullName()) ?></td>
                    <td>
                        <?php
                        $paymentMap = [
                            'transfer'    => 'Transferencia bancaria',
                            'credit_card' => 'Tarjeta de crédito'
                        ];
                        echo $paymentMap[$order->getPaymentMethod()] ?? ucfirst($order->getPaymentMethod());
                        ?>
                    </td>
                    <td>US$ <?= number_format($order->getTotalAmount(), 2) ?></td>
                    <td>
                        <?php
                        $statusMap = [
                            'pending'   => 'Pendiente',
                            'paid'      => 'Pagado',
                            'shipped'   => 'Enviado',
                            'completed' => 'Completado',
                            'cancelled' => 'Cancelado'
                        ];
                        echo $statusMap[$order->getStatus()] ?? ucfirst($order->getStatus());
                        ?>
                    </td>
                    <td class="col-1">
                        <a href="index.php?sec=edit-order&id=<?= $order->getId() ?>" class="btn btn-success btn-sm w-100">
                            Ver detalle
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
