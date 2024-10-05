<?php 

$rutas_permitidas = [
  'inicio' => [
    'title' => 'Inicio',
  ],
  'listado' => [
    'title' => 'Productos',
  ],
  'contacto' => [
    'title' => 'Contacto',
  ],
  'detalle-producto' => [
    'title' => 'Detalle Producto',
  ],
  '404' => [
    'title' => 'Pagina no encontrada'
  ],
];

$vista = isset($_GET['sec']) ? $_GET['sec'] : 'inicio';

if (!isset($rutas_permitidas[$vista])) {
  $vista = '404';
}

$vista_seleccionada = $rutas_permitidas[$vista];

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
    <link rel="stylesheet" href="css/estilos.css">
    <title><?= $vista_seleccionada['title'] ?></title>
</head>
<body>

    <header>

        <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-success">
            <div class="container">
              <a class="navbar-brand logo navbar-item" href="index.php?s=inicio">shadow x</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse navbar-item" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto ms-2 mb-2 mb-lg-0">
                  <li class="nav-item dropdown">
                    <a href="index.php?sec=listado" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      Zapatillas
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item text-success" href="index.php?sec=listado">Nike</a></li>
                      <li><a class="dropdown-item text-success" href="index.php?sec=listado">Adidas</a></li>
                      <li><a class="dropdown-item text-success" href="index.php?sec=listado">Asics</a></li>
                    </ul>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=contacto">Contacto</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </header>
    
    <main class="pt-5 mt-2">
        <?php 

        if (file_exists('vistas/' . $vista . '.php')) {
          require_once __DIR__ . '/vistas/' . $vista . '.php';
        } else {
          require_once __DIR__ . '/vistas/404.php';
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