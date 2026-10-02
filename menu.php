<?php
$titulo_pagina = 'Menú';
$descripcion_pagina = 'Menú de cafés de especialidad de Barismo & Café: espressos, bebidas con leche y cafés fríos.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
require_once __DIR__ . '/data/catalogo.php';
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-menu">
        <div class="container">
          <p class="eyebrow">Nuestro menú</p>
          <h1 class="titulo-seccion" id="titulo-menu">Cafés de Especialidad</h1>
          <p class="subtitulo">Granos seleccionados, preparación precisa</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row g-4">
<?php foreach ($bebidas as $bebida) : ?>
            <div class="col-sm-6 col-lg-4">
              <article class="card tarjeta">
                <img
                  src="img/<?= e($bebida['img']) ?>"
                  alt="<?= e($bebida['alt']) ?>"
                  width="600"
                  height="450"
                  loading="lazy"
                />
                <div class="card-body p-4">
                  <span class="etiqueta mb-3"><?= e($bebida['etiqueta']) ?></span>
                  <h2 class="card-title h4"><?= e($bebida['nombre']) ?></h2>
                  <p class="precio mb-2"><?= precio($bebida['precio']) ?></p>
                  <p class="card-text"><?= e($bebida['descripcion']) ?></p>
                </div>
              </article>
            </div>
<?php endforeach; ?>
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
