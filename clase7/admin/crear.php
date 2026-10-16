<?php
$titulo_pagina = 'Agregar producto';
$descripcion_pagina = 'Cargar un nuevo producto en la tienda de Barismo & Café.';
$pagina_actual = 'admin';

require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/funciones.php';

$datos = [
    'nombre' => '',
    'categoria' => 'grano',
    'meta' => '',
    'notas' => '',
    'precio' => '',
    'estrellas' => '5',
    'imagen' => '',
];
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = leer_producto_post();
    $errores = validar_producto($datos);

    if (!$errores) {
        $stmt = $pdo->prepare(
            'INSERT INTO productos (nombre, categoria, meta, notas, precio, estrellas, imagen)
             VALUES (:nombre, :categoria, :meta, :notas, :precio, :estrellas, :imagen)'
        );
        $stmt->execute(producto_normalizado($datos));
        header('Location: index.php?status=created');
        exit;
    }
}

$accion = 'crear.php';

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion seccion-papel" aria-labelledby="titulo-crear">
        <div class="container">
          <p class="eyebrow">Administración</p>
          <h1 class="titulo-seccion" id="titulo-crear">Agregar producto</h1>
          <p class="subtitulo">Se guarda en la base de datos de la tienda</p>
          <div class="divisor" aria-hidden="true"></div>
<?php require __DIR__ . '/formulario.php'; ?>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
