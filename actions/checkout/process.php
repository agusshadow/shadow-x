<?php

require_once "../../functions/autoload.php";

$cart = new Cart();
$items = $cart->getItems();

if (empty($items)) {
    header("Location: ../../index.php?sec=cart");
    exit;
}

$orderData = [
   'user_id' => $_SESSION['user']['id'] ?? null,
    'full_name'       => trim($_POST['full_name'] ?? ''),
    'phone'           => trim($_POST['phone'] ?? ''),
    'city'            => trim($_POST['city'] ?? ''),
    'postal_code'     => trim($_POST['postal_code'] ?? ''),
    'shipping_address'=> trim($_POST['shipping_address'] ?? ''),
    'payment_method'  => trim($_POST['payment_method'] ?? ''),
    'total_amount'    => $cart->getTotal()
];

if (
    empty($orderData['full_name']) ||
    empty($orderData['phone']) ||
    empty($orderData['city']) ||
    empty($orderData['postal_code']) ||
    empty($orderData['shipping_address']) ||
    empty($orderData['payment_method'])
) {
    header("Location: ../../index.php?sec=checkout&error=faltan_datos");
}

try {
    $orderId = Order::create($orderData, $items);
    $cart->clear();
    header("Location: ../../index.php?sec=checkout-success&id={$orderId}");

} catch (Exception $e) {
    error_log("Error al crear la orden: " . $e->getMessage());
    header("Location: ../../index.php?sec=checkout&error=server");
}

?>
