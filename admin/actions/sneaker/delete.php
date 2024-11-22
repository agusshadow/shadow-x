<?php

require_once "../../../functions/autoload.php";

$sneakerId = $_GET["id"] ?? false;

try {
    $sneaker = Sneaker::getSneakerById($sneakerId);
    
    $imagePath = "../../images/sneakers/" . $sneaker->getImage();

    Image::deleteImage($imagePath);
    $sneaker->clearSizes();
    $sneaker->delete();
    Alert::addAlert("success", "Zapatilla eliminada con exito");

} catch (Exception $e) {
    Alert::addAlert("danger", "Error al eliminar zapatilla");
}

header("Location: ../../index.php?sec=admin-sneakers");

?>
