<?php
require_once __DIR__ . '/../config/config.php';

$titulo_pagina = $titulo_pagina ?? 'Inicio';
$descripcion_pagina = $descripcion_pagina ?? 'Cafetería de especialidad, arte latte y talleres de barismo.';
?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="<?= e($descripcion_pagina) ?>" />
    <meta name="author" content="Julieta Andrea Cardozo" />
    <meta name="theme-color" content="#5a2a12" />
    <title><?= e($titulo_pagina) ?> | <?= e(APP_NAME) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Inter:wght@400;500;600&family=Playfair+Display:ital,wght@0,700;0,900;1,400;1,700&display=swap"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="icon" href="img/favicon.svg" type="image/svg+xml" />
    <link rel="stylesheet" href="css/styles.css" />
  </head>
  <body>
    <a class="skip-link" href="#contenido">Saltar al contenido</a>
