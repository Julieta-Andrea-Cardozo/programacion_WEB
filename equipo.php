<?php
$titulo_pagina = 'Equipo';
$descripcion_pagina = 'Conocé al equipo de baristas de Barismo & Café.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';

$baristas = [
    ['barista-1.jpg', 'Barista preparando café de filtro con pava de cuello de cisne', 'Sofía Reyes', 'Head Barista & Campeona Nacional 2024', 'Diez años detrás de la barra. Lidera el equipo y diseña la carta de temporada.'],
    ['barista-2.jpg', 'Barista atendiendo a una clienta en el mostrador', 'Mateo Villalba', 'Especialista en Arte Latte & Extracción', 'Responsable de los talleres de arte latte. Su diseño insignia es el cisne doble.'],
    ['barista-3.jpg', 'Portafiltros con café molido y granos sobre la mesa', 'Lucía Fontana', 'Tostadora & Catadora Certificada Q-Grader', 'Selecciona los orígenes y define los perfiles de tueste de cada lote.'],
];
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-equipo">
        <div class="contenedor">
          <p class="eyebrow">El equipo</p>
          <h1 class="titulo-seccion" id="titulo-equipo">Nuestros Baristas</h1>
          <p class="subtitulo">Pasión, técnica y años de oficio</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="grid gap-8 md:grid-cols-3">
<?php foreach ($baristas as [$img, $alt, $nombre, $rol, $bio]) : ?>
            <article class="group">
              <div class="overflow-hidden rounded-3xl">
                <img
                  class="aspect-[4/5] w-full object-cover grayscale transition duration-500 group-hover:scale-105 group-hover:grayscale-0"
                  src="img/<?= e($img) ?>"
                  alt="<?= e($alt) ?>"
                  width="600"
                  height="750"
                  loading="lazy"
                />
              </div>
              <h2 class="mb-1 mt-5 text-2xl font-bold"><?= e($nombre) ?></h2>
              <p class="meta mb-2 text-caramelo"><?= e($rol) ?></p>
              <p class="text-suave"><?= e($bio) ?></p>
            </article>
<?php endforeach; ?>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
