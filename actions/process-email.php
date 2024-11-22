<?php 

$data = $_GET;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Gracias</title>
</head>
<body>

    <section class="container py- my-5">
        <h1 class="text-success mb-1 text-center">Gracias <?= $data['name'] ?>!</h1>
        <p class="mb-5 text-center">Enviaremos una respuesta a tu consulta al siguiente email: <?= $data['email'] ?></p>
        <p class="w-50 mx-auto border p-3"><?= $data['message'] ?></p>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>