<?php
$titulo_pagina = 'Panel de administración';
$descripcion_pagina = 'Panel de administración de Barismo & Café.';
$pagina_actual = 'admin';

$rol_requerido = 'admin';
require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/config/conexion.php';

$total_productos = (int) $pdo->query('SELECT COUNT(*) FROM productos')->fetchColumn();
$por_rol = $pdo->query('SELECT rol, COUNT(*) AS cantidad FROM usuarios GROUP BY rol')->fetchAll(PDO::FETCH_KEY_PAIR);
$usuarios = $pdo->query('SELECT id, nombre, email, rol, created_at FROM usuarios ORDER BY created_at DESC, id DESC')->fetchAll();

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-panel">
        <div class="container">
          <p class="eyebrow">Solo administradores</p>
          <h1 class="titulo-seccion" id="titulo-panel">Panel de administración</h1>
          <p class="subtitulo">Sesión de <?= e($_SESSION['usuario_nombre']) ?> · rol <?= e($_SESSION['rol']) ?></p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row g-4 mb-5">
            <div class="col-md-4">
              <div class="taller text-center h-100">
                <p class="eyebrow mb-1">Productos</p>
                <p class="display-5 mb-2"><?= $total_productos ?></p>
                <a class="btn btn-cafe btn-sm" href="admin/index.php">Administrar productos</a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="taller text-center h-100">
                <p class="eyebrow mb-1">Administradores</p>
                <p class="display-5 mb-0"><?= (int) ($por_rol['admin'] ?? 0) ?></p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="taller text-center h-100">
                <p class="eyebrow mb-1">Usuarios registrados</p>
                <p class="display-5 mb-0"><?= (int) ($por_rol['usuario'] ?? 0) ?></p>
              </div>
            </div>
          </div>
          <h2 class="h4">Usuarios</h2>
          <div class="table-responsive">
            <table class="table table-borderless align-middle mb-0">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Email</th>
                  <th scope="col">Rol</th>
                  <th scope="col">Alta</th>
                </tr>
              </thead>
              <tbody>
<?php foreach ($usuarios as $u) : ?>
                <tr>
                  <td><?= (int) $u['id'] ?></td>
                  <td><?= e($u['nombre']) ?></td>
                  <td><?= e($u['email']) ?></td>
                  <td><span class="badge text-bg-<?= $u['rol'] === 'admin' ? 'dark' : 'secondary' ?>"><?= e($u['rol']) ?></span></td>
                  <td><?= e(date('d/m/Y H:i', strtotime($u['created_at']))) ?></td>
                </tr>
<?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
