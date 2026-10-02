<?php
$titulo_pagina = 'Tienda';
$descripcion_pagina = 'Tienda online de Barismo & Café: café en grano de especialidad e insumos para cafetera.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
require_once __DIR__ . '/data/catalogo.php';
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-granos">
        <div class="container">
          <p class="eyebrow">Tienda</p>
          <h1 class="titulo-seccion" id="titulo-granos">Café en Grano</h1>
          <p class="subtitulo">Orígenes seleccionados, tostado artesanal</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row g-4">
<?php $nivel_titulo = 'h2'; ?>
<?php foreach ($granos as $producto) : ?>
<?php require __DIR__ . '/includes/producto.php'; ?>
<?php endforeach; ?>
          </div>
        </div>
      </section>
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
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
