<?php

require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? null;

if ($id) {
    Size::delete((int)$id);
    Alert::addAlert('success', 'Talle eliminado correctamente.');
}

header('Location: ../../index.php?sec=admin-sizes');

?>