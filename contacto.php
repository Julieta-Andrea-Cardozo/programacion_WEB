<?php
$titulo_pagina = 'Contacto';
$descripcion_pagina = 'Contactá a Barismo & Café para reservas de talleres, pedidos de la tienda o prensa.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion seccion-papel" aria-labelledby="titulo-contacto">
        <div class="container">
          <p class="eyebrow">Contacto</p>
          <h1 class="titulo-seccion" id="titulo-contacto">Escribinos</h1>
          <p class="subtitulo">Respondemos en menos de 24 horas</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="row g-4">
            <div class="col-lg-4">
              <div class="taller mb-3">
                <h2 class="eyebrow">Talleres y reservas</h2>
                <a class="meta fs-6" href="mailto:talleres@barismo.com.ar">
                  talleres@barismo.com.ar
                </a>
              </div>
              <div class="taller mb-3">
                <h2 class="eyebrow">Tienda y pedidos</h2>
                <a class="meta fs-6" href="mailto:tienda@barismo.com.ar">tienda@barismo.com.ar</a>
              </div>
              <div class="taller mb-3">
                <h2 class="eyebrow">Prensa</h2>
                <a class="meta fs-6" href="mailto:prensa@barismo.com.ar">prensa@barismo.com.ar</a>
              </div>
              <div class="taller">
                <h2 class="eyebrow">Seguinos</h2>
                <p class="meta fs-6 mb-0">
                  @barismo_arte
                  <br />
                  @barismo.cafe
                </p>
              </div>
            </div>
            <div class="col-lg-8">
              <form class="taller form-barismo p-4" id="form-contacto" novalidate>
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input
                      class="form-control"
                      type="text"
                      id="nombre"
                      name="nombre"
                      placeholder="Tu nombre completo"
                      autocomplete="name"
                      required
                      minlength="3"
                    />
                    <div class="invalid-feedback">Ingresá tu nombre (mínimo 3 letras).</div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="email">Email</label>
                    <input
                      class="form-control"
                      type="email"
                      id="email"
                      name="email"
                      placeholder="tu@email.com"
                      autocomplete="email"
                      required
                    />
                    <div class="invalid-feedback">Ingresá un email válido.</div>
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="asunto">Asunto</label>
                    <select class="form-select" id="asunto" name="asunto" required>
                      <option value="consulta">Consulta general</option>
                      <option value="taller">Inscripción a taller</option>
                      <option value="tienda">Pedido de la tienda</option>
                      <option value="prensa">Prensa</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="mensaje">Mensaje</label>
                    <textarea
                      class="form-control"
                      id="mensaje"
                      name="mensaje"
                      rows="5"
                      placeholder="Contanos en qué podemos ayudarte..."
                      required
                      minlength="10"
                    ></textarea>
                    <div class="invalid-feedback">
                      Escribí un mensaje de al menos 10 caracteres.
                    </div>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-cafe w-100" type="submit">Enviar mensaje →</button>
                  </div>
                </div>
                <div class="alert alert-success mt-3 mb-0 d-none" role="status" data-form-ok>
                  ¡Gracias! Recibimos tu mensaje y te responderemos pronto.
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
