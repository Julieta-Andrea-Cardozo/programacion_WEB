<?php
$titulo_pagina = 'Ingresar';
$descripcion_pagina = 'Iniciá sesión en Barismo & Café.';
$pagina_actual = 'login';

require_once __DIR__ . '/config/sesion.php';

if (usuario_logueado()) {
    header('Location: ' . (filter_input(INPUT_GET, 'volver') === 'pagar' ? 'pagar.php' : (es_admin() ? 'admin_panel.php' : 'cuenta.php')));
    exit;
}

$avisos = [
    'acceso_denegado' => ['warning', 'Tenés que iniciar sesión para ver esa página.'],
    'registro_ok' => ['success', 'Tu cuenta se creó correctamente. Ya podés ingresar.'],
    'logout_ok' => ['success', 'Cerraste sesión correctamente.'],
];
$clave_aviso = (string) (filter_input(INPUT_GET, 'error') ?? filter_input(INPUT_GET, 'estado') ?? '');
$aviso = $avisos[$clave_aviso] ?? null;

$email = '';
$error = '';
$volver = (string) (filter_input(INPUT_POST, 'volver') ?? filter_input(INPUT_GET, 'volver') ?? '');
$volver = $volver === 'pagar' ? 'pagar' : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim((string) (filter_input(INPUT_POST, 'email') ?? ''));
    $password = (string) (filter_input(INPUT_POST, 'password') ?? '');

    if (!csrf_valido()) {
        $error = 'La sesión del formulario expiró. Volvé a intentarlo.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
        $error = 'Ingresá tu email y tu contraseña.';
    } else {
        require_once __DIR__ . '/config/conexion.php';

        $stmt = $pdo->prepare('SELECT id, nombre, password, rol FROM usuarios WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario['password'])) {
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = (int) $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
            $_SESSION['rol'] = $usuario['rol'];
            unset($_SESSION['csrf']);

            $destino = $usuario['rol'] === 'admin' ? 'admin_panel.php' : 'cuenta.php';
            header('Location: ' . ($volver === 'pagar' ? 'pagar.php' : $destino));
            exit;
        }

        // Mismo mensaje para email inexistente o contraseña incorrecta (no revela qué cuentas existen).
        $error = 'Email o contraseña incorrectos.';
    }
}

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion bg-crema" aria-labelledby="titulo-login">
        <div class="contenedor max-w-5xl">
          <div class="auth">
            <div class="auth-imagen">
              <img src="img/salon.jpg" alt="" loading="lazy" />
              <div class="relative z-10 mt-auto">
                <p class="eyebrow text-crema-oscura">Barismo &amp; Café</p>
                <p class="font-titulo text-3xl font-bold leading-snug text-white">“Cada taza empieza con una buena bienvenida.”</p>
                <p class="mt-3 text-sm text-crema-oscura/90">Ingresá para comprar más rápido, ver tu cuenta y anotarte en los talleres.</p>
              </div>
            </div>
            <div class="auth-form">
              <p class="eyebrow">Mi cuenta</p>
              <h1 class="mb-2 text-4xl font-black" id="titulo-login">Ingresar</h1>
              <p class="subtitulo mb-8">Qué bueno verte de nuevo</p>
<?php if ($aviso) : ?>
              <div class="alerta alerta-<?= e($aviso[0]) ?>" role="status"><?= e($aviso[1]) ?></div>
<?php endif; ?>
<?php if ($volver === 'pagar') : ?>
              <div class="alerta alerta-light" role="status">Ingresá y volvés directo al pago de tu pedido.</div>
<?php endif; ?>
<?php if ($error) : ?>
              <div class="alerta alerta-danger" role="alert"><?= e($error) ?></div>
<?php endif; ?>
              <form class="space-y-5" method="post" action="login.php" novalidate>
                <input type="hidden" name="csrf" value="<?= e(token_csrf()) ?>" />
                <input type="hidden" name="volver" value="<?= e($volver) ?>" />
                <div>
                  <label class="campo-label" for="email">Email</label>
                  <div class="campo-icono">
                    <svg class="campo-icono-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M4 6h16v12H4z" /><path d="m4 7 8 6 8-6" /></svg>
                    <input class="campo" type="email" id="email" name="email" value="<?= e($email) ?>" autocomplete="email" placeholder="tu@email.com" required />
                  </div>
                </div>
                <div>
                  <label class="campo-label" for="password">Contraseña</label>
                  <div class="campo-icono">
                    <svg class="campo-icono-svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="5" y="10" width="14" height="10" rx="2" /><path d="M8 10V7a4 4 0 0 1 8 0v3" /></svg>
                    <input class="campo pr-16" type="password" id="password" name="password" autocomplete="current-password" placeholder="••••••••" required />
                    <button class="campo-ver" type="button" data-ver-password aria-label="Mostrar contraseña" aria-pressed="false">Ver</button>
                  </div>
                </div>
                <button class="btn-cafe w-full" type="submit">Ingresar</button>
              </form>
              <p class="mt-8 border-t border-borde pt-6 text-center text-sm text-suave">
                ¿No tenés cuenta? <a class="font-semibold" href="registro.php">Creala gratis</a>
              </p>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
