<?php
/**
 * Guardián de rutas: se incluye al principio de cada vista protegida,
 * antes de imprimir HTML.
 *
 * Uso:
 *   require_once __DIR__ . '/includes/auth_guard.php';        // solo usuarios logueados
 *   $rol_requerido = 'admin';
 *   require_once __DIR__ . '/includes/auth_guard.php';        // además exige el rol
 */

require_once __DIR__ . '/../config/sesion.php';

if (!isset($_SESSION['usuario_id'])) {
    header('Location: ' . base_relativa() . 'login.php?error=acceso_denegado');
    exit;
}

if (isset($rol_requerido) && ($_SESSION['rol'] ?? '') !== $rol_requerido) {
    header('Location: ' . base_relativa() . 'cuenta.php?error=sin_permiso');
    exit;
}
