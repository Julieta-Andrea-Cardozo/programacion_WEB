<?php
$titulo_pagina = 'Inicio';
$descripcion_pagina = 'Barismo & Café: cafetería de especialidad, arte latte y talleres de barismo en Palermo, Buenos Aires.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="hero" aria-labelledby="titulo-hero">
        <div class="container">
          <div class="row align-items-center g-5">
            <div class="col-lg-6">
              <p class="eyebrow">Arte · Técnica · Pasión</p>
              <h1 id="titulo-hero">
                El café
                <br />
                como
                <em>disciplina</em>
              </h1>
              <p class="lead my-4">
                Somos un espacio dedicado al barismo, al arte latte y al café de especialidad. Cada
                taza es el resultado de un proceso cuidado: del origen del grano a la textura de la
                leche.
              </p>
              <div class="d-flex flex-wrap gap-3">
                <a class="btn btn-cafe" href="menu.php">Ver el menú</a>
                <a class="btn btn-borde" href="talleres.php">Talleres de barismo</a>
              </div>
            </div>
            <div class="col-lg-6">
              <img
                src="img/hero.jpg"
                alt="Tres tazas de café con arte latte rodeadas de plantas"
                width="1000"
                height="1100"
                class="hero-img"
              />
            </div>
          </div>
        </div>
      </section>

      <section class="seccion" aria-labelledby="titulo-nosotros">
        <div class="container">
          <div class="row align-items-center g-5">
            <div class="col-lg-6 order-lg-2">
              <p class="eyebrow">Nuestra historia</p>
              <h2 class="titulo-seccion" id="titulo-nosotros">Sobre nosotros</h2>
              <p class="subtitulo">Del oficio de barista a una comunidad cafetera</p>
              <div class="divisor" aria-hidden="true"></div>
              <p>
                Barismo &amp; Café nació en 2019 como una pequeña barra de espresso en Palermo. Hoy
                tostamos nuestros propios granos, formamos baristas y compartimos la cultura del
                café de especialidad con quienes nos visitan.
              </p>
              <ul class="list-unstyled row text-center mt-4">
                <li class="col-4">
                  <span class="precio d-block">12</span>
                  <span class="meta">orígenes</span>
                </li>
                <li class="col-4">
                  <span class="precio d-block">+900</span>
                  <span class="meta">alumnos</span>
                </li>
                <li class="col-4">
                  <span class="precio d-block">6</span>
                  <span class="meta">años</span>
                </li>
              </ul>
            </div>
            <div class="col-lg-6 order-lg-1">
              <img
                src="img/local.jpg"
                alt="Barra de la cafetería con máquina de espresso y estantes con café"
                width="1000"
                height="700"
                class="img-fluid border"
                loading="lazy"
              />
            </div>
          </div>
        </div>
      </section>

      <section class="seccion seccion-papel" aria-labelledby="titulo-destacados">
        <div class="container">
          <p class="eyebrow">Descubrí</p>
          <h2 class="titulo-seccion" id="titulo-destacados">Lo que hacemos</h2>
          <p class="subtitulo">Tres formas de vivir el café</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row g-4">
            <div class="col-md-4">
              <div class="card tarjeta p-4">
                <h3 class="card-title h4">Nuestro menú</h3>
                <p class="mb-4">
                  Espressos, bebidas con leche y fríos preparados con granos de origen único.
                </p>
                <a class="btn btn-borde align-self-start mt-auto" href="menu.php">
                  Ver nuestro menú →
                </a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card tarjeta p-4">
                <h3 class="card-title h4">Talleres</h3>
                <p class="mb-4">
                  Aprendé barismo y arte latte con nuestro equipo, desde cero hasta nivel avanzado.
                </p>
                <a class="btn btn-borde align-self-start mt-auto" href="talleres.php">
                  Ver talleres →
                </a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card tarjeta p-4">
                <h3 class="card-title h4">Tienda</h3>
                <p class="mb-4">
                  Café en grano tostado artesanalmente e insumos para preparar en casa.
                </p>
                <a class="btn btn-borde align-self-start mt-auto" href="tienda.php">
                  Ver tienda →
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="seccion seccion-crema" aria-labelledby="titulo-testimonios">
        <div class="container">
          <p class="eyebrow">Testimonios</p>
          <h2 class="titulo-seccion" id="titulo-testimonios">Lo que dicen nuestros clientes</h2>
          <p class="subtitulo">Opiniones reales de quienes nos visitan</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row g-4">
            <div class="col-md-4">
              <figure class="testimonio mb-0">
                <blockquote class="mb-4">
                  <p>
                    “El mejor espresso que tomé en mi vida. La extracción es perfecta, con una crema
                    densa y notas de chocolate oscuro.”
                  </p>
                </blockquote>
                <figcaption class="autor">
                  <span>
                    <strong class="d-block">Valentina M.</strong>
                    <span class="meta">Cliente habitual · Buenos Aires</span>
                  </span>
                </figcaption>
              </figure>
            </div>
            <div class="col-md-4">
              <figure class="testimonio mb-0">
                <blockquote class="mb-4">
                  <p>
                    “Hice el taller de Arte Latte y salí haciendo rosetas. Los baristas explican con
                    una paciencia increíble.”
                  </p>
                </blockquote>
                <figcaption class="autor">
                  <span>
                    <strong class="d-block">Tomás R.</strong>
                    <span class="meta">Alumno de taller · Mar del Plata</span>
                  </span>
                </figcaption>
              </figure>
            </div>
            <div class="col-md-4">
              <figure class="testimonio mb-0">
                <blockquote class="mb-4">
                  <p>
                    “El Cold Brew con tónica es una experiencia. Nunca pensé que el café podía ser
                    tan refrescante y complejo.”
                  </p>
                </blockquote>
                <figcaption class="autor">
                  <span>
                    <strong class="d-block">Camila F.</strong>
                    <span class="meta">Seguidora desde 2024</span>
                  </span>
                </figcaption>
              </figure>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
