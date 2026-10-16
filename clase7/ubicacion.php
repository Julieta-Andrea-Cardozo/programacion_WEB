<?php
$titulo_pagina = 'Ubicación';
$descripcion_pagina = 'Ubicación y horarios de Barismo & Café en Palermo Soho, Ciudad de Buenos Aires.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-ubicacion">
        <div class="container">
          <p class="eyebrow">Visitanos</p>
          <h1 class="titulo-seccion" id="titulo-ubicacion">Ubicación &amp; Horarios</h1>
          <p class="subtitulo">Encontranos en el corazón de Palermo</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row g-4">
            <div class="col-lg-7">
              <iframe
                class="mapa"
                title="Mapa de la ubicación de Barismo y Café en Thames 1650, Palermo"
                src="https://www.google.com/maps?q=Thames+1650,+Palermo,+Buenos+Aires&amp;output=embed"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
              <p class="meta mt-2">
                Thames 1650, Palermo · CABA ·
                <a
                  href="https://www.google.com/maps/search/?api=1&amp;query=Thames+1650+Palermo"
                  target="_blank"
                  rel="noopener"
                >
                  Cómo llegar →
                </a>
              </p>
            </div>
            <div class="col-lg-5">
              <div class="tarjeta p-4 mb-3">
                <h2 class="eyebrow">Horarios</h2>
                <dl class="horarios row mb-0">
                  <dt class="col-6 fw-normal">Lun — Vie</dt>
                  <dd class="col-6 text-end fw-bold">08:00 — 20:00</dd>
                  <dt class="col-6 fw-normal">Sábado</dt>
                  <dd class="col-6 text-end fw-bold">09:00 — 21:00</dd>
                  <dt class="col-6 fw-normal">Domingo</dt>
                  <dd class="col-6 text-end fw-bold mb-0">10:00 — 18:00</dd>
                </dl>
              </div>
              <div class="tarjeta p-4 mb-3">
                <h2 class="eyebrow">Contacto</h2>
                <ul class="list-unstyled meta fs-6 mb-0">
                  <li>
                    Tel:
                    <a href="tel:+541148321650">+54 11 4832-1650</a>
                  </li>
                  <li>
                    Mail:
                    <a href="mailto:hola@barismo.com.ar">hola@barismo.com.ar</a>
                  </li>
                  <li>IG: @barismo_arte</li>
                </ul>
              </div>
              <div class="taller text-center">
                <p class="subtitulo mb-1">¿Reservás un espacio para tu taller?</p>
                <a
                  class="meta text-uppercase"
                  href="https://wa.me/541148321650"
                  target="_blank"
                  rel="noopener"
                >
                  Escribinos por WhatsApp →
                </a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="seccion seccion-crema" aria-labelledby="titulo-salon">
        <div class="container">
          <div class="row align-items-center g-4">
            <div class="col-lg-6">
              <img
                src="img/ubicacion.jpg"
                alt="Salón de la cafetería con plantas y mesas de madera"
                width="900"
                height="600"
                class="img-fluid border"
                loading="lazy"
              />
            </div>
            <div class="col-lg-6">
              <h2 class="titulo-seccion h3" id="titulo-salon">Un salón para quedarse</h2>
              <p>
                Contamos con 40 cubiertos, patio con plantas, wifi y enchufes en todas las mesas.
                Somos pet friendly y tenemos rampa de acceso.
              </p>
              <img
                src="img/salon.jpg"
                alt="Interior amplio de la cafetería con barra y mesas"
                width="900"
                height="600"
                class="img-fluid border"
                loading="lazy"
              />
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
