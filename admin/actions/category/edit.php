<?php

require_once "../../../functions/autoload.php";

$categoryId = $_GET["id"] ?? false;
$categoryData = $_POST;

try {
    Category::edit($categoryId, $categoryData["name"], $categoryData["description"]);
    Alert::addAlert("success", "Categoria editada con exito");
} catch (Exception $e) {
    Alert::addAlert("danger", "Error al editar la categoria");
}

header("Location: ../../index.php?sec=admin-categories");

?> 