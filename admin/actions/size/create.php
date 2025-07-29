<?php

require_once "../../../functions/autoload.php";

$size = $_POST['size'] ?? '';
$gender = $_POST['gender'] ?? '';

if ($size && $gender) {
    Size::create($size, $gender);
    Alert::addAlert('success', 'Talle creado correctamente.');
}

header('Location: ../../index.php?sec=admin-sizes');

?>