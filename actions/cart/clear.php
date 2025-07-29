<?php

require_once '../../functions/autoload.php';

$cart = new Cart();
$cart->clear();

header('Location: ../../index.php?sec=cart');

?>
