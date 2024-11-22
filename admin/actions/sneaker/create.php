<?php

require_once "../../../functions/autoload.php";

$sneakerData = $_POST;
$imageFile = $_FILES["image"] ?? false;

try {
    $image = Image::uploadImage("../../../images/sneakers/",  $imageFile);

    $sneaker = [
        "name" => $sneakerData["name"],
        "description" => $sneakerData["description"],
        "price" => $sneakerData["price"],
        "image" => $image,
        "brand_id" => $sneakerData["brand_id"],
        "category_id" => $sneakerData["category_id"]
    ];

    $sizes = [];
    if (isset($_POST["sizes"])) {
        foreach ($_POST["sizes"] as $sizeId) {
            $stock = isset($_POST["stock_" . $sizeId]) ? $_POST["stock_" . $sizeId] : 0;
            $sizes[$sizeId] = $stock;
        }
    }
    
    Sneaker::create($sneaker, $sizes);
    Alert::addAlert("success", "Zapatilla creado con exito");
} catch (Exception $e) {
    Alert::addAlert("danger", "Error al crear al zapatilla");
}

header("Location: ../../index.php?sec=admin-sneakers");

?>
