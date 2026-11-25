<?php
$titulo_pagina = 'Ubicación';
$descripcion_pagina = 'Ubicación y horarios de Barismo & Café en Palermo Soho, Ciudad de Buenos Aires.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-ubicacion">
        <div class="contenedor">
          <p class="eyebrow">Visitanos</p>
          <h1 class="titulo-seccion" id="titulo-ubicacion">Ubicación &amp; Horarios</h1>
          <p class="subtitulo">Encontranos en el corazón de Palermo</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="grid gap-6 lg:grid-cols-12">
            <div class="lg:col-span-7">
              <iframe
                class="min-h-[380px] w-full rounded-3xl border border-borde"
                title="Mapa de la ubicación de Barismo y Café en Thames 1650, Palermo"
                src="https://www.google.com/maps?q=Thames+1650,+Palermo,+Buenos+Aires&amp;output=embed"
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
              ></iframe>
              <p class="meta mt-3">
                Thames 1650, Palermo · CABA ·
                <a href="https://www.google.com/maps/search/?api=1&amp;query=Thames+1650+Palermo" target="_blank" rel="noopener">Cómo llegar →</a>
              </p>
            </div>
            <div class="space-y-4 lg:col-span-5">
              <div class="rounded-3xl border border-borde bg-white p-6">
                <h2 class="eyebrow">Horarios</h2>
                <dl class="grid grid-cols-2 gap-y-2 font-mono text-sm">
                  <dt>Lun — Vie</dt>
                  <dd class="text-right font-bold">08:00 — 20:00</dd>
                  <dt>Sábado</dt>
                  <dd class="text-right font-bold">09:00 — 21:00</dd>
                  <dt>Domingo</dt>
                  <dd class="text-right font-bold">10:00 — 18:00</dd>
                </dl>
              </div>
              <div class="rounded-3xl border border-borde bg-white p-6">
                <h2 class="eyebrow">Contacto</h2>
                <ul class="space-y-1 font-mono text-sm">
                  <li>Tel: <a href="tel:+541148321650">+54 11 4832-1650</a></li>
                  <li>Mail: <a href="mailto:hola@barismo.com.ar">hola@barismo.com.ar</a></li>
                  <li>IG: @barismo_arte</li>
                </ul>
              </div>
              <div class="rounded-3xl bg-espresso p-6 text-center text-crema">
                <p class="mb-3 font-titulo text-lg italic">¿Reservás un espacio para tu taller?</p>
                <a class="btn bg-caramelo text-white hover:bg-white hover:text-espresso" href="https://wa.me/541148321650" target="_blank" rel="noopener">Escribinos por WhatsApp →</a>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="seccion bg-crema" aria-labelledby="titulo-salon">
        <div class="contenedor grid items-center gap-8 lg:grid-cols-2">
          <img
            src="img/ubicacion.jpg"
            alt="Salón de la cafetería con plantas y mesas de madera"
            width="900"
            height="600"
            class="w-full rounded-[2rem] object-cover shadow-lg"
            loading="lazy"
          />
          <div>
            <h2 class="titulo-seccion text-3xl md:text-4xl" id="titulo-salon">Un salón para quedarse</h2>
            <p class="mb-6 text-suave">
              Contamos con 40 cubiertos, patio con plantas, wifi y enchufes en todas las mesas.
              Somos pet friendly y tenemos rampa de acceso.
            </p>
            <img
              src="img/salon.jpg"
              alt="Interior amplio de la cafetería con barra y mesas"
              width="900"
              height="600"
              class="w-full rounded-[2rem] object-cover shadow-lg"
              loading="lazy"
            />
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
