<?php

require_once "../../functions/autoload.php";

$sneakerId = $_POST['sneaker_id'] ?? null;
$sizeId = $_POST['size_id'] ?? null;
$quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

if (!$sneakerId || !$sizeId) {
    header("Location: ../../index.php?sec=sneaker-detail&id={$sneakerId}");
}

$sneaker = Sneaker::getSneakerById((int)$sneakerId);

if (!$sneaker) {
    header("Location: ../../index.php?sec=sneaker-list");
}

$cart = new Cart();
$cart->add($sneaker, (int)$sizeId, $quantity);

header("Location: ../../index.php?sec=cart");

?>