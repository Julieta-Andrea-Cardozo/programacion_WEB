<?php
$titulo_pagina = 'Equipo';
$descripcion_pagina = 'Conocé al equipo de baristas de Barismo & Café.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-equipo">
        <div class="container">
          <p class="eyebrow">El equipo</p>
          <h1 class="titulo-seccion" id="titulo-equipo">Nuestros Baristas</h1>
          <p class="subtitulo">Pasión, técnica y años de oficio</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row g-4">
            <div class="col-md-4">
              <article class="barista">
                <img
                  src="img/barista-1.jpg"
                  alt="Barista preparando café de filtro con pava de cuello de cisne"
                  width="600"
                  height="750"
                  loading="lazy"
                />
                <h2 class="h4 mt-3 mb-1">Sofía Reyes</h2>
                <p class="rol mb-2">Head Barista &amp; Campeona Nacional 2024</p>
                <p>
                  Diez años detrás de la barra. Lidera el equipo y diseña la carta de temporada.
                </p>
              </article>
            </div>
            <div class="col-md-4">
              <article class="barista">
                <img
                  src="img/barista-2.jpg"
                  alt="Barista atendiendo a una clienta en el mostrador"
                  width="600"
                  height="750"
                  loading="lazy"
                />
                <h2 class="h4 mt-3 mb-1">Mateo Villalba</h2>
                <p class="rol mb-2">Especialista en Arte Latte &amp; Extracción</p>
                <p>
                  Responsable de los talleres de arte latte. Su diseño insignia es el cisne doble.
                </p>
              </article>
            </div>
            <div class="col-md-4">
              <article class="barista">
                <img
                  src="img/barista-3.jpg"
                  alt="Portafiltros con café molido y granos sobre la mesa"
                  width="600"
                  height="750"
                  loading="lazy"
                />
                <h2 class="h4 mt-3 mb-1">Lucía Fontana</h2>
                <p class="rol mb-2">Tostadora &amp; Catadora Certificada Q-Grader</p>
                <p>Selecciona los orígenes y define los perfiles de tueste de cada lote.</p>
              </article>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
