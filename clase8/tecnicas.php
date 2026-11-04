<?php
$titulo_pagina = 'Técnicas';
$descripcion_pagina = 'Técnicas de arte latte paso a paso: corazón, tulipán y rosetta.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-tecnicas">
        <div class="container">
          <p class="eyebrow">Arte latte</p>
          <h1 class="titulo-seccion" id="titulo-tecnicas">Técnicas de Diseño</h1>
          <p class="subtitulo">Paso a paso para crear arte en tu taza</p>
          <div class="divisor" aria-hidden="true"></div>
          <ul class="nav nav-pills nav-tecnicas mb-4 gap-2" role="tablist">
            <li class="nav-item" role="presentation">
              <button
                class="nav-link active"
                id="tab-corazon"
                data-bs-toggle="pill"
                data-bs-target="#panel-corazon"
                type="button"
                role="tab"
                aria-controls="panel-corazon"
                aria-selected="true"
              >
                Corazón
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="tab-tulipan"
                data-bs-toggle="pill"
                data-bs-target="#panel-tulipan"
                type="button"
                role="tab"
                aria-controls="panel-tulipan"
                aria-selected="false"
              >
                Tulipán
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button
                class="nav-link"
                id="tab-rosetta"
                data-bs-toggle="pill"
                data-bs-target="#panel-rosetta"
                type="button"
                role="tab"
                aria-controls="panel-rosetta"
                aria-selected="false"
              >
                Rosetta
              </button>
            </li>
          </ul>
          <div class="tab-content">
            <div
              class="tab-pane fade show active"
              id="panel-corazon"
              role="tabpanel"
              aria-labelledby="tab-corazon"
              tabindex="0"
            >
              <div class="tarjeta p-4">
                <div class="row g-4">
                  <div class="col-lg-6">
                    <img
                      src="img/tecnica-corazon.jpg"
                      alt="Taza de latte con un corazón dibujado en la espuma"
                      width="700"
                      height="600"
                      class="img-fluid"
                      loading="lazy"
                    />
                  </div>
                  <div class="col-lg-6">
                    <span class="etiqueta etiqueta-bordo">Principiante</span>
                    <h2 class="h3 mt-2">Corazón</h2>
                    <p class="subtitulo">
                      El primer diseño que aprende todo barista. Se basa en un vertido constante y
                      un corte final al centro.
                    </p>
                    <h3 class="eyebrow mt-4">Pasos</h3>
                    <ol class="pasos">
                      <li>Preparar un espresso doble en taza precalentada.</li>
                      <li>Texturizar la leche a 60–65 °C con microespuma fina.</li>
                      <li>Verter desde altura hasta llenar la mitad de la taza.</li>
                      <li>
                        Acercar la jarra, dejar que se forme un círculo y cortar hacia adelante.
                      </li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="tab-pane fade"
              id="panel-tulipan"
              role="tabpanel"
              aria-labelledby="tab-tulipan"
              tabindex="0"
            >
              <div class="tarjeta p-4">
                <div class="row g-4">
                  <div class="col-lg-6">
                    <img
                      src="img/tecnica-tulipan.jpg"
                      alt="Dos tazas con diseños de arte latte vistas desde arriba"
                      width="700"
                      height="600"
                      class="img-fluid"
                      loading="lazy"
                    />
                  </div>
                  <div class="col-lg-6">
                    <span class="etiqueta etiqueta-bordo">Intermedio</span>
                    <h2 class="h3 mt-2">Tulipán</h2>
                    <p class="subtitulo">
                      Capas de pequeños corazones apilados que forman la flor. Requiere control del
                      flujo y pausas precisas.
                    </p>
                    <h3 class="eyebrow mt-4">Pasos</h3>
                    <ol class="pasos">
                      <li>Llenar la taza hasta la mitad con vertido alto.</li>
                      <li>Bajar la jarra y depositar un primer círculo.</li>
                      <li>Empujar suavemente para crear capas sucesivas.</li>
                      <li>Terminar con un corte fino que una todas las capas.</li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
            <div
              class="tab-pane fade"
              id="panel-rosetta"
              role="tabpanel"
              aria-labelledby="tab-rosetta"
              tabindex="0"
            >
              <div class="tarjeta p-4">
                <div class="row g-4">
                  <div class="col-lg-6">
                    <img
                      src="img/tecnica-rosetta.jpg"
                      alt="Barista vertiendo leche y formando una roseta en una taza"
                      width="700"
                      height="600"
                      class="img-fluid"
                      loading="lazy"
                    />
                  </div>
                  <div class="col-lg-6">
                    <span class="etiqueta etiqueta-bordo">Avanzado</span>
                    <h2 class="h3 mt-2">Rosetta</h2>
                    <p class="subtitulo">
                      El diseño más icónico del arte latte. Requiere control del flujo y
                      sincronización del movimiento lateral.
                    </p>
                    <h3 class="eyebrow mt-4">Pasos</h3>
                    <ol class="pasos">
                      <li>Preparar el espresso en taza precalentada.</li>
                      <li>Texturizar la leche a 65 °C hasta obtener microespuma sedosa.</li>
                      <li>Verter desde el centro con movimiento lateral rítmico.</li>
                      <li>
                        Al llegar al borde, hacer un corte hacia adelante para formar las hojas.
                      </li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
