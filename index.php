<?php
$titulo_pagina = 'Inicio';
$descripcion_pagina = 'Barismo & Café: cafetería de especialidad, arte latte y talleres de barismo en Palermo, Buenos Aires.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="relative overflow-hidden bg-espresso text-crema" aria-labelledby="titulo-hero">
        <div class="absolute -left-32 -top-32 h-96 w-96 rounded-full bg-caramelo/20 blur-3xl" aria-hidden="true"></div>
        <div class="contenedor relative grid items-center gap-12 py-20 lg:grid-cols-2 lg:py-28">
          <div>
            <p class="eyebrow text-caramelo">Arte · Técnica · Pasión</p>
            <h1 class="text-6xl font-black leading-none text-white md:text-7xl lg:text-8xl" id="titulo-hero">
              El café
              <br />
              como
              <em class="text-caramelo">disciplina</em>
            </h1>
            <p class="my-8 max-w-xl text-lg leading-relaxed text-crema/80">
              Somos un espacio dedicado al barismo, al arte latte y al café de especialidad. Cada
              taza es el resultado de un proceso cuidado: del origen del grano a la textura de la
              leche.
            </p>
            <div class="flex flex-wrap gap-3">
              <a class="btn bg-caramelo text-white hover:bg-white hover:text-espresso" href="menu.php">Ver el menú</a>
              <a class="btn border border-crema/40 text-crema hover:bg-crema hover:text-espresso" href="talleres.php">Talleres de barismo</a>
            </div>
          </div>
          <div class="relative">
            <img
              src="img/hero.jpg"
              alt="Tres tazas de café con arte latte rodeadas de plantas"
              width="1000"
              height="1100"
              class="aspect-[4/5] w-full rounded-[2.5rem] object-cover shadow-2xl"
            />
            <div class="absolute -bottom-6 -left-6 hidden rounded-3xl bg-crema px-6 py-4 text-espresso shadow-xl sm:block">
              <p class="meta uppercase tracking-[0.2em]">Tostado en casa</p>
              <p class="font-titulo text-2xl font-black">Desde 2019</p>
            </div>
          </div>
        </div>
      </section>

      <section class="seccion" aria-labelledby="titulo-nosotros">
        <div class="contenedor grid items-center gap-12 lg:grid-cols-2">
          <div class="lg:order-2">
            <p class="eyebrow">Nuestra historia</p>
            <h2 class="titulo-seccion" id="titulo-nosotros">Sobre nosotros</h2>
            <p class="subtitulo">Del oficio de barista a una comunidad cafetera</p>
            <div class="divisor" aria-hidden="true"></div>
            <p class="leading-relaxed">
              Barismo &amp; Café nació en 2019 como una pequeña barra de espresso en Palermo. Hoy
              tostamos nuestros propios granos, formamos baristas y compartimos la cultura del
              café de especialidad con quienes nos visitan.
            </p>
            <ul class="mt-8 grid grid-cols-3 gap-4 text-center">
              <li class="panel py-5">
                <span class="precio block text-3xl">12</span>
                <span class="meta">orígenes</span>
              </li>
              <li class="panel py-5">
                <span class="precio block text-3xl">+900</span>
                <span class="meta">alumnos</span>
              </li>
              <li class="panel py-5">
                <span class="precio block text-3xl">6</span>
                <span class="meta">años</span>
              </li>
            </ul>
          </div>
          <div class="lg:order-1">
            <img
              src="img/local.jpg"
              alt="Barra de la cafetería con máquina de espresso y estantes con café"
              width="1000"
              height="700"
              class="w-full rounded-[2rem] object-cover shadow-xl"
              loading="lazy"
            />
          </div>
        </div>
      </section>

      <section class="seccion bg-crema" aria-labelledby="titulo-destacados">
        <div class="contenedor">
          <p class="eyebrow">Descubrí</p>
          <h2 class="titulo-seccion" id="titulo-destacados">Lo que hacemos</h2>
          <p class="subtitulo">Tres formas de vivir el café</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="grid gap-6 md:grid-cols-3">
            <div class="tarjeta p-8">
              <span class="icono-circulo" aria-hidden="true"><svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M4 9h13v4a6 6 0 0 1-6 6H10a6 6 0 0 1-6-6V9Z" /><path d="M17 10.5h1.5a2.5 2.5 0 0 1 0 5H17" /><path d="M8 3c0 1.3 1 1.3 1 2.6M12 3c0 1.3 1 1.3 1 2.6" /></svg></span>
              <h3 class="mb-2 text-2xl font-bold">Nuestro menú</h3>
              <p class="mb-6 text-suave">
                Espressos, bebidas con leche y fríos preparados con granos de origen único.
              </p>
              <a class="btn-borde mt-auto self-start" href="menu.php">Ver nuestro menú →</a>
            </div>
            <div class="tarjeta p-8">
              <span class="icono-circulo" aria-hidden="true"><svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 6h14l-2 13a2 2 0 0 1-2 1.7H9A2 2 0 0 1 7 19L5 6Z" /><path d="M9 12c1-1.2 2-1.2 3 0s2 1.2 3 0" /><path d="M12 9.5v.01" /></svg></span>
              <h3 class="mb-2 text-2xl font-bold">Talleres</h3>
              <p class="mb-6 text-suave">
                Aprendé barismo y arte latte con nuestro equipo, desde cero hasta nivel avanzado.
              </p>
              <a class="btn-borde mt-auto self-start" href="talleres.php">Ver talleres →</a>
            </div>
            <div class="tarjeta p-8">
              <span class="icono-circulo" aria-hidden="true"><svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M5 8h14l-1.3 11.3A2 2 0 0 1 15.7 21H8.3a2 2 0 0 1-2-1.7L5 8Z" /><path d="M9 11V6a3 3 0 0 1 6 0v5" /></svg></span>
              <h3 class="mb-2 text-2xl font-bold">Tienda</h3>
              <p class="mb-6 text-suave">
                Café en grano tostado artesanalmente e insumos para preparar en casa.
              </p>
              <a class="btn-borde mt-auto self-start" href="tienda.php">Ver tienda →</a>
            </div>
          </div>
        </div>
      </section>

      <section class="seccion" aria-labelledby="titulo-testimonios">
        <div class="contenedor">
          <p class="eyebrow">Testimonios</p>
          <h2 class="titulo-seccion" id="titulo-testimonios">Lo que dicen nuestros clientes</h2>
          <p class="subtitulo">Opiniones reales de quienes nos visitan</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="grid gap-6 md:grid-cols-3">
<?php
$testimonios = [
    ['“El mejor espresso que tomé en mi vida. La extracción es perfecta, con una crema densa y notas de chocolate oscuro.”', 'Valentina M.', 'Cliente habitual · Buenos Aires'],
    ['“Hice el taller de Arte Latte y salí haciendo rosetas. Los baristas explican con una paciencia increíble.”', 'Tomás R.', 'Alumno de taller · Mar del Plata'],
    ['“El Cold Brew con tónica es una experiencia. Nunca pensé que el café podía ser tan refrescante y complejo.”', 'Camila F.', 'Seguidora desde 2024'],
];
?>
<?php foreach ($testimonios as [$cita, $autor, $detalle]) : ?>
            <figure class="relative m-0 rounded-3xl border border-borde bg-white p-8 shadow-sm">
              <span class="absolute -top-5 left-6 font-titulo text-7xl leading-none text-caramelo/40" aria-hidden="true">“</span>
              <blockquote class="mb-6 font-titulo text-lg italic text-cafe">
                <p><?= e($cita) ?></p>
              </blockquote>
              <figcaption class="flex items-center gap-3">
                <span class="h-0.5 w-8 bg-caramelo" aria-hidden="true"></span>
                <span>
                  <strong class="block"><?= e($autor) ?></strong>
                  <span class="meta"><?= e($detalle) ?></span>
                </span>
              </figcaption>
            </figure>
<?php endforeach; ?>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
