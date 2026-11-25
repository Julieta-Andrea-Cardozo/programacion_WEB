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
    <header class="sticky top-0 z-40 border-b border-borde/80 bg-papel/85 shadow-sm shadow-cafe/5 backdrop-blur-md">
      <nav class="contenedor flex flex-wrap items-center justify-between gap-4 py-4 xl:flex-nowrap" aria-label="Navegación principal">
        <a class="flex items-center gap-2 font-titulo text-2xl font-bold italic text-cafe hover:text-cafe" href="<?= $base ?>index.php">
          <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
            <path d="M3 9h14v5a6 6 0 0 1-6 6H9a6 6 0 0 1-6-6V9Z" />
            <path d="M17 11h1.5a2.5 2.5 0 0 1 0 5H17" />
            <path d="M7 2c0 1.5 1 1.5 1 3M11 2c0 1.5 1 1.5 1 3" stroke-linecap="round" />
          </svg>
          <?= e(APP_NAME) ?>
        </a>
        <div class="flex items-center gap-2 xl:order-last">
          <button
            class="relative inline-flex h-11 w-11 items-center justify-center rounded-full border border-borde bg-white text-cafe transition hover:border-cafe"
            type="button"
            data-carrito-abrir
            aria-controls="carrito"
            aria-label="Ver carrito de compras"
          >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
              <path d="M5 7h14l-1.5 12.5a1.5 1.5 0 0 1-1.5 1.5H8a1.5 1.5 0 0 1-1.5-1.5L5 7Z" />
              <path d="M9 10V6a3 3 0 0 1 6 0v4" stroke-linecap="round" />
            </svg>
            <span
              class="absolute -right-1 -top-1 grid h-5 min-w-5 place-items-center rounded-full bg-bordo px-1 font-mono text-[0.65rem] text-white"
              data-carrito-contador
            >0</span>
          </button>
<?php if (usuario_logueado()) : ?>
          <details class="relative" data-desplegable>
            <summary class="btn-borde btn-sm max-w-[11rem] cursor-pointer list-none truncate<?= in_array($pagina_actual, ['cuenta', 'admin'], true) ? ' bg-espresso text-white' : '' ?>">
              Hola, <?= e(strtok($_SESSION['usuario_nombre'], ' ')) ?> ▾
            </summary>
            <div class="absolute right-0 z-50 mt-2 w-60 rounded-2xl border border-borde bg-white p-2 shadow-xl">
              <a class="dropdown-item" href="<?= $base ?>cuenta.php">Mi cuenta</a>
<?php if (es_admin()) : ?>
              <a class="dropdown-item" href="<?= $base ?>admin_panel.php">Panel de administración</a>
              <a class="dropdown-item" href="<?= $base ?>admin/index.php">Productos</a>
<?php endif; ?>
              <hr class="my-2 border-borde" />
              <a class="dropdown-item" href="<?= $base ?>logout.php">Cerrar sesión</a>
            </div>
          </details>
<?php else : ?>
          <a class="btn-cafe btn-sm hidden sm:inline-flex" href="<?= $base ?>login.php">Ingresar</a>
<?php endif; ?>
          <button
            class="inline-flex h-11 w-11 items-center justify-center rounded-full border border-borde bg-white text-cafe xl:hidden"
            type="button"
            data-menu-toggle
            aria-controls="menuPrincipal"
            aria-expanded="false"
            aria-label="Abrir menú de navegación"
          >
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
              <path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round" />
            </svg>
          </button>
        </div>
        <ul class="hidden w-full flex-col gap-3 border-t border-borde pt-4 xl:flex xl:w-auto xl:flex-row xl:items-center xl:gap-4 xl:border-0 xl:pt-0" id="menuPrincipal">
<?php foreach ($paginas as $archivo => $etiqueta) : ?>
<?php $activa = $archivo === $pagina_actual; ?>
          <li>
            <a
              class="nav-link<?= $activa ? ' active' : '' ?>"
              <?= $activa ? 'aria-current="page"' : '' ?>
              href="<?= $base . $archivo ?>.php"
            ><?= e($etiqueta) ?></a>
          </li>
<?php endforeach; ?>
<?php if (!usuario_logueado()) : ?>
          <li class="sm:hidden"><a class="btn-cafe btn-sm" href="<?= $base ?>login.php">Ingresar</a></li>
<?php endif; ?>
        </ul>
      </nav>
    </header>
