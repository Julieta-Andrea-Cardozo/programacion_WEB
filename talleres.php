<?php
$titulo_pagina = 'Talleres';
$descripcion_pagina = 'Talleres de barismo y arte latte para principiantes y avanzados en Barismo & Café.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion seccion-crema" aria-labelledby="titulo-talleres">
        <div class="container">
          <p class="eyebrow">Formación</p>
          <h1 class="titulo-seccion" id="titulo-talleres">Talleres de Barismo</h1>
          <p class="subtitulo">Aprendé de los mejores</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row justify-content-center">
            <div class="col-lg-10">
              <article class="taller mb-3">
                <div class="row align-items-center g-3">
                  <div class="col-md-8">
                    <p class="mb-2">
                      <span class="etiqueta">Principiante</span>
                      <span class="meta ms-2">Sábado 26 sep · 10:00 hs</span>
                    </p>
                    <h2 class="h4 mb-1">Introducción al Barismo</h2>
                    <p class="mb-0">
                      Fundamentos de extracción, molienda y diferencias entre métodos de
                      preparación.
                    </p>
                  </div>
                  <div class="col-md-4 text-md-end">
                    <p class="precio mb-2">$8.500</p>
                    <a
                      class="btn btn-borde"
                      href="contacto.php"
                      aria-label="Inscribirse al taller Introducción al Barismo"
                    >
                      Inscribirse →
                    </a>
                  </div>
                </div>
              </article>
              <article class="taller mb-3">
                <div class="row align-items-center g-3">
                  <div class="col-md-8">
                    <p class="mb-2">
                      <span class="etiqueta etiqueta-bordo">Avanzado</span>
                      <span class="meta ms-2">Domingo 6 oct · 11:00 hs</span>
                    </p>
                    <h2 class="h4 mb-1">Arte Latte Avanzado</h2>
                    <p class="mb-0">
                      Técnicas de vertido para crear rosetas, tulipanes y diseños libres en espuma.
                    </p>
                  </div>
                  <div class="col-md-4 text-md-end">
                    <p class="precio mb-2">$12.000</p>
                    <a
                      class="btn btn-borde"
                      href="contacto.php"
                      aria-label="Inscribirse al taller Arte Latte Avanzado"
                    >
                      Inscribirse →
                    </a>
                  </div>
                </div>
              </article>
              <article class="taller mb-3">
                <div class="row align-items-center g-3">
                  <div class="col-md-8">
                    <p class="mb-2">
                      <span class="etiqueta">Todos los niveles</span>
                      <span class="meta ms-2">Sábado 19 oct · 15:00 hs</span>
                    </p>
                    <h2 class="h4 mb-1">Cata y Orígenes del Café</h2>
                    <p class="mb-0">
                      Aprendé a identificar perfiles de sabor según origen, proceso y tueste.
                    </p>
                  </div>
                  <div class="col-md-4 text-md-end">
                    <p class="precio mb-2">$9.000</p>
                    <a
                      class="btn btn-borde"
                      href="contacto.php"
                      aria-label="Inscribirse al taller Cata y Orígenes del Café"
                    >
                      Inscribirse →
                    </a>
                  </div>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>
      <section class="seccion" aria-labelledby="titulo-incluye">
        <div class="container">
          <h2 class="titulo-seccion h3" id="titulo-incluye">¿Qué incluye cada taller?</h2>
          <div class="row g-4 mt-2">
            <div class="col-md-4">
              <div class="card tarjeta p-4">
                <h3 class="h5">Práctica en barra</h3>
                <p class="mb-0">Cada alumno trabaja con una máquina de espresso profesional.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card tarjeta p-4">
                <h3 class="h5">Material de estudio</h3>
                <p class="mb-0">Guía digital con recetas, ratios y tablas de extracción.</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card tarjeta p-4">
                <h3 class="h5">Certificado</h3>
                <p class="mb-0">Constancia de asistencia firmada por el equipo de Barismo.</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
