<?php
$titulo_pagina = 'Galería';
$descripcion_pagina = 'Galería de diseños de arte latte realizados por los baristas de Barismo & Café.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion seccion-crema" aria-labelledby="titulo-galeria">
        <div class="container">
          <p class="eyebrow">Arte latte</p>
          <h1 class="titulo-seccion" id="titulo-galeria">Galería de Diseños</h1>
          <p class="subtitulo">Cada taza, una obra irrepetible</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row g-3">
            <div class="col-lg-6">
              <figure class="galeria-item">
                <img
                  src="img/galeria-1.jpg"
                  alt="Dos tazas con rosetas de arte latte sobre una tabla de madera"
                  width="900"
                  height="1000"
                  loading="lazy"
                />
                <figcaption>Rosetas gemelas</figcaption>
              </figure>
            </div>
            <div class="col-lg-6">
              <div class="row g-3 h-100">
                <div class="col-6">
                  <figure class="galeria-item">
                    <img
                      src="img/galeria-2.jpg"
                      alt="Manos sosteniendo tres tazas de café con arte latte"
                      width="600"
                      height="500"
                      loading="lazy"
                    />
                    <figcaption>Brindis cafetero</figcaption>
                  </figure>
                </div>
                <div class="col-6">
                  <figure class="galeria-item">
                    <img
                      src="img/galeria-3.jpg"
                      alt="Barista vertiendo leche para formar una roseta"
                      width="600"
                      height="500"
                      loading="lazy"
                    />
                    <figcaption>Vertido en vivo</figcaption>
                  </figure>
                </div>
                <div class="col-6">
                  <figure class="galeria-item">
                    <img
                      src="img/galeria-4.jpg"
                      alt="Vista cenital de varias tazas de café sobre una mesa redonda"
                      width="600"
                      height="500"
                      loading="lazy"
                    />
                    <figcaption>Degustación</figcaption>
                  </figure>
                </div>
                <div class="col-6">
                  <figure class="galeria-item">
                    <img
                      src="img/galeria-5.jpg"
                      alt="Taza de café negro vista desde arriba"
                      width="600"
                      height="500"
                      loading="lazy"
                    />
                    <figcaption>Crema perfecta</figcaption>
                  </figure>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-6 offset-md-3">
              <figure class="galeria-item">
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
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
