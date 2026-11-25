<?php
$titulo_pagina = 'Blog';
$descripcion_pagina = 'Blog de Barismo & Café: notas sobre técnica, orígenes y métodos de preparación de café.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';

$notas = [
    ['blog-1.jpg', 'Tazas de café con arte latte entre plantas', 'Técnica', '3 sep 2026', 'Por qué la temperatura del agua cambia todo en el espresso', 'La diferencia entre 88 °C y 94 °C puede ser la línea entre una extracción brillante y un café amargo.', 'Una temperatura baja sub-extrae los compuestos ácidos y deja un café plano; una muy alta extrae taninos amargos. En nuestra barra trabajamos entre 92 °C y 93 °C para cafés de tueste medio y ajustamos un grado según el origen.'],
    ['blog-2.jpg', 'Taza de café sobre plato celeste', 'Orígenes', '20 ago 2026', 'Etiopía natural: el café que sabe a frambuesa y miel', 'Los cafés de proceso natural de Guji tienen perfiles de sabor únicos. Te contamos cómo se producen.', 'En el proceso natural la cereza se seca entera al sol durante semanas. Los azúcares de la fruta migran al grano y aportan notas a frutos rojos, miel y vino. Es un proceso lento que requiere mucho cuidado para evitar fermentaciones indeseadas.'],
    ['blog-3.jpg', 'Barista preparando café de filtro', 'Métodos', '5 ago 2026', 'V60, Chemex o prensa francesa: ¿cuál elegir?', 'Cada método de filtrado resalta características distintas del café. Una guía rápida para elegir el tuyo.', 'La V60 da tazas limpias y brillantes, la Chemex aporta un cuerpo más ligero por su filtro grueso y la prensa francesa ofrece más cuerpo y aceites. Recomendamos empezar con una relación 1:16 y ajustar según tu gusto.'],
];
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-blog">
        <div class="contenedor">
          <p class="eyebrow">Blog</p>
          <h1 class="titulo-seccion" id="titulo-blog">Notas Destacadas</h1>
          <p class="subtitulo">Cultura, técnica y pasión por el café</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
<?php foreach ($notas as $i => [$img, $alt, $tema, $fecha, $titulo, $resumen, $completo]) : ?>
            <article class="tarjeta">
              <img class="tarjeta-img" src="img/<?= e($img) ?>" alt="<?= e($alt) ?>" width="700" height="450" loading="lazy" />
              <div class="flex flex-1 flex-col p-6">
                <p class="mb-3 flex items-center gap-2">
                  <span class="etiqueta etiqueta-bordo"><?= e($tema) ?></span>
                  <time class="meta"><?= e($fecha) ?></time>
                </p>
                <h2 class="mb-2 text-xl font-bold"><?= e($titulo) ?></h2>
                <p class="text-suave"><?= e($resumen) ?></p>
                <div class="mb-4 border-l-2 border-caramelo pl-4 text-sm leading-relaxed" id="nota-<?= $i + 1 ?>" hidden>
                  <p><?= e($completo) ?></p>
                </div>
                <button
                  class="btn-borde btn-sm mt-auto self-start"
                  type="button"
                  data-desplegar
                  aria-expanded="false"
                  aria-controls="nota-<?= $i + 1 ?>"
                >Leer nota →</button>
              </div>
            </article>
<?php endforeach; ?>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
