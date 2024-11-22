<?php

require_once "../../../functions/autoload.php";

$categoryId = $_GET["id"] ?? false;

try {
    Category::delete($categoryId);
    Alert::addAlert("success", "Categoria eliminada con exito");
} catch (Exception $e) {
    Alert::addAlert("danger", "Error al elimiar la categoria");
}

header("Location: ../../index.php?sec=admin-categories");

?>
