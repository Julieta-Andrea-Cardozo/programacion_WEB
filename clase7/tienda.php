<?php
$titulo_pagina = 'Tienda';
$descripcion_pagina = 'Tienda online de Barismo & Café: café en grano de especialidad e insumos para cafetera.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
require_once __DIR__ . '/data/catalogo.php';

// Búsqueda por GET: sanitiza la entrada y valida antes de filtrar el catálogo.
$tipos = ['todo' => 'Todo', 'granos' => 'Café en grano', 'insumos' => 'Insumos'];
$busqueda = trim((string) (filter_input(INPUT_GET, 'q') ?? ''));
$tipo = (string) (filter_input(INPUT_GET, 'tipo') ?? 'todo');
if (!array_key_exists($tipo, $tipos)) {
    $tipo = 'todo';
}

$busco = isset($_GET['q']);
$error_busqueda = '';
$aviso = '';

if ($busco) {
    if ($busqueda === '') {
        $error_busqueda = 'Escribí qué producto querés buscar.';
    } elseif (largo($busqueda) > 60) {
        $error_busqueda = 'La búsqueda es muy larga (máximo 60 caracteres).';
    }
}

if ($busco && $error_busqueda === '') {
    $contiene = function (array $producto) use ($busqueda): bool {
        $texto = $producto['nombre'] . ' ' . $producto['notas'] . ' ' . $producto['meta'];
        return function_exists('mb_stripos')
            ? mb_stripos($texto, $busqueda, 0, 'UTF-8') !== false
            : stripos($texto, $busqueda) !== false;
    };
    $granos = $tipo !== 'insumos' ? array_values(array_filter($granos, $contiene)) : [];
    $insumos = $tipo !== 'granos' ? array_values(array_filter($insumos, $contiene)) : [];
    $total = count($granos) + count($insumos);
    $aviso = $total
        ? "Encontramos {$total} producto(s) para «{$busqueda}»."
        : "No encontramos productos para «{$busqueda}». Probá con otra palabra.";
}
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-granos">
        <div class="container">
          <p class="eyebrow">Tienda</p>
          <h1 class="titulo-seccion" id="titulo-granos">Café en Grano</h1>
          <p class="subtitulo">Orígenes seleccionados, tostado artesanal</p>
          <div class="divisor" aria-hidden="true"></div>
          <form
            class="taller form-barismo p-4 mb-4"
            id="form-busqueda"
            method="get"
            action="tienda.php"
            role="search"
          >
            <div class="row g-3 align-items-end">
              <div class="col-md-7">
                <label class="form-label" for="q">Buscar en la tienda</label>
                <input
                  class="form-control<?= $error_busqueda ? ' is-invalid' : '' ?>"
                  type="search"
                  id="q"
                  name="q"
                  value="<?= e($busqueda) ?>"
                  placeholder="Ej: colombia, molino, chocolate..."
                  maxlength="60"
                  required
                />
                <div class="invalid-feedback">
                  <?= e($error_busqueda ?: 'Escribí qué producto querés buscar.') ?>
                </div>
              </div>
              <div class="col-md-3">
                <label class="form-label" for="tipo">Categoría</label>
                <select class="form-select" id="tipo" name="tipo">
<?php foreach ($tipos as $valor => $texto) : ?>
                  <option value="<?= e($valor) ?>"<?= $valor === $tipo ? ' selected' : '' ?>><?= e($texto) ?></option>
<?php endforeach; ?>
                </select>
              </div>
              <div class="col-md-2">
                <button class="btn btn-cafe w-100" type="submit">Buscar</button>
              </div>
            </div>
          </form>
<?php if ($error_busqueda) : ?>
          <div class="alert alert-danger" role="alert"><?= e($error_busqueda) ?></div>
<?php elseif ($aviso) : ?>
          <div
            class="alert <?= count($granos) + count($insumos) ? 'alert-success' : 'alert-warning' ?>"
            role="status"
          >
            <?= e($aviso) ?>
          </div>
<?php endif; ?>
          <div class="row g-4">
<?php $nivel_titulo = 'h2'; ?>
<?php foreach ($granos as $producto) : ?>
<?php require __DIR__ . '/includes/producto.php'; ?>
<?php endforeach; ?>
          </div>
        </div>
      </section>
<?php if (!$busco || $tipo !== 'granos') : ?>
      <section class="seccion seccion-crema" aria-labelledby="titulo-insumos">
        <div class="container">
          <p class="eyebrow">Tienda</p>
          <h2 class="titulo-seccion" id="titulo-insumos">Insumos para Cafetera</h2>
          <p class="subtitulo">Todo lo que necesitás para preparar en casa</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row g-4">
<?php $nivel_titulo = 'h3'; ?>
<?php foreach ($insumos as $producto) : ?>
<?php require __DIR__ . '/includes/producto.php'; ?>
<?php endforeach; ?>
          </div>
          <div
            class="alert alert-light border mt-4 mb-0"
            role="status"
            aria-live="polite"
            data-carrito-mensaje
          >
            Tu carrito está vacío.
          </div>
        </div>
      </section>
<?php endif; ?>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
