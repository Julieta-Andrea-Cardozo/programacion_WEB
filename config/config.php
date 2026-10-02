<?php
/**
 * Configuración global: carga las variables de entorno desde .env
 * y define las constantes que usa toda la aplicación.
 */

function cargar_env(string $ruta): array
{
    $variables = [];
    if (!is_readable($ruta)) {
        return $variables;
    }

    foreach (file($ruta, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $linea) {
        $linea = trim($linea);
        if ($linea === '' || str_starts_with($linea, '#') || !str_contains($linea, '=')) {
            continue;
        }
        [$clave, $valor] = array_map('trim', explode('=', $linea, 2));
        $variables[$clave] = trim($valor, "\"'");
    }

    return $variables;
}

$raiz = dirname(__DIR__);
$env = cargar_env($raiz . '/.env') ?: cargar_env($raiz . '/.env.example');

define('APP_NAME', $env['APP_NAME'] ?? 'Barismo & Café');
define('APP_EMAIL', $env['APP_EMAIL'] ?? 'hola@barismo.com.ar');
define('APP_PHONE', $env['APP_PHONE'] ?? '');
define('APP_ADDRESS', $env['APP_ADDRESS'] ?? '');
define('APP_ENV', $env['APP_ENV'] ?? 'production');

if (APP_ENV === 'local') {
    ini_set('display_errors', '1');
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', '0');
}

function e(string $texto): string
{
    return htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');
}

function largo(string $texto): int
{
    return function_exists('mb_strlen')
        ? mb_strlen($texto, 'UTF-8')
        : count(preg_split('//u', $texto, -1, PREG_SPLIT_NO_EMPTY));
}
