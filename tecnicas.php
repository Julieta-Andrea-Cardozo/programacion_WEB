<?php
$titulo_pagina = 'Técnicas';
$descripcion_pagina = 'Técnicas de arte latte paso a paso: corazón, tulipán y rosetta.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';

$tecnicas = [
    'corazon' => ['Corazón', 'Principiante', 'tecnica-corazon.jpg', 'Taza de latte con un corazón dibujado en la espuma', 'El primer diseño que aprende todo barista. Se basa en un vertido constante y un corte final al centro.', ['Preparar un espresso doble en taza precalentada.', 'Texturizar la leche a 60–65 °C con microespuma fina.', 'Verter desde altura hasta llenar la mitad de la taza.', 'Acercar la jarra, dejar que se forme un círculo y cortar hacia adelante.']],
    'tulipan' => ['Tulipán', 'Intermedio', 'tecnica-tulipan.jpg', 'Dos tazas con diseños de arte latte vistas desde arriba', 'Capas de pequeños corazones apilados que forman la flor. Requiere control del flujo y pausas precisas.', ['Llenar la taza hasta la mitad con vertido alto.', 'Bajar la jarra y depositar un primer círculo.', 'Empujar suavemente para crear capas sucesivas.', 'Terminar con un corte fino que una todas las capas.']],
    'rosetta' => ['Rosetta', 'Avanzado', 'tecnica-rosetta.jpg', 'Barista vertiendo leche y formando una roseta en una taza', 'El diseño más icónico del arte latte. Requiere control del flujo y sincronización del movimiento lateral.', ['Preparar el espresso en taza precalentada.', 'Texturizar la leche a 65 °C hasta obtener microespuma sedosa.', 'Verter desde el centro con movimiento lateral rítmico.', 'Al llegar al borde, hacer un corte hacia adelante para formar las hojas.']],
];
$primera = array_key_first($tecnicas);
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-tecnicas">
        <div class="contenedor" data-tabs>
          <p class="eyebrow">Arte latte</p>
          <h1 class="titulo-seccion" id="titulo-tecnicas">Técnicas de Diseño</h1>
          <p class="subtitulo">Paso a paso para crear arte en tu taza</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="mb-6 flex flex-wrap gap-2" role="tablist">
<?php foreach ($tecnicas as $clave => $t) : ?>
            <button
              class="tab-boton"
              id="tab-<?= $clave ?>"
              type="button"
              role="tab"
              aria-controls="panel-<?= $clave ?>"
              aria-selected="<?= $clave === $primera ? 'true' : 'false' ?>"
              tabindex="<?= $clave === $primera ? '0' : '-1' ?>"
            ><?= e($t[0]) ?></button>
<?php endforeach; ?>
          </div>
<?php foreach ($tecnicas as $clave => [$nombre, $nivel, $img, $alt, $intro, $pasos]) : ?>
          <div
            class="grid gap-8 rounded-[2rem] border border-borde bg-white p-6 shadow-sm lg:grid-cols-2 lg:p-8"
            id="panel-<?= $clave ?>"
            role="tabpanel"
            aria-labelledby="tab-<?= $clave ?>"
            tabindex="0"
            <?= $clave === $primera ? '' : 'hidden' ?>
          >
            <img class="aspect-[7/6] w-full rounded-3xl object-cover" src="img/<?= e($img) ?>" alt="<?= e($alt) ?>" width="700" height="600" loading="lazy" />
            <div>
              <span class="etiqueta etiqueta-bordo"><?= e($nivel) ?></span>
              <h2 class="mb-2 mt-3 text-4xl font-black"><?= e($nombre) ?></h2>
              <p class="subtitulo"><?= e($intro) ?></p>
              <h3 class="eyebrow mt-6">Pasos</h3>
              <ol class="pasos">
<?php foreach ($pasos as $paso) : ?>
                <li><?= e($paso) ?></li>
<?php endforeach; ?>
              </ol>
            </div>
          </div>
<?php endforeach; ?>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
