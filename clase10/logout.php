<?php
/**
 * Cierre de sesión: vacía $_SESSION, borra la cookie y destruye la sesión.
 */

require_once __DIR__ . '/config/sesion.php';

$_SESSION = [];

if (ini_get('session.use_cookies')) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', [
        'expires' => time() - 42000,
        'path' => $p['path'],
        'domain' => $p['domain'],
        'secure' => $p['secure'],
        'httponly' => $p['httponly'],
        'samesite' => $p['samesite'],
    ]);
}

session_destroy();

header('Location: login.php?estado=logout_ok');
exit;
