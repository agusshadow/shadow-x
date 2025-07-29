<?php

require_once '../../functions/autoload.php';

$key = $_POST['key'] ?? null;
$action = $_POST['action'] ?? null;

if ($key !== null && in_array($action, ['increase', 'decrease'])) {
    $cart = new Cart();

    if ($action === 'increase') {
        $cart->changeQuantity($key, 1);
    } elseif ($action === 'decrease') {
        $cart->changeQuantity($key, -1);
    }
}

header('Location: ../../index.php?sec=cart');

?>
