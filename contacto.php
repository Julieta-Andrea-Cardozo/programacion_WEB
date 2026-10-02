<?php
$titulo_pagina = 'Contacto';
$descripcion_pagina = 'Contactá a Barismo & Café para reservas de talleres, pedidos de la tienda o prensa.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';

$asuntos = [
    'consulta' => 'Consulta general',
    'taller' => 'Inscripción a taller',
    'tienda' => 'Pedido de la tienda',
    'prensa' => 'Prensa',
];
$datos = ['nombre' => '', 'email' => '', 'asunto' => 'consulta', 'mensaje' => ''];
$errores = [];
$enviado = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($datos as $campo => $valor) {
        $datos[$campo] = trim((string) ($_POST[$campo] ?? ''));
    }

    if (largo($datos['nombre']) < 3) {
        $errores['nombre'] = 'Ingresá tu nombre (mínimo 3 letras).';
    }
    if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'Ingresá un email válido.';
    }
    if (!array_key_exists($datos['asunto'], $asuntos)) {
        $errores['asunto'] = 'Elegí un asunto de la lista.';
    }
    if (largo($datos['mensaje']) < 10) {
        $errores['mensaje'] = 'Escribí un mensaje de al menos 10 caracteres.';
    }

    $enviado = !$errores;
    if ($enviado) {
        $nombre_enviado = $datos['nombre'];
        $datos = ['nombre' => '', 'email' => '', 'asunto' => 'consulta', 'mensaje' => ''];
    }
}

$clase_campo = fn (string $campo): string => isset($errores[$campo]) ? ' is-invalid' : '';
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
                <h2 class="eyebrow">Soporte general</h2>
                <a class="meta fs-6" href="mailto:<?= e(APP_EMAIL) ?>"><?= e(APP_EMAIL) ?></a>
              </div>
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
              <form
                class="taller form-barismo p-4"
                id="form-contacto"
                method="post"
                action="contacto.php"
                novalidate
                data-servidor
              >
                <div class="row g-3">
                  <div class="col-md-6">
                    <label class="form-label" for="nombre">Nombre</label>
                    <input
                      class="form-control<?= $clase_campo('nombre') ?>"
                      type="text"
                      id="nombre"
                      name="nombre"
                      value="<?= e($datos['nombre']) ?>"
                      placeholder="Tu nombre completo"
                      autocomplete="name"
                      required
                      minlength="3"
                    />
                    <div class="invalid-feedback">
                      <?= e($errores['nombre'] ?? 'Ingresá tu nombre (mínimo 3 letras).') ?>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="email">Email</label>
                    <input
                      class="form-control<?= $clase_campo('email') ?>"
                      type="email"
                      id="email"
                      name="email"
                      value="<?= e($datos['email']) ?>"
                      placeholder="tu@email.com"
                      autocomplete="email"
                      required
                    />
                    <div class="invalid-feedback">
                      <?= e($errores['email'] ?? 'Ingresá un email válido.') ?>
                    </div>
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="asunto">Asunto</label>
                    <select
                      class="form-select<?= $clase_campo('asunto') ?>"
                      id="asunto"
                      name="asunto"
                      required
                    >
<?php foreach ($asuntos as $valor => $texto) : ?>
                      <option value="<?= e($valor) ?>"<?= $valor === $datos['asunto'] ? ' selected' : '' ?>><?= e($texto) ?></option>
<?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback"><?= e($errores['asunto'] ?? 'Elegí un asunto.') ?></div>
                  </div>
                  <div class="col-12">
                    <label class="form-label" for="mensaje">Mensaje</label>
                    <textarea
                      class="form-control<?= $clase_campo('mensaje') ?>"
                      id="mensaje"
                      name="mensaje"
                      rows="5"
                      placeholder="Contanos en qué podemos ayudarte..."
                      required
                      minlength="10"
                    ><?= e($datos['mensaje']) ?></textarea>
                    <div class="invalid-feedback">
                      <?= e($errores['mensaje'] ?? 'Escribí un mensaje de al menos 10 caracteres.') ?>
                    </div>
                  </div>
                  <div class="col-12">
                    <button class="btn btn-cafe w-100" type="submit">Enviar mensaje →</button>
                  </div>
                </div>
                <div
                  class="alert alert-success mt-3 mb-0<?= $enviado ? '' : ' d-none' ?>"
                  role="status"
                  data-form-ok
                >
                  ¡Gracias<?= $enviado ? ', ' . e($nombre_enviado) : '' ?>! Recibimos tu mensaje y te
                  responderemos pronto desde <?= e(APP_EMAIL) ?>.
                </div>
<?php if ($errores) : ?>
                <div class="alert alert-danger mt-3 mb-0" role="alert">
                  Revisá los campos marcados antes de enviar el formulario.
                </div>
<?php endif; ?>
              </form>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
