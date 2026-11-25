<?php
$titulo_pagina = 'Talleres';
$descripcion_pagina = 'Talleres de barismo y arte latte para principiantes y avanzados en Barismo & Café.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';

$talleres = [
    ['Principiante', false, 'Sábado 26 sep · 10:00 hs', 'Introducción al Barismo', 'Fundamentos de extracción, molienda y diferencias entre métodos de preparación.', '$8.500'],
    ['Avanzado', true, 'Domingo 6 oct · 11:00 hs', 'Arte Latte Avanzado', 'Técnicas de vertido para crear rosetas, tulipanes y diseños libres en espuma.', '$12.000'],
    ['Todos los niveles', false, 'Sábado 19 oct · 15:00 hs', 'Cata y Orígenes del Café', 'Aprendé a identificar perfiles de sabor según origen, proceso y tueste.', '$9.000'],
];
$incluye = [
    ['Práctica en barra', 'Cada alumno trabaja con una máquina de espresso profesional.'],
    ['Material de estudio', 'Guía digital con recetas, ratios y tablas de extracción.'],
    ['Certificado', 'Constancia de asistencia firmada por el equipo de Barismo.'],
];
?>
    <main id="contenido">
      <section class="seccion bg-crema" aria-labelledby="titulo-talleres">
        <div class="contenedor">
          <p class="eyebrow">Formación</p>
          <h1 class="titulo-seccion" id="titulo-talleres">Talleres de Barismo</h1>
          <p class="subtitulo">Aprendé de los mejores</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="mx-auto max-w-5xl space-y-4">
<?php foreach ($talleres as [$nivel, $destacado, $fecha, $nombre, $detalle, $costo]) : ?>
            <article class="flex flex-col gap-4 rounded-3xl border border-borde bg-white p-6 shadow-sm transition hover:shadow-lg md:flex-row md:items-center md:justify-between">
              <div>
                <p class="mb-2 flex flex-wrap items-center gap-2">
                  <span class="etiqueta<?= $destacado ? ' etiqueta-bordo' : '' ?>"><?= e($nivel) ?></span>
                  <span class="meta"><?= e($fecha) ?></span>
                </p>
                <h2 class="mb-1 text-2xl font-bold"><?= e($nombre) ?></h2>
                <p class="mb-0 text-suave"><?= e($detalle) ?></p>
              </div>
              <div class="flex items-center gap-4 md:flex-col md:items-end">
                <p class="precio mb-0"><?= e($costo) ?></p>
                <a class="btn-cafe btn-sm" href="contacto.php" aria-label="Inscribirse al taller <?= e($nombre) ?>">Inscribirse →</a>
              </div>
            </article>
<?php endforeach; ?>
          </div>
        </div>
      </section>
      <section class="seccion" aria-labelledby="titulo-incluye">
        <div class="contenedor">
          <h2 class="titulo-seccion text-3xl md:text-4xl" id="titulo-incluye">¿Qué incluye cada taller?</h2>
          <div class="mt-8 grid gap-6 md:grid-cols-3">
<?php foreach ($incluye as [$titulo, $texto]) : ?>
            <div class="tarjeta p-6">
              <h3 class="mb-2 text-xl font-bold"><?= e($titulo) ?></h3>
              <p class="mb-0 text-suave"><?= e($texto) ?></p>
            </div>
<?php endforeach; ?>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
