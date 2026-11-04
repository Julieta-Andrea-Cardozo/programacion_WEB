<?php
/**
 * Arranque del MVC nativo: sesión, configuración y autocarga de clases App\*.
 * App\Models\Producto -> app/Models/Producto.php
 */

require_once __DIR__ . '/../config/sesion.php';

spl_autoload_register(function (string $clase): void {
    $prefijo = 'App\\';
    if (!str_starts_with($clase, $prefijo)) {
        return;
    }
    $archivo = __DIR__ . '/' . str_replace('\\', '/', substr($clase, strlen($prefijo))) . '.php';
    if (is_file($archivo)) {
        require $archivo;
    }
});
