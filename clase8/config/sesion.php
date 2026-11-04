<?php
/**
 * Inicio de sesión segura y funciones de ayuda para autenticación.
 */

require_once __DIR__ . '/config.php';

if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.use_strict_mode', '1');
    ini_set('session.use_only_cookies', '1');
    session_name('BARISMO_SESION');
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    session_start();
}

function usuario_logueado(): bool
{
    return isset($_SESSION['usuario_id']);
}

function es_admin(): bool
{
    return ($_SESSION['rol'] ?? '') === 'admin';
}

function token_csrf(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf'];
}

function csrf_valido(): bool
{
    $token = (string) (filter_input(INPUT_POST, 'csrf') ?? '');

    return $token !== '' && hash_equals($_SESSION['csrf'] ?? '', $token);
}
