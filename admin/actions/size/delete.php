<?php

require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? null;

try {
    if ($id) {
        $success = Size::delete((int)$id);

        if ($success) {
            Alert::addAlert('success', 'Talle eliminado correctamente.');
        } else {
            Alert::addAlert('danger', 'No se pudo eliminar el talle.');
        }
    }
} catch (Exception $e) {
    if ($e->getCode() === 23000 || str_contains($e->getMessage(), 'foreign key constraint')) {
        Alert::addAlert('danger', 'No se puede eliminar el talle porque está asociado a uno o más productos.');
    } else {
        Alert::addAlert('danger', 'Error inesperado al eliminar el talle.');
    }
}

header('Location: ../../index.php?sec=admin-sizes');

?>