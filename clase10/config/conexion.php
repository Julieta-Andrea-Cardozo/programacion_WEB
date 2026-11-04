<?php
/**
 * Conexión a MySQL con PDO. Los datos salen del .env (o del .env.example).
 */

require_once __DIR__ . '/config.php';

$dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';
$opciones = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $opciones);
} catch (PDOException $e) {
    if (defined('RESPUESTA_JSON')) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'No se pudo conectar a la base de datos.']);
        exit;
    }
    die('Error crítico de conexión: ' . e($e->getMessage()));
}
