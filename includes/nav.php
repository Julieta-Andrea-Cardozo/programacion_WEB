<?php
$paginas = [
    'index' => 'Inicio',
    'menu' => 'Menú',
    'galeria' => 'Galería',
    'equipo' => 'Equipo',
    'talleres' => 'Talleres',
    'blog' => 'Blog',
    'tienda' => 'Tienda',
    'tecnicas' => 'Técnicas',
    'ubicacion' => 'Ubicación',
    'contacto' => 'Contacto',
];

$pagina_actual = $pagina_actual ?? basename($_SERVER['SCRIPT_NAME'], '.php');
?>
    <header>
      <nav class="navbar navbar-expand-xxl navbar-barismo sticky-top" aria-label="Navegación principal">
        <div class="container">
          <a class="navbar-brand" href="<?= $base ?>index.php"><?= e(APP_NAME) ?></a>
          <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#menuPrincipal"
            aria-controls="menuPrincipal"
            aria-expanded="false"
            aria-label="Abrir menú de navegación"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav ms-auto gap-xxl-2">
<?php foreach ($paginas as $archivo => $etiqueta) : ?>
<?php $activa = $archivo === $pagina_actual; ?>
              <li class="nav-item">
                <a
                  class="nav-link<?= $activa ? ' active' : '' ?>"
                  <?= $activa ? 'aria-current="page"' : '' ?>
                  href="<?= $base . $archivo ?>.php"
                ><?= e($etiqueta) ?></a>
              </li>
<?php endforeach; ?>
            </ul>
            <a
              class="btn btn-borde text-nowrap ms-xxl-3 mt-2 mt-xxl-0"
              href="<?= $base ?>tienda.php"
              aria-label="Ver carrito de compras"
            >
              Carrito
              <span class="badge carrito-contador" data-carrito-contador>0</span>
            </a>
<?php if (usuario_logueado()) : ?>
            <div class="dropdown ms-xxl-2 mt-2 mt-xxl-0">
              <button
                class="btn btn-borde dropdown-toggle text-nowrap<?= in_array($pagina_actual, ['cuenta', 'admin'], true) ? ' active' : '' ?>"
                type="button"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >Hola, <?= e(strtok($_SESSION['usuario_nombre'], ' ')) ?></button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="<?= $base ?>cuenta.php">Mi cuenta</a></li>
<?php if (es_admin()) : ?>
                <li><a class="dropdown-item" href="<?= $base ?>admin_panel.php">Panel de administración</a></li>
                <li><a class="dropdown-item" href="<?= $base ?>admin/index.php">Productos</a></li>
<?php endif; ?>
                <li><hr class="dropdown-divider" /></li>
                <li><a class="dropdown-item" href="<?= $base ?>logout.php">Cerrar sesión</a></li>
              </ul>
            </div>
<?php else : ?>
            <a class="btn btn-cafe text-nowrap ms-xxl-2 mt-2 mt-xxl-0" href="<?= $base ?>login.php">Ingresar</a>
<?php endif; ?>
          </div>
        </div>
      </nav>
    </header>
