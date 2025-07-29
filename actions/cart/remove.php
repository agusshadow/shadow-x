<?php

require_once '../../functions/autoload.php';

$key = $_GET['key'] ?? null;

if ($key !== null) {
    $cart = new Cart();
    $cart->remove($key);
}

header('Location: ../../index.php?sec=cart');

?>
