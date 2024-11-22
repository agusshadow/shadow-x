<?php

require_once "../../../functions/autoload.php";

$brandData = $_POST;

try {
    Brand::create($brandData["name"], $brandData["description"]);
    Alert::addAlert("success", "Marca creada con exito");
} catch (Exception $e) {
    Alert::addAlert("danger", "Error al crear la marca");
}

header("Location: ../../index.php?sec=admin-brands");

?>
