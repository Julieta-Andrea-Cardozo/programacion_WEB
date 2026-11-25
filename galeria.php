<?php
$titulo_pagina = 'Galería';
$descripcion_pagina = 'Galería de diseños de arte latte realizados por los baristas de Barismo & Café.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';

$fotos = [
    ['galeria-2.jpg', 'Manos sosteniendo tres tazas de café con arte latte', 'Brindis cafetero'],
    ['galeria-3.jpg', 'Barista vertiendo leche para formar una roseta', 'Vertido en vivo'],
    ['galeria-4.jpg', 'Vista cenital de varias tazas de café sobre una mesa redonda', 'Degustación'],
    ['galeria-5.jpg', 'Taza de café negro vista desde arriba', 'Crema perfecta'],
];
?>
    <main id="contenido">
      <section class="seccion bg-crema" aria-labelledby="titulo-galeria">
        <div class="contenedor">
          <p class="eyebrow">Arte latte</p>
          <h1 class="titulo-seccion" id="titulo-galeria">Galería de Diseños</h1>
          <p class="subtitulo">Cada taza, una obra irrepetible</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="grid gap-4 lg:grid-cols-2">
            <figure class="galeria-item min-h-[24rem]">
              <img
                src="img/galeria-1.jpg"
                alt="Dos tazas con rosetas de arte latte sobre una tabla de madera"
                width="900"
                height="1000"
                loading="lazy"
              />
              <figcaption>Rosetas gemelas</figcaption>
            </figure>
            <div class="grid grid-cols-2 gap-4">
<?php foreach ($fotos as [$img, $alt, $titulo]) : ?>
              <figure class="galeria-item aspect-[6/5]">
                <img src="img/<?= e($img) ?>" alt="<?= e($alt) ?>" width="600" height="500" loading="lazy" />
                <figcaption><?= e($titulo) ?></figcaption>
              </figure>
<?php endforeach; ?>
            </div>
            <figure class="galeria-item aspect-[6/5] lg:col-span-2 lg:mx-auto lg:w-1/2">
              <img
                src="img/galeria-6.jpg"
                alt="Herramientas de barista con café molido y taza con corazón"
                width="600"
                height="500"
                loading="lazy"
              />
              <figcaption>Herramientas</figcaption>
            </figure>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
