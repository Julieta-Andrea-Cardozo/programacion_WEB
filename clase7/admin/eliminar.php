<?php
/**
 * Elimina un producto. Solo acepta POST (los enlaces GET no borran nada).
 */

require_once __DIR__ . '/../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id) {
    $stmt = $pdo->prepare('DELETE FROM productos WHERE id = :id');
    $stmt->execute([':id' => $id]);
}

header('Location: index.php?status=deleted');
exit;
