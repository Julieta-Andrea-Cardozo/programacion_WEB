<?php
$titulo_pagina = 'Editar producto';
$descripcion_pagina = 'Modificar un producto de la tienda de Barismo & Café.';
$pagina_actual = 'admin';

require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/funciones.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM productos WHERE id = :id');
$stmt->execute([':id' => $id]);
$producto = $stmt->fetch();

if (!$producto) {
    header('Location: index.php');
    exit;
}

$datos = [
    'nombre' => $producto['nombre'],
    'categoria' => $producto['categoria'],
    'meta' => $producto['meta'],
    'notas' => $producto['notas'],
    'precio' => (string) $producto['precio'],
    'estrellas' => (string) $producto['estrellas'],
    'imagen' => $producto['imagen'],
];
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = leer_producto_post();
    $errores = validar_producto($datos);

    if (!$errores) {
        $stmt = $pdo->prepare(
            'UPDATE productos
             SET nombre = :nombre, categoria = :categoria, meta = :meta,
                 notas = :notas, precio = :precio, estrellas = :estrellas, imagen = :imagen
             WHERE id = :id'
        );
        $stmt->execute(producto_normalizado($datos) + [':id' => $id]);
        header('Location: index.php?status=updated');
        exit;
    }
}

$accion = 'editar.php?id=' . $id;

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion seccion-papel" aria-labelledby="titulo-editar">
        <div class="container">
          <p class="eyebrow">Administración</p>
          <h1 class="titulo-seccion" id="titulo-editar">Editar producto</h1>
          <p class="subtitulo">Editando «<?= e($producto['nombre']) ?>»</p>
          <div class="divisor" aria-hidden="true"></div>
<?php require __DIR__ . '/formulario.php'; ?>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
