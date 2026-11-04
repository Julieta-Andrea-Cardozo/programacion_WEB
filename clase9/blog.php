<?php
$titulo_pagina = 'Blog';
$descripcion_pagina = 'Blog de Barismo & Café: notas sobre técnica, orígenes y métodos de preparación de café.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-blog">
        <div class="container">
          <p class="eyebrow">Blog</p>
          <h1 class="titulo-seccion" id="titulo-blog">Notas Destacadas</h1>
          <p class="subtitulo">Cultura, técnica y pasión por el café</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row g-4">
            <div class="col-md-6 col-lg-4">
              <article class="card tarjeta">
                <img
                  src="img/blog-1.jpg"
                  alt="Tazas de café con arte latte entre plantas"
                  width="700"
                  height="450"
                  loading="lazy"
                />
                <div class="card-body p-4">
                  <p class="mb-2">
                    <span class="etiqueta etiqueta-bordo">Técnica</span>
                    <time class="meta ms-2">3 sep 2026</time>
                  </p>
                  <h2 class="card-title h5">
                    Por qué la temperatura del agua cambia todo en el espresso
                  </h2>
                  <p class="card-text">
                    La diferencia entre 88 °C y 94 °C puede ser la línea entre una extracción
                    brillante y un café amargo.
                  </p>
                  <div class="collapse" id="nota-1">
                    <p>
                      Una temperatura baja sub-extrae los compuestos ácidos y deja un café plano;
                      una muy alta extrae taninos amargos. En nuestra barra trabajamos entre 92 °C y
                      93 °C para cafés de tueste medio y ajustamos un grado según el origen.
                    </p>
                  </div>
                  <button
                    class="btn btn-borde"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#nota-1"
                    aria-expanded="false"
                    aria-controls="nota-1"
                  >
                    Leer nota →
                  </button>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-lg-4">
              <article class="card tarjeta">
                <img
                  src="img/blog-2.jpg"
                  alt="Taza de café sobre plato celeste"
                  width="700"
                  height="450"
                  loading="lazy"
                />
                <div class="card-body p-4">
                  <p class="mb-2">
                    <span class="etiqueta etiqueta-bordo">Orígenes</span>
                    <time class="meta ms-2">20 ago 2026</time>
                  </p>
                  <h2 class="card-title h5">
                    Etiopía natural: el café que sabe a frambuesa y miel
                  </h2>
                  <p class="card-text">
                    Los cafés de proceso natural de Guji tienen perfiles de sabor únicos. Te
                    contamos cómo se producen.
                  </p>
                  <div class="collapse" id="nota-2">
                    <p>
                      En el proceso natural la cereza se seca entera al sol durante semanas. Los
                      azúcares de la fruta migran al grano y aportan notas a frutos rojos, miel y
                      vino. Es un proceso lento que requiere mucho cuidado para evitar
                      fermentaciones indeseadas.
                    </p>
                  </div>
                  <button
                    class="btn btn-borde"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#nota-2"
                    aria-expanded="false"
                    aria-controls="nota-2"
                  >
                    Leer nota →
                  </button>
                </div>
              </article>
            </div>
            <div class="col-md-6 col-lg-4">
              <article class="card tarjeta">
                <img
                  src="img/blog-3.jpg"
                  alt="Barista preparando café de filtro"
                  width="700"
                  height="450"
                  loading="lazy"
                />
                <div class="card-body p-4">
                  <p class="mb-2">
                    <span class="etiqueta etiqueta-bordo">Métodos</span>
                    <time class="meta ms-2">5 ago 2026</time>
                  </p>
                  <h2 class="card-title h5">V60, Chemex o prensa francesa: ¿cuál elegir?</h2>
                  <p class="card-text">
                    Cada método de filtrado resalta características distintas del café. Una guía
                    rápida para elegir el tuyo.
                  </p>
                  <div class="collapse" id="nota-3">
                    <p>
                      La V60 da tazas limpias y brillantes, la Chemex aporta un cuerpo más ligero
                      por su filtro grueso y la prensa francesa ofrece más cuerpo y aceites.
                      Recomendamos empezar con una relación 1:16 y ajustar según tu gusto.
                    </p>
                  </div>
                  <button
                    class="btn btn-borde"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#nota-3"
                    aria-expanded="false"
                    aria-controls="nota-3"
                  >
                    Leer nota →
                  </button>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
