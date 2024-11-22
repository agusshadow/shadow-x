<?php 

require_once "functions/autoload.php";

$view = View::validate($_GET['sec'] ?? 'home');

Auth::verify($view->getRestricted());
$userData = $_SESSION['user'] ?? false;

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="icon" type="image" href="logo.ico">
    <title><?= $view->getTitle() ?></title>
</head>
<body>

  <header>
      <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-success">
          <div class="container">
              <h1 class="m-unset">
                  <a class="navbar-brand logo navbar-item my-auto" href="index.php?sec=home">shadow x</a>
              </h1>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse navbar-item" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto ms-2 mb-2 mb-lg-0">
                      <li class="nav-item">
                          <a class="nav-link" href="index.php?sec=sneaker-list">Zapatillas</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="index.php?sec=shipments">Envios</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="index.php?sec=contact">Contacto</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="index.php?sec=student-data">Datos del alumno</a>
                      </li>
                  </ul>
                  <ul class="ms-auto mb-2 mb-lg-0"> 
                      <li class="nav-item <?= $userData ? "d-none" : "" ?>">
                          <a class="nav-link fw-bold" href="index.php?sec=login">Iniciar sesion</a>
                      </li>
                      <li class="nav-item <?= $userData ? "" : "d-none" ?>">
                          <a class="nav-link fw-bold" href="admin/actions/auth/logout.php">(<?= $userData["name"] ?>) Cerrar sesion <span class="fw-light"></span></a>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>
  </header>

    
    <main class="py-5 my-5">
      <?php
        $filePath = "./views/{$view->getName()}.php";
        if (file_exists($filePath)) {
            require_once $filePath;
        } else {
            require_once "./views/404.php";
        }
      ?>
    </main>

    <div class="container-fluid p-0">
      <footer class="border border-top-success">
        <ul class="d-flex justify-content-center m-0 gap-3 py-3">
          <li><a href="#" class="text-success">Política de privacidad</a></li>
          <li><a href="#" class="text-success">Trabaja con nosotros</a></li>
          <li><a href="#" class="text-success">Blog</a></li>
        </ul>
        <div class="py-3">
          <small class="text-center d-block">Copyright© <?php echo date('Y'); ?></small>
        </div>
      </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    
</body>
</html>