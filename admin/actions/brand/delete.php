<?php

require_once "../../../functions/autoload.php";

$brandId = $_GET["id"] ?? false;

try {
    $success = Brand::delete($brandId);

    if ($success) {
        Alert::addAlert("success", "Marca eliminada con éxito.");
    } else {
        Alert::addAlert("danger", "No se pudo eliminar la marca.");
    }

} catch (Exception $e) {
    if ($e->getCode() == 23000 || str_contains($e->getMessage(), 'foreign key constraint')) {
        Alert::addAlert("danger", "No se puede eliminar la marca porque está asociada a uno o más productos.");
    } else {
        Alert::addAlert("danger", "Error inesperado al eliminar la marca.");
    }
}

header("Location: ../../index.php?sec=admin-brands");

?>
