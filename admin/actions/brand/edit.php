<?php

require_once "../../../functions/autoload.php";

$brandId = $_GET["id"] ?? false;
$brandData = $_POST;

try {
    Brand::edit($brandId, $brandData["name"], $brandData["description"]);
    Alert::addAlert("success", "Marca editada con exito");
} catch (Exception $e) {
    Alert::addAlert("danger", "Error al editar la marca");
}

header("Location: ../../index.php?sec=admin-brands");

?>