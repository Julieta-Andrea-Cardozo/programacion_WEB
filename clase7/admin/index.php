<?php
$titulo_pagina = 'Administrar';
$descripcion_pagina = 'Administración de productos de Barismo & Café.';
$pagina_actual = 'admin';

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/nav.php';
require_once __DIR__ . '/../config/conexion.php';
require_once __DIR__ . '/../data/catalogo.php';

$estados = [
    'created' => 'Producto agregado correctamente.',
    'updated' => 'Producto actualizado correctamente.',
    'deleted' => 'Producto eliminado correctamente.',
];
$status = (string) (filter_input(INPUT_GET, 'status') ?? '');
$aviso = $estados[$status] ?? '';

$stmt = $pdo->prepare('SELECT * FROM productos ORDER BY id DESC');
$stmt->execute();
$productos = $stmt->fetchAll();
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-admin">
        <div class="container">
          <p class="eyebrow">Administración</p>
          <h1 class="titulo-seccion" id="titulo-admin">Productos</h1>
          <p class="subtitulo">Granos e insumos de la tienda</p>
          <div class="divisor" aria-hidden="true"></div>
<?php if ($aviso) : ?>
          <div class="alert alert-success" role="status"><?= e($aviso) ?></div>
<?php endif; ?>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="meta mb-0"><?= count($productos) ?> producto(s) en la base de datos</p>
            <a class="btn btn-cafe" href="crear.php">Agregar producto</a>
          </div>
          <div class="table-responsive">
            <table class="table table-borderless align-middle mb-0">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Producto</th>
                  <th scope="col">Categoría</th>
                  <th scope="col" class="text-end">Precio</th>
                  <th scope="col" class="text-end">Acciones</th>
                </tr>
              </thead>
              <tbody>
<?php foreach ($productos as $p) : ?>
                <tr>
                  <td><?= (int) $p['id'] ?></td>
                  <td>
                    <?= e($p['nombre']) ?><br />
                    <span class="meta"><?= e($p['meta']) ?></span>
                  </td>
                  <td><?= e($p['categoria'] === 'grano' ? 'Café en grano' : 'Insumo') ?></td>
                  <td class="text-end"><?= e(precio((int) $p['precio'])) ?></td>
                  <td class="text-end text-nowrap">
                    <a class="btn btn-borde btn-sm" href="editar.php?id=<?= (int) $p['id'] ?>">Editar</a>
                    <form
                      method="post"
                      action="eliminar.php"
                      class="d-inline"
                      onsubmit="return confirm('¿Eliminar «<?= e($p['nombre']) ?>»?')"
                    >
                      <input type="hidden" name="id" value="<?= (int) $p['id'] ?>" />
                      <button class="btn btn-borde btn-sm" type="submit">Eliminar</button>
                    </form>
                  </td>
                </tr>
<?php endforeach; ?>
<?php if (!$productos) : ?>
                <tr>
                  <td colspan="5" class="meta">Todavía no hay productos cargados.</td>
                </tr>
<?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/../includes/footer.php'; ?>
