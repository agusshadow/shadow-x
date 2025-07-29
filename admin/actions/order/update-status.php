<?php

require_once "../../../functions/autoload.php";

$id = $_GET['id'] ?? null;
$newStatus = $_POST['status'] ?? null;

if (!$id || !$newStatus) {
    Alert::addAlert('danger', 'Datos inválidos para actualizar el estado.');
    header("Location: ../../index.php?sec=admin-orders");
}

if (Order::updateStatus((int)$id, $newStatus)) {
    Alert::addAlert('success', 'Estado de la orden actualizado correctamente.');
} else {
    Alert::addAlert('danger', 'No se pudo actualizar el estado de la orden.');
}

header("Location: ../../index.php?sec=edit-order&id=" . urlencode($id));

?>