<?php
/**
 * Endpoint JSON de productos.
 *
 *   GET api/buscar_productos.php                    -> primeros 12 productos
 *   GET api/buscar_productos.php?q=colombia         -> búsqueda por nombre, notas o meta
 *   GET api/buscar_productos.php?q=a&categoria=grano -> búsqueda filtrada (grano | insumo)
 *   GET api/buscar_productos.php?id=3               -> un producto (404 si no existe)
 */

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

define('RESPUESTA_JSON', true);

function responder(int $codigo, array $cuerpo): void
{
    http_response_code($codigo);
    echo json_encode($cuerpo, JSON_UNESCAPED_UNICODE);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header('Allow: GET');
    responder(405, ['status' => 'error', 'message' => 'Método no permitido. Usá GET.']);
}

require_once __DIR__ . '/../config/conexion.php';

$columnas = 'id, nombre, categoria, meta, notas, precio, estrellas, imagen';

try {
    if (isset($_GET['id'])) {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if (!$id) {
            responder(400, ['status' => 'error', 'message' => 'El id debe ser un número entero positivo.']);
        }

        $stmt = $pdo->prepare("SELECT $columnas FROM productos WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $producto = $stmt->fetch();

        if (!$producto) {
            responder(404, ['status' => 'error', 'message' => 'Producto no encontrado.']);
        }
        responder(200, ['status' => 'success', 'data' => $producto]);
    }

    $busqueda = trim((string) (filter_input(INPUT_GET, 'q') ?? ''));
    $categoria = trim((string) (filter_input(INPUT_GET, 'categoria') ?? ''));

    if (largo($busqueda) > 60) {
        responder(400, ['status' => 'error', 'message' => 'La búsqueda admite hasta 60 caracteres.']);
    }
    if ($categoria !== '' && !in_array($categoria, ['grano', 'insumo'], true)) {
        responder(400, ['status' => 'error', 'message' => 'Categoría inválida. Usá grano o insumo.']);
    }

    $condiciones = [];
    $parametros = [];
    if ($busqueda !== '') {
        $condiciones[] = '(nombre LIKE :q1 OR notas LIKE :q2 OR meta LIKE :q3)';
        $comodin = '%' . addcslashes($busqueda, '%_\\') . '%';
        $parametros += [':q1' => $comodin, ':q2' => $comodin, ':q3' => $comodin];
    }
    if ($categoria !== '') {
        $condiciones[] = 'categoria = :categoria';
        $parametros[':categoria'] = $categoria;
    }

    $sql = "SELECT $columnas FROM productos";
    if ($condiciones) {
        $sql .= ' WHERE ' . implode(' AND ', $condiciones);
    }
    $sql .= ' ORDER BY categoria, nombre LIMIT 12';

    $stmt = $pdo->prepare($sql);
    $stmt->execute($parametros);
    $productos = $stmt->fetchAll();

    foreach ($productos as &$p) {
        $p['id'] = (int) $p['id'];
        $p['precio'] = (int) $p['precio'];
        $p['estrellas'] = (int) $p['estrellas'];
    }
    unset($p);

    responder(200, [
        'status' => 'success',
        'total' => count($productos),
        'data' => $productos,
    ]);
} catch (PDOException $e) {
    responder(500, ['status' => 'error', 'message' => 'Error al consultar la base de datos.']);
}
