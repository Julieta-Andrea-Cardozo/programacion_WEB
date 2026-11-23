<?php
$titulo_pagina = 'Menú';
$descripcion_pagina = 'Menú de cafés de especialidad de Barismo & Café: espressos, bebidas con leche y cafés fríos.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
require_once __DIR__ . '/data/catalogo.php';
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-menu">
        <div class="contenedor">
          <p class="eyebrow">Nuestro menú</p>
          <h1 class="titulo-seccion" id="titulo-menu">Cafés de Especialidad</h1>
          <p class="subtitulo">Granos seleccionados, preparación precisa</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
<?php foreach ($bebidas as $bebida) : ?>
            <article class="tarjeta">
              <img
                class="tarjeta-img"
                src="img/<?= e($bebida['img']) ?>"
                alt="<?= e($bebida['alt']) ?>"
                width="600"
                height="450"
                loading="lazy"
              />
              <div class="flex flex-1 flex-col p-6">
                <div class="mb-3 flex items-center justify-between">
                  <span class="etiqueta"><?= e($bebida['etiqueta']) ?></span>
                  <span class="precio"><?= precio($bebida['precio']) ?></span>
                </div>
                <h2 class="mb-2 text-2xl font-bold"><?= e($bebida['nombre']) ?></h2>
                <p class="text-suave"><?= e($bebida['descripcion']) ?></p>
              </div>
            </article>
<?php endforeach; ?>
          </div>
        </div>
      </section>
      <section class="seccion bg-crema" aria-labelledby="titulo-extras">
        <div class="contenedor max-w-4xl">
          <p class="eyebrow">Pastelería</p>
          <h2 class="titulo-seccion text-3xl md:text-4xl" id="titulo-extras">Para acompañar</h2>
          <div class="divisor" aria-hidden="true"></div>
          <div class="overflow-x-auto rounded-3xl border border-borde bg-white p-2 shadow-sm">
            <table class="tabla">
              <caption class="meta caption-bottom p-3">Precios en pesos argentinos, IVA incluido.</caption>
              <thead>
                <tr>
                  <th scope="col">Producto</th>
                  <th scope="col">Descripción</th>
                  <th scope="col" class="text-right">Precio</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="font-semibold">Medialuna de manteca</td>
                  <td class="text-suave">Horneada cada mañana</td>
                  <td class="text-right font-titulo font-bold">$900</td>
                </tr>
                <tr>
                  <td class="font-semibold">Budín de limón</td>
                  <td class="text-suave">Porción con glaseado cítrico</td>
                  <td class="text-right font-titulo font-bold">$1.500</td>
                </tr>
                <tr>
                  <td class="font-semibold">Tostado de campo</td>
                  <td class="text-suave">Pan de masa madre, jamón y queso</td>
                  <td class="text-right font-titulo font-bold">$3.200</td>
                </tr>
                <tr>
                  <td class="font-semibold">Leche vegetal</td>
                  <td class="text-suave">Avena o almendras (adicional)</td>
                  <td class="text-right font-titulo font-bold">$500</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
