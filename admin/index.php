<?php
/**
 * Front controller del panel de productos (MVC nativo).
 *
 *   admin/index.php                    -> ProductoController::index
 *   admin/index.php?accion=crear       -> ProductoController::crear
 *   admin/index.php?accion=editar&id=3 -> ProductoController::editar
 *   admin/index.php?accion=eliminar    -> ProductoController::eliminar (POST)
 */

use App\Controllers\ProductoController;

$rol_requerido = 'admin';
require_once __DIR__ . '/../includes/auth_guard.php';
require_once __DIR__ . '/../app/bootstrap.php';

$rutas = ['index', 'crear', 'editar', 'eliminar'];
$accion = (string) (filter_input(INPUT_GET, 'accion') ?? 'index');

if (!in_array($accion, $rutas, true)) {
    http_response_code(404);
    $accion = 'index';
}

(new ProductoController())->$accion();
