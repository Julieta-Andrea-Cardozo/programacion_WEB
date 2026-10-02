<?php
$titulo_pagina = 'Menú';
$descripcion_pagina = 'Menú de cafés de especialidad de Barismo & Café: espressos, bebidas con leche y cafés fríos.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-menu">
        <div class="container">
          <p class="eyebrow">Nuestro menú</p>
          <h1 class="titulo-seccion" id="titulo-menu">Cafés de Especialidad</h1>
          <p class="subtitulo">Granos seleccionados, preparación precisa</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row g-4">
            <div class="col-sm-6 col-lg-4">
              <article class="card tarjeta">
                <img
                  src="img/espresso.jpg"
                  alt="Espresso servido en vaso de vidrio"
                  width="600"
                  height="450"
                  loading="lazy"
                />
                <div class="card-body p-4">
                  <span class="etiqueta mb-3">Signature</span>
                  <h2 class="card-title h4">Espresso Clásico</h2>
                  <p class="precio mb-2">$1.800</p>
                  <p class="card-text">
                    Extracción pura de 30 ml con crema densa y aroma intenso. Origen: Etiopía
                    Yirgacheffe.
                  </p>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-4">
              <article class="card tarjeta">
                <img
                  src="img/flat-white.jpg"
                  alt="Flat white con arte latte en forma de hoja"
                  width="600"
                  height="450"
                  loading="lazy"
                />
                <div class="card-body p-4">
                  <span class="etiqueta mb-3">Popular</span>
                  <h2 class="card-title h4">Flat White</h2>
                  <p class="precio mb-2">$2.400</p>
                  <p class="card-text">
                    Doble ristretto con leche texturizada en microespuma. Equilibrio perfecto entre
                    café y lácteo.
                  </p>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-4">
              <article class="card tarjeta">
                <img
                  src="img/cold-brew.jpg"
                  alt="Vaso de cold brew con hielo"
                  width="600"
                  height="450"
                  loading="lazy"
                />
                <div class="card-body p-4">
                  <span class="etiqueta mb-3">Temporada</span>
                  <h2 class="card-title h4">Cold Brew Tónica</h2>
                  <p class="precio mb-2">$2.900</p>
                  <p class="card-text">
                    Infusión de 18 horas en frío sobre agua tónica y hielo. Refrescante y con notas
                    cítricas.
                  </p>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-4">
              <article class="card tarjeta">
                <img
                  src="img/latte.jpg"
                  alt="Latte con corazón dibujado en la espuma"
                  width="600"
                  height="450"
                  loading="lazy"
                />
                <div class="card-body p-4">
                  <span class="etiqueta mb-3">Con leche</span>
                  <h2 class="card-title h4">Latte</h2>
                  <p class="precio mb-2">$2.300</p>
                  <p class="card-text">
                    Espresso con abundante leche vaporizada y una fina capa de espuma sedosa.
                  </p>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-4">
              <article class="card tarjeta">
                <img
                  src="img/iced-latte.jpg"
                  alt="Iced latte en vaso alto con hielo"
                  width="600"
                  height="450"
                  loading="lazy"
                />
                <div class="card-body p-4">
                  <span class="etiqueta mb-3">Frío</span>
                  <h2 class="card-title h4">Iced Latte</h2>
                  <p class="precio mb-2">$2.600</p>
                  <p class="card-text">
                    Doble shot sobre leche fría y hielo. Suave, cremoso y perfecto para el verano.
                  </p>
                </div>
              </article>
            </div>
            <div class="col-sm-6 col-lg-4">
              <article class="card tarjeta">
                <img
                  src="img/americano.jpg"
                  alt="Taza de café americano sobre plato celeste"
                  width="600"
                  height="450"
                  loading="lazy"
                />
                <div class="card-body p-4">
                  <span class="etiqueta mb-3">Clásico</span>
                  <h2 class="card-title h4">Americano</h2>
                  <p class="precio mb-2">$2.000</p>
                  <p class="card-text">
                    Espresso alargado con agua caliente para resaltar las notas del grano.
                  </p>
                </div>
              </article>
            </div>
          </div>
        </div>
      </section>
      <section class="seccion seccion-crema" aria-labelledby="titulo-extras">
        <div class="container">
          <h2 class="titulo-seccion h3" id="titulo-extras">Para acompañar</h2>
          <div class="table-responsive">
            <table class="table table-borderless align-middle mb-0">
              <caption class="meta">Precios en pesos argentinos, IVA incluido.</caption>
              <thead>
                <tr>
                  <th scope="col">Producto</th>
                  <th scope="col">Descripción</th>
                  <th scope="col" class="text-end">Precio</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Medialuna de manteca</td>
                  <td>Horneada cada mañana</td>
                  <td class="text-end">$900</td>
                </tr>
                <tr>
                  <td>Budín de limón</td>
                  <td>Porción con glaseado cítrico</td>
                  <td class="text-end">$1.500</td>
                </tr>
                <tr>
                  <td>Tostado de campo</td>
                  <td>Pan de masa madre, jamón y queso</td>
                  <td class="text-end">$3.200</td>
                </tr>
                <tr>
                  <td>Leche vegetal</td>
                  <td>Avena o almendras (adicional)</td>
                  <td class="text-end">$500</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
