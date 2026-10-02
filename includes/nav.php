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

$pagina_actual = basename($_SERVER['SCRIPT_NAME'], '.php');
?>
    <header>
      <nav class="navbar navbar-expand-xl navbar-barismo sticky-top" aria-label="Navegación principal">
        <div class="container">
          <a class="navbar-brand" href="index.php"><?= e(APP_NAME) ?></a>
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
            <ul class="navbar-nav ms-auto gap-xl-2">
<?php foreach ($paginas as $archivo => $etiqueta) : ?>
<?php $activa = $archivo === $pagina_actual; ?>
              <li class="nav-item">
                <a
                  class="nav-link<?= $activa ? ' active' : '' ?>"
                  <?= $activa ? 'aria-current="page"' : '' ?>
                  href="<?= $archivo ?>.php"
                ><?= e($etiqueta) ?></a>
              </li>
<?php endforeach; ?>
            </ul>
            <a
              class="btn btn-borde text-nowrap ms-xl-3 mt-2 mt-xl-0"
              href="tienda.php"
              aria-label="Ver carrito de compras"
            >
              Carrito
              <span class="badge carrito-contador" data-carrito-contador>0</span>
            </a>
          </div>
        </div>
      </nav>
    </header>
