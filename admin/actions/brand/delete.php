<?php

require_once "../../../functions/autoload.php";

$brandId = $_GET["id"] ?? false;

try {
    Brand::delete($brandId);
    Alert::addAlert("success", "Marca eliminada con exito");
} catch (Exception $e) {
    Alert::addAlert("danger", "Error al elimiar la marca");
}

header("Location: ../../index.php?sec=admin-brands");

?>
