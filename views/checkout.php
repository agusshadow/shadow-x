<?php
$cart = new Cart();
$items = $cart->getItems();
$total = $cart->getTotal();
?>

<section class="container">
    <h2 class="pt-4 pt-md-5 mb-4 text-success fw-bold">Checkout</h2>

    <?php if (empty($items)): ?>
        <p>No hay productos en el carrito.</p>
        <a href="index.php?sec=sneaker-list" class="btn btn-success mt-3">Explorar productos</a>
    <?php else: ?>
        <div class="row">
            <div class="col-12 col-md-6 mb-4">
                <h4 class="mb-3">Datos de envío y pago</h4>
                <form method="POST" action="actions/checkout/process.php">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Nombre completo</label>
                        <input type="text" class="form-control" id="fullName" name="full_name" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="city" class="form-label">Ciudad</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="mb-3">
                        <label for="postalCode" class="form-label">Código postal</label>
                        <input type="text" class="form-control" id="postalCode" name="postal_code" required>
                    </div>
                    <div class="mb-3">
                        <label for="shippingAddress" class="form-label">Dirección de envío</label>
                        <input type="text" class="form-control" id="shippingAddress" name="shipping_address" required>
                    </div>
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Método de pago</label>
                        <select class="form-select" id="paymentMethod" name="payment_method" required>
                            <option value="transfer">Transferencia bancaria</option>
                            <option value="credit_card">Tarjeta de crédito</option>
                        </select>
                    </div>
                    <div id="creditCardFields" class="border rounded p-3 mb-3 d-none">
                        <h5 class="mb-3">Datos de la tarjeta</h5>
                        <div class="mb-3">
                            <label for="cardNumber" class="form-label">Número de tarjeta</label>
                            <input type="text" class="form-control" id="cardNumber" name="card_number" placeholder="XXXX XXXX XXXX XXXX">
                        </div>
                        <div class="mb-3">
                            <label for="cardName" class="form-label">Nombre en la tarjeta</label>
                            <input type="text" class="form-control" id="cardName" name="card_name" placeholder="Nombre completo">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cardExpiry" class="form-label">Fecha de expiración</label>
                                <input type="text" class="form-control" id="cardExpiry" name="card_expiry" placeholder="MM/AA">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="cardCvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cardCvv" name="card_cvv" placeholder="XXX">
                            </div>
                        </div>
                    </div>
                    <div id="transferFields" class="border rounded p-3 mb-3">
                        <h5 class="mb-3">Datos para transferencia bancaria</h5>
                        <p class="mb-1"><strong>Banco:</strong> Banco Ficticio S.A.</p>
                        <p class="mb-1"><strong>CBU:</strong> 1234567890123456789012</p>
                        <p class="mb-1"><strong>Alias:</strong> zapatillas.tienda</p>
                        <p class="mb-1"><strong>Titular:</strong> ShadowX S.R.L.</p>
                        <p class="text-secondary mt-2">
                            Al finalizar tu compra recibirás un correo con los datos de la orden y las instrucciones para enviarnos el comprobante.
                        </p>
                    </div>
                    <button type="submit" class="btn btn-success px-4 py-2">Confirmar compra</button>
                </form>
            </div>
            <div class="col-12 col-md-6 mb-4">
                <h4 class="mb-3">Resumen del pedido</h4>
                <ul class="list-group mb-3">
                    <?php foreach ($items as $item): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="./images/sneakers/<?= $item['image'] ?>" width="50" class="me-2" alt="<?= $item['name'] ?>">
                                <div>
                                    <strong><?= $item['name'] ?></strong><br>
                                    <small><?= $item['size']['label'] ?> x <?= $item['quantity'] ?></small>
                                </div>
                            </div>
                            <span>US$ <?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                        </li>
                    <?php endforeach; ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <strong>Total:</strong>
                        <strong>US$ <?= number_format($total, 2) ?></strong>
                    </li>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const paymentSelect = document.getElementById('paymentMethod');
    const creditCardFields = document.getElementById('creditCardFields');
    const transferFields = document.getElementById('transferFields');
    const form = document.querySelector('form');

    const cardNumber = document.getElementById('cardNumber');
    const cardName = document.getElementById('cardName');
    const cardExpiry = document.getElementById('cardExpiry');
    const cardCvv = document.getElementById('cardCvv');

    function togglePaymentFields() {
        if (paymentSelect.value === 'credit_card') {
            creditCardFields.classList.remove('d-none');
            transferFields.classList.add('d-none');
        } else {
            creditCardFields.classList.add('d-none');
            transferFields.classList.remove('d-none');
        }
    }

    paymentSelect.addEventListener('change', togglePaymentFields);
    togglePaymentFields();

    form.addEventListener('submit', function (e) {
        if (paymentSelect.value === 'credit_card') {
            const missingFields = [];

            if (!cardNumber.value.trim()) missingFields.push('Número de tarjeta');
            if (!cardName.value.trim()) missingFields.push('Nombre en la tarjeta');
            if (!cardExpiry.value.trim()) missingFields.push('Fecha de expiración');
            if (!cardCvv.value.trim()) missingFields.push('CVV');

            if (missingFields.length > 0) {
                e.preventDefault();
                alert('Por favor completá los siguientes campos para pagar con tarjeta:\n\n' + missingFields.join('\n'));
            }
        }
    });
});
</script>

