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
        <div class="contenedor">
          <p class="eyebrow">Área privada</p>
          <h1 class="titulo-seccion" id="titulo-cuenta">Hola, <?= e($_SESSION['usuario_nombre']) ?></h1>
          <p class="subtitulo">Esta página solo se ve con la sesión iniciada</p>
          <div class="divisor" aria-hidden="true"></div>
<?php if ($sin_permiso) : ?>
          <div class="alerta alerta-warning" role="alert">
            No tenés permisos para entrar a esa sección (requiere rol administrador).
          </div>
<?php endif; ?>
          <div class="grid gap-6 md:grid-cols-2">
            <div class="panel">
              <h2 class="mb-4 text-2xl font-bold">Mis datos</h2>
              <dl class="grid grid-cols-3 gap-y-3">
                <dt class="meta uppercase tracking-[0.15em]">Nombre</dt>
                <dd class="col-span-2"><?= e($usuario['nombre']) ?></dd>
                <dt class="meta uppercase tracking-[0.15em]">Email</dt>
                <dd class="col-span-2"><?= e($usuario['email']) ?></dd>
                <dt class="meta uppercase tracking-[0.15em]">Rol</dt>
                <dd class="col-span-2"><span class="badge"><?= e($usuario['rol']) ?></span></dd>
                <dt class="meta uppercase tracking-[0.15em]">Alta</dt>
                <dd class="col-span-2"><?= e(date('d/m/Y', strtotime($usuario['created_at']))) ?></dd>
              </dl>
            </div>
            <div class="panel">
              <h2 class="mb-4 text-2xl font-bold">Accesos rápidos</h2>
              <ul class="mb-6 list-inside list-disc space-y-1">
                <li><a href="tienda.php">Ir a la tienda</a></li>
                <li><a href="talleres.php">Ver talleres disponibles</a></li>
<?php if (es_admin()) : ?>
                <li><a href="admin_panel.php">Panel de administración</a></li>
<?php endif; ?>
              </ul>
              <a class="btn-borde" href="logout.php">Cerrar sesión</a>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
