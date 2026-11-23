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
    foreach (array_keys($datos) as $campo) {
        $datos[$campo] = trim((string) (filter_input(INPUT_POST, $campo) ?? ''));
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
      <section class="seccion bg-crema" aria-labelledby="titulo-contacto">
        <div class="contenedor">
          <p class="eyebrow">Contacto</p>
          <h1 class="titulo-seccion" id="titulo-contacto">Escribinos</h1>
          <p class="subtitulo">Respondemos en menos de 24 horas</p>
          <div class="divisor" aria-hidden="true"></div>
          <div class="grid gap-6 lg:grid-cols-12">
            <div class="space-y-3 lg:col-span-4">
<?php
$canales = [
    'Soporte general' => APP_EMAIL,
    'Talleres y reservas' => 'talleres@barismo.com.ar',
    'Tienda y pedidos' => 'tienda@barismo.com.ar',
    'Prensa' => 'prensa@barismo.com.ar',
];
?>
<?php foreach ($canales as $canal => $correo) : ?>
              <div class="rounded-3xl border border-borde bg-white p-5">
                <h2 class="eyebrow mb-1"><?= e($canal) ?></h2>
                <a class="font-mono text-sm" href="mailto:<?= e($correo) ?>"><?= e($correo) ?></a>
              </div>
<?php endforeach; ?>
              <div class="rounded-3xl bg-espresso p-5 text-crema">
                <h2 class="eyebrow mb-1">Seguinos</h2>
                <p class="mb-0 font-mono text-sm">@barismo_arte<br />@barismo.cafe</p>
              </div>
            </div>
            <div class="lg:col-span-8">
              <form
                class="rounded-[2rem] border border-borde bg-white p-6 shadow-sm md:p-8"
                id="form-contacto"
                method="post"
                action="contacto.php"
                novalidate
                data-servidor
              >
                <div class="grid gap-5 md:grid-cols-2">
                  <div>
                    <label class="campo-label" for="nombre">Nombre</label>
                    <input
                      class="campo<?= $clase_campo('nombre') ?>"
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
                  <div>
                    <label class="campo-label" for="email">Email</label>
                    <input
                      class="campo<?= $clase_campo('email') ?>"
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
                  <div class="md:col-span-2">
                    <label class="campo-label" for="asunto">Asunto</label>
                    <select class="campo<?= $clase_campo('asunto') ?>" id="asunto" name="asunto" required>
<?php foreach ($asuntos as $valor => $texto) : ?>
                      <option value="<?= e($valor) ?>"<?= $valor === $datos['asunto'] ? ' selected' : '' ?>><?= e($texto) ?></option>
<?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback"><?= e($errores['asunto'] ?? 'Elegí un asunto.') ?></div>
                  </div>
                  <div class="md:col-span-2">
                    <label class="campo-label" for="mensaje">Mensaje</label>
                    <textarea
                      class="campo<?= $clase_campo('mensaje') ?>"
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
                  <div class="md:col-span-2">
                    <button class="btn-cafe w-full" type="submit">Enviar mensaje →</button>
                  </div>
                </div>
                <div class="alerta alerta-success mb-0 mt-4<?= $enviado ? '' : ' hidden' ?>" role="status" data-form-ok>
                  ¡Gracias<?= $enviado ? ', ' . e($nombre_enviado) : '' ?>! Recibimos tu mensaje y te
                  responderemos pronto desde <?= e(APP_EMAIL) ?>.
                </div>
<?php if ($errores) : ?>
                <div class="alerta alerta-danger mb-0 mt-4" role="alert">
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
