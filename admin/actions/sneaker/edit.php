<?php
require_once "../../../functions/autoload.php";

$sneakerData = $_POST;
$imageFile = $_FILES["image"] ?? false;
$id = $_GET["id"] ?? false;

try {
    $sneaker = Sneaker::getSneakerById($id);

    if (!empty($imageFile["tmp_name"])) {
        Image::deleteImage("../../../images/sneakers/" . $sneaker->getImage());
        $image = Image::uploadImage("../../../images/sneakers/", $imageFile);
    } else {
        $image = $sneaker->getImage();
    }

    $sneakerValues = [
        "name" => $sneakerData["name"],
        "description" => $sneakerData["description"],
        "price" => $sneakerData["price"],
        "image" => $image,
        "brand_id" => $sneakerData["brand_id"],
        "category_id" => $sneakerData["category_id"],

    ];

    $sizes = [];
    if (isset($sneakerData["sizes"])) {
        foreach ($sneakerData["sizes"] as $sizeId) {
            $stock = isset($sneakerData["stock_" . $sizeId]) ? $sneakerData["stock_" . $sizeId] : 0;
            $sizes[$sizeId] = $stock;
        }
    }

    $sneaker->edit($sneakerValues, $sizes);
    Alert::addAlert("success", "Zapatilla editada con exito");

} catch (Exception $e) {
    Alert::addAlert("danger", "Error al editar al zapatilla");
}

header("Location: ../../index.php?sec=admin-sneakers");

?>
