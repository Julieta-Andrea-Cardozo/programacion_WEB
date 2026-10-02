<?php
$titulo_pagina = 'Tienda';
$descripcion_pagina = 'Tienda online de Barismo & Café: café en grano de especialidad e insumos para cafetera.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-granos">
        <div class="container">
          <p class="eyebrow">Tienda</p>
          <h1 class="titulo-seccion" id="titulo-granos">Café en Grano</h1>
          <p class="subtitulo">Orígenes seleccionados, tostado artesanal</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row g-4">
            <div class="col-sm-6 col-lg-3">
              <article class="card tarjeta">
                <img
                  src="img/grano-etiopia.jpg"
                  alt="Granos de café en una lata"
                  width="500"
                  height="500"
                  loading="lazy"
                />
                <div class="card-body p-3 d-flex flex-column">
                  <p class="meta mb-1">África · Lavado · 250 g</p>
                  <h2 class="card-title h5 mb-1">Ethiopia Yirgacheffe</h2>
                  <p class="estrellas mb-1" aria-label="5 de 5 estrellas">★★★★★</p>
                  <p class="small fst-italic">Jazmín · Durazno · Limón</p>
                  <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="precio fs-4">$4.200</span>
                    <button
                      class="btn btn-borde btn-sm"
                      type="button"
                      data-agregar="Ethiopia Yirgacheffe"
                      aria-label="Agregar Ethiopia Yirgacheffe al carrito"
                    >
                      Agregar
                    </button>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-3">
              <article class="card tarjeta">
                <img
                  src="img/grano-colombia.jpg"
                  alt="Granos de café tostado"
                  width="500"
                  height="500"
                  loading="lazy"
                />
                <div class="card-body p-3 d-flex flex-column">
                  <p class="meta mb-1">América · Natural · 250 g</p>
                  <h2 class="card-title h5 mb-1">Colombia Huila</h2>
                  <p class="estrellas mb-1" aria-label="5 de 5 estrellas">★★★★★</p>
                  <p class="small fst-italic">Caramelo · Uva · Chocolate</p>
                  <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="precio fs-4">$3.800</span>
                    <button
                      class="btn btn-borde btn-sm"
                      type="button"
                      data-agregar="Colombia Huila"
                      aria-label="Agregar Colombia Huila al carrito"
                    >
                      Agregar
                    </button>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-3">
              <article class="card tarjeta">
                <img
                  src="img/grano-guatemala.jpg"
                  alt="Bolsa de arpillera llena de granos de café"
                  width="500"
                  height="500"
                  loading="lazy"
                />
                <div class="card-body p-3 d-flex flex-column">
                  <p class="meta mb-1">América · Honey · 250 g</p>
                  <h2 class="card-title h5 mb-1">Guatemala Antigua</h2>
                  <p class="estrellas mb-1" aria-label="4 de 5 estrellas">★★★★☆</p>
                  <p class="small fst-italic">Nuez · Canela · Miel</p>
                  <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="precio fs-4">$3.400</span>
                    <button
                      class="btn btn-borde btn-sm"
                      type="button"
                      data-agregar="Guatemala Antigua"
                      aria-label="Agregar Guatemala Antigua al carrito"
                    >
                      Agregar
                    </button>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-3">
              <article class="card tarjeta">
                <img
                  src="img/grano-brasil.jpg"
                  alt="Granos de café tostado de cerca"
                  width="500"
                  height="500"
                  loading="lazy"
                />
                <div class="card-body p-3 d-flex flex-column">
                  <p class="meta mb-1">América · Natural · 250 g</p>
                  <h2 class="card-title h5 mb-1">Brasil Cerrado</h2>
                  <p class="estrellas mb-1" aria-label="4 de 5 estrellas">★★★★☆</p>
                  <p class="small fst-italic">Chocolate · Avellana · Bajo</p>
                  <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="precio fs-4">$2.900</span>
                    <button
                      class="btn btn-borde btn-sm"
                      type="button"
                      data-agregar="Brasil Cerrado"
                      aria-label="Agregar Brasil Cerrado al carrito"
                    >
                      Agregar
                    </button>
                  </div>
                </div>
              </article>
            </div>
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
            <div class="col-sm-6 col-lg-3">
              <article class="card tarjeta">
                <img
                  src="img/insumo-molino.jpg"
                  alt="Molino de café eléctrico sobre la mesada"
                  width="500"
                  height="500"
                  loading="lazy"
                />
                <div class="card-body p-3 d-flex flex-column">
                  <p class="meta mb-1">Molienda</p>
                  <h3 class="card-title h5 mb-1">Molino de Disco Cerámico</h3>
                  <p class="estrellas mb-1" aria-label="5 de 5 estrellas">★★★★★</p>
                  <p class="small fst-italic">40 graduaciones, ideal para espresso y filtrado</p>
                  <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="precio fs-4">$38.000</span>
                    <button
                      class="btn btn-borde btn-sm"
                      type="button"
                      data-agregar="Molino de Disco Cerámico"
                      aria-label="Agregar Molino de Disco Cerámico al carrito"
                    >
                      Agregar
                    </button>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-3">
              <article class="card tarjeta">
                <img
                  src="img/insumo-kit.jpg"
                  alt="Kit de barista con tamper, café molido y taza"
                  width="500"
                  height="500"
                  loading="lazy"
                />
                <div class="card-body p-3 d-flex flex-column">
                  <p class="meta mb-1">Accesorios</p>
                  <h3 class="card-title h5 mb-1">Kit Barista Inicial</h3>
                  <p class="estrellas mb-1" aria-label="4 de 5 estrellas">★★★★☆</p>
                  <p class="small fst-italic">Tamper, jarra y tabla de golpes</p>
                  <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="precio fs-4">$12.500</span>
                    <button
                      class="btn btn-borde btn-sm"
                      type="button"
                      data-agregar="Kit Barista Inicial"
                      aria-label="Agregar Kit Barista Inicial al carrito"
                    >
                      Agregar
                    </button>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-3">
              <article class="card tarjeta">
                <img
                  src="img/insumo-portafiltro.jpg"
                  alt="Portafiltros con café molido y granos"
                  width="500"
                  height="500"
                  loading="lazy"
                />
                <div class="card-body p-3 d-flex flex-column">
                  <p class="meta mb-1">Espresso</p>
                  <h3 class="card-title h5 mb-1">Tamper 58 mm Acero</h3>
                  <p class="estrellas mb-1" aria-label="5 de 5 estrellas">★★★★★</p>
                  <p class="small fst-italic">Base plana y mango ergonómico</p>
                  <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="precio fs-4">$8.900</span>
                    <button
                      class="btn btn-borde btn-sm"
                      type="button"
                      data-agregar="Tamper 58 mm Acero"
                      aria-label="Agregar Tamper 58 mm Acero al carrito"
                    >
                      Agregar
                    </button>
                  </div>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-3">
              <article class="card tarjeta">
                <img
                  src="img/insumo-bolsa.jpg"
                  alt="Bolsa de café de especialidad"
                  width="500"
                  height="500"
                  loading="lazy"
                />
                <div class="card-body p-3 d-flex flex-column">
                  <p class="meta mb-1">Suscripción</p>
                  <h3 class="card-title h5 mb-1">Box Mensual Barismo</h3>
                  <p class="estrellas mb-1" aria-label="5 de 5 estrellas">★★★★★</p>
                  <p class="small fst-italic">Dos orígenes sorpresa por mes</p>
                  <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="precio fs-4">$7.500</span>
                    <button
                      class="btn btn-borde btn-sm"
                      type="button"
                      data-agregar="Box Mensual Barismo"
                      aria-label="Agregar Box Mensual Barismo al carrito"
                    >
                      Agregar
                    </button>
                  </div>
                </div>
              </article>
            </div>
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
