<?php

require_once "../../../functions/autoload.php";

$categoryData = $_POST;

try {
    Category::create($categoryData["name"], $categoryData["description"]);
    Alert::addAlert("success", "Categoria creada con exito");
} catch (Exception $e) {
    Alert::addAlert("danger", "Error al crear la categoria");
}

header("Location: ../../index.php?sec=admin-categories");

?>
