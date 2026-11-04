<?php
$titulo_pagina = 'Mi cuenta';
$descripcion_pagina = 'Panel personal del usuario de Barismo & Café.';
$pagina_actual = 'cuenta';

require_once __DIR__ . '/includes/auth_guard.php';
require_once __DIR__ . '/config/conexion.php';

$stmt = $pdo->prepare('SELECT nombre, email, rol, created_at FROM usuarios WHERE id = :id');
$stmt->execute([':id' => $_SESSION['usuario_id']]);
$usuario = $stmt->fetch();

if (!$usuario) {
    header('Location: logout.php');
    exit;
}

$sin_permiso = filter_input(INPUT_GET, 'error') === 'sin_permiso';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-cuenta">
        <div class="container">
          <p class="eyebrow">Área privada</p>
          <h1 class="titulo-seccion" id="titulo-cuenta">Hola, <?= e($_SESSION['usuario_nombre']) ?></h1>
          <p class="subtitulo">Esta página solo se ve con la sesión iniciada</p>
          <div class="divisor" aria-hidden="true"></div>
<?php if ($sin_permiso) : ?>
          <div class="alert alert-warning" role="alert">
            No tenés permisos para entrar a esa sección (requiere rol administrador).
          </div>
<?php endif; ?>
          <div class="row g-4">
            <div class="col-md-6">
              <div class="taller h-100">
                <h2 class="h4">Mis datos</h2>
                <dl class="row mb-0">
                  <dt class="col-sm-4">Nombre</dt>
                  <dd class="col-sm-8"><?= e($usuario['nombre']) ?></dd>
                  <dt class="col-sm-4">Email</dt>
                  <dd class="col-sm-8"><?= e($usuario['email']) ?></dd>
                  <dt class="col-sm-4">Rol</dt>
                  <dd class="col-sm-8"><span class="badge text-bg-secondary"><?= e($usuario['rol']) ?></span></dd>
                  <dt class="col-sm-4">Alta</dt>
                  <dd class="col-sm-8"><?= e(date('d/m/Y', strtotime($usuario['created_at']))) ?></dd>
                </dl>
              </div>
            </div>
            <div class="col-md-6">
              <div class="taller h-100">
                <h2 class="h4">Accesos rápidos</h2>
                <ul class="mb-3">
                  <li><a href="tienda.php">Ir a la tienda</a></li>
                  <li><a href="talleres.php">Ver talleres disponibles</a></li>
<?php if (es_admin()) : ?>
                  <li><a href="admin_panel.php">Panel de administración</a></li>
<?php endif; ?>
                </ul>
                <a class="btn btn-borde" href="logout.php">Cerrar sesión</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
