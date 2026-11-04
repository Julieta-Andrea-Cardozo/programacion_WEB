<?php
$titulo_pagina = 'Ingresar';
$descripcion_pagina = 'Iniciá sesión en Barismo & Café.';
$pagina_actual = 'login';

require_once __DIR__ . '/config/sesion.php';

if (usuario_logueado()) {
    header('Location: ' . (es_admin() ? 'admin_panel.php' : 'cuenta.php'));
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

            header('Location: ' . ($usuario['rol'] === 'admin' ? 'admin_panel.php' : 'cuenta.php'));
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
      <section class="seccion seccion-papel" aria-labelledby="titulo-login">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
              <p class="eyebrow">Mi cuenta</p>
              <h1 class="titulo-seccion" id="titulo-login">Ingresar</h1>
              <p class="subtitulo">Accedé a tu cuenta de Barismo &amp; Café</p>
              <div class="divisor" aria-hidden="true"></div>
<?php if ($aviso) : ?>
              <div class="alert alert-<?= e($aviso[0]) ?>" role="status"><?= e($aviso[1]) ?></div>
<?php endif; ?>
<?php if ($error) : ?>
              <div class="alert alert-danger" role="alert"><?= e($error) ?></div>
<?php endif; ?>
              <form class="taller form-barismo p-4" method="post" action="login.php" novalidate>
                <input type="hidden" name="csrf" value="<?= e(token_csrf()) ?>" />
                <div class="mb-3">
                  <label class="form-label" for="email">Email</label>
                  <input
                    class="form-control"
                    type="email"
                    id="email"
                    name="email"
                    value="<?= e($email) ?>"
                    autocomplete="email"
                    required
                  />
                </div>
                <div class="mb-4">
                  <label class="form-label" for="password">Contraseña</label>
                  <input
                    class="form-control"
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="current-password"
                    required
                  />
                </div>
                <button class="btn btn-cafe w-100" type="submit">Ingresar</button>
              </form>
              <p class="mt-3 text-center">¿No tenés cuenta? <a href="registro.php">Registrate</a></p>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
