<?php

require_once "../../../functions/autoload.php";

$categoryId = $_GET["id"] ?? false;

try {
    $success = Category::delete($categoryId);
    
    if ($success) {
        Alert::addAlert("success", "Categoría eliminada con éxito.");
    } else {
        Alert::addAlert("danger", "No se pudo eliminar la categoría.");
    }

} catch (Exception $e) {
    if (str_contains($e->getMessage(), 'foreign key constraint')) {
        Alert::addAlert("danger", "No se puede eliminar la categoría porque está asociada a un producto.");
    } else {
        Alert::addAlert("danger", "Error inesperado al eliminar la categoría.");
    }
}

header("Location: ../../index.php?sec=admin-categories");

?>
