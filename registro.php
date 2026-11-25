<?php
$titulo_pagina = 'Crear cuenta';
$descripcion_pagina = 'Registrate en Barismo & Café para comprar e inscribirte a talleres.';
$pagina_actual = 'registro';

require_once __DIR__ . '/config/sesion.php';

if (usuario_logueado()) {
    header('Location: cuenta.php');
    exit;
}

$datos = ['nombre' => '', 'email' => ''];
$volver = (filter_input(INPUT_POST, 'volver') ?? filter_input(INPUT_GET, 'volver')) === 'pagar' ? 'pagar' : '';
$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos['nombre'] = trim((string) (filter_input(INPUT_POST, 'nombre') ?? ''));
    $datos['email'] = trim((string) (filter_input(INPUT_POST, 'email') ?? ''));
    $password = (string) (filter_input(INPUT_POST, 'password') ?? '');
    $confirmar = (string) (filter_input(INPUT_POST, 'confirmar') ?? '');

    if (!csrf_valido()) {
        $errores['general'] = 'La sesión del formulario expiró. Volvé a intentarlo.';
    }
    if (largo($datos['nombre']) < 3 || largo($datos['nombre']) > 60) {
        $errores['nombre'] = 'Ingresá tu nombre (entre 3 y 60 caracteres).';
    } elseif (!preg_match('/^[\p{L} .\'-]+$/u', $datos['nombre'])) {
        $errores['nombre'] = 'El nombre solo puede tener letras y espacios.';
    }
    if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL) || largo($datos['email']) > 120) {
        $errores['email'] = 'Ingresá un email válido.';
    }
    if (largo($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
        $errores['password'] = 'Mínimo 8 caracteres, con al menos una letra y un número.';
    }
    if ($password !== $confirmar) {
        $errores['confirmar'] = 'Las contraseñas no coinciden.';
    }

    if (!$errores) {
        require_once __DIR__ . '/config/conexion.php';

        $stmt = $pdo->prepare('SELECT COUNT(*) FROM usuarios WHERE email = :email');
        $stmt->execute([':email' => $datos['email']]);

        if ($stmt->fetchColumn() > 0) {
            $errores['email'] = 'Ya existe una cuenta con ese email.';
        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO usuarios (nombre, email, password, rol)
                 VALUES (:nombre, :email, :password, :rol)'
            );
            $stmt->execute([
                ':nombre' => $datos['nombre'],
                ':email' => $datos['email'],
                ':password' => password_hash($password, PASSWORD_BCRYPT),
                ':rol' => 'usuario',
            ]);
            header('Location: login.php?estado=registro_ok' . ($volver ? '&volver=pagar' : ''));
            exit;
        }
    }
}

$clase_campo = fn (string $campo): string => isset($errores[$campo]) ? ' is-invalid' : '';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion bg-crema" aria-labelledby="titulo-registro">
        <div class="contenedor max-w-5xl">
          <div class="auth">
            <div class="auth-imagen">
              <img src="img/latte.jpg" alt="" loading="lazy" />
              <div class="relative z-10 mt-auto">
                <p class="eyebrow text-crema-oscura">Barismo &amp; Café</p>
                <p class="font-titulo text-3xl font-bold leading-snug text-white">Sumate a la comunidad cafetera.</p>
                <p class="mt-3 text-sm text-crema-oscura/90">Con tu cuenta comprás en la tienda y te anotás en los talleres de barismo y arte latte.</p>
              </div>
            </div>
            <div class="auth-form">
              <p class="eyebrow">Mi cuenta</p>
              <h1 class="mb-2 text-4xl font-black" id="titulo-registro">Crear cuenta</h1>
              <p class="subtitulo mb-8">Tarda menos que preparar un espresso</p>
<?php if (isset($errores['general'])) : ?>
              <div class="alerta alerta-danger" role="alert"><?= e($errores['general']) ?></div>
<?php endif; ?>
              <form class="space-y-5" method="post" action="registro.php" novalidate>
                <input type="hidden" name="csrf" value="<?= e(token_csrf()) ?>" />
                <input type="hidden" name="volver" value="<?= e($volver) ?>" />
                <div>
                  <label class="campo-label" for="nombre">Nombre</label>
                  <div class="campo-icono">
                    <svg class="campo-icono-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="8" r="4" /><path d="M4 21a8 8 0 0 1 16 0" /></svg>
                    <input class="campo<?= $clase_campo('nombre') ?>" type="text" id="nombre" name="nombre" value="<?= e($datos['nombre']) ?>" autocomplete="name" minlength="3" maxlength="60" required />
                  </div>
                  <div class="invalid-feedback block"><?= e($errores['nombre'] ?? '') ?></div>
                </div>
                <div>
                  <label class="campo-label" for="email">Email</label>
                  <div class="campo-icono">
                    <svg class="campo-icono-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 6h16v12H4z" /><path d="m4 7 8 6 8-6" /></svg>
                    <input class="campo<?= $clase_campo('email') ?>" type="email" id="email" name="email" value="<?= e($datos['email']) ?>" autocomplete="email" maxlength="120" placeholder="tu@email.com" required />
                  </div>
                  <div class="invalid-feedback block"><?= e($errores['email'] ?? '') ?></div>
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                <div>
                  <label class="campo-label" for="password">Contraseña</label>
                  <div class="campo-icono">
                    <svg class="campo-icono-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="10" width="14" height="10" rx="2" /><path d="M8 10V7a4 4 0 0 1 8 0v3" /></svg>
                    <input class="campo pr-16<?= $clase_campo('password') ?>" type="password" id="password" name="password" autocomplete="new-password" minlength="8" required />
                    <button class="campo-ver" type="button" data-ver-password aria-label="Mostrar contraseña" aria-pressed="false">Ver</button>
                  </div>
                  <div class="invalid-feedback block"><?= e($errores['password'] ?? '') ?></div>
                </div>
                <div>
                  <label class="campo-label" for="confirmar">Repetir contraseña</label>
                  <div class="campo-icono">
                    <svg class="campo-icono-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="10" width="14" height="10" rx="2" /><path d="M8 10V7a4 4 0 0 1 8 0v3" /></svg>
                    <input class="campo<?= $clase_campo('confirmar') ?>" type="password" id="confirmar" name="confirmar" autocomplete="new-password" required />
                  </div>
                  <div class="invalid-feedback block"><?= e($errores['confirmar'] ?? '') ?></div>
                </div>
                </div>
                <button class="btn-cafe w-full" type="submit">Crear cuenta</button>
              </form>
              <p class="mt-8 border-t border-borde pt-6 text-center text-sm text-suave">
                ¿Ya tenés cuenta? <a class="font-semibold" href="login.php<?= $volver ? '?volver=pagar' : '' ?>">Ingresá</a>
              </p>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
