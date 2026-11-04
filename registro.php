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
            header('Location: login.php?estado=registro_ok');
            exit;
        }
    }
}

$clase_campo = fn (string $campo): string => isset($errores[$campo]) ? ' is-invalid' : '';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
?>
    <main id="contenido">
      <section class="seccion seccion-papel" aria-labelledby="titulo-registro">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
              <p class="eyebrow">Mi cuenta</p>
              <h1 class="titulo-seccion" id="titulo-registro">Crear cuenta</h1>
              <p class="subtitulo">Comprá en la tienda y anotate en los talleres</p>
              <div class="divisor" aria-hidden="true"></div>
<?php if (isset($errores['general'])) : ?>
              <div class="alert alert-danger" role="alert"><?= e($errores['general']) ?></div>
<?php endif; ?>
              <form class="taller form-barismo p-4" method="post" action="registro.php" novalidate>
                <input type="hidden" name="csrf" value="<?= e(token_csrf()) ?>" />
                <div class="mb-3">
                  <label class="form-label" for="nombre">Nombre</label>
                  <input
                    class="form-control<?= $clase_campo('nombre') ?>"
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="<?= e($datos['nombre']) ?>"
                    autocomplete="name"
                    minlength="3"
                    maxlength="60"
                    required
                  />
                  <div class="invalid-feedback"><?= e($errores['nombre'] ?? '') ?></div>
                </div>
                <div class="mb-3">
                  <label class="form-label" for="email">Email</label>
                  <input
                    class="form-control<?= $clase_campo('email') ?>"
                    type="email"
                    id="email"
                    name="email"
                    value="<?= e($datos['email']) ?>"
                    autocomplete="email"
                    maxlength="120"
                    required
                  />
                  <div class="invalid-feedback"><?= e($errores['email'] ?? '') ?></div>
                </div>
                <div class="row g-3 mb-4">
                  <div class="col-sm-6">
                    <label class="form-label" for="password">Contraseña</label>
                    <input
                      class="form-control<?= $clase_campo('password') ?>"
                      type="password"
                      id="password"
                      name="password"
                      autocomplete="new-password"
                      minlength="8"
                      required
                    />
                    <div class="invalid-feedback"><?= e($errores['password'] ?? '') ?></div>
                  </div>
                  <div class="col-sm-6">
                    <label class="form-label" for="confirmar">Repetir contraseña</label>
                    <input
                      class="form-control<?= $clase_campo('confirmar') ?>"
                      type="password"
                      id="confirmar"
                      name="confirmar"
                      autocomplete="new-password"
                      required
                    />
                    <div class="invalid-feedback"><?= e($errores['confirmar'] ?? '') ?></div>
                  </div>
                </div>
                <button class="btn btn-cafe w-100" type="submit">Crear cuenta</button>
              </form>
              <p class="mt-3 text-center">¿Ya tenés cuenta? <a href="login.php">Ingresá</a></p>
            </div>
          </div>
        </div>
      </section>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
