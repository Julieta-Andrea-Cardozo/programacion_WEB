<?php
/**
 * Validación compartida del formulario de productos (crear.php y editar.php).
 */

function leer_producto_post(): array
{
    return [
        'nombre' => trim((string) (filter_input(INPUT_POST, 'nombre') ?? '')),
        'categoria' => trim((string) (filter_input(INPUT_POST, 'categoria') ?? 'grano')),
        'meta' => trim((string) (filter_input(INPUT_POST, 'meta') ?? '')),
        'notas' => trim((string) (filter_input(INPUT_POST, 'notas') ?? '')),
        'precio' => trim((string) (filter_input(INPUT_POST, 'precio') ?? '')),
        'estrellas' => trim((string) (filter_input(INPUT_POST, 'estrellas') ?? '5')),
        'imagen' => trim((string) (filter_input(INPUT_POST, 'imagen') ?? '')),
    ];
}

function validar_producto(array $datos): array
{
    $errores = [];

    if (largo($datos['nombre']) < 3 || largo($datos['nombre']) > 120) {
        $errores['nombre'] = 'Ingresá un nombre entre 3 y 120 caracteres.';
    }
    if (!in_array($datos['categoria'], ['grano', 'insumo'], true)) {
        $errores['categoria'] = 'Elegí una categoría de la lista.';
    }
    if (largo($datos['meta']) > 120) {
        $errores['meta'] = 'Máximo 120 caracteres.';
    }
    if (largo($datos['notas']) > 160) {
        $errores['notas'] = 'Máximo 160 caracteres.';
    }
    if (!filter_var($datos['precio'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 999999]])) {
        $errores['precio'] = 'Ingresá un precio en pesos (número entero mayor a 0).';
    }
    if (!filter_var($datos['estrellas'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 5]])) {
        $errores['estrellas'] = 'Elegí entre 1 y 5 estrellas.';
    }
    if ($datos['imagen'] !== '' && !preg_match('/^[\w.\-]+$/', $datos['imagen'])) {
        $errores['imagen'] = 'Solo el nombre del archivo (ej: grano-brasil.jpg).';
    }

    return $errores;
}

function producto_normalizado(array $datos): array
{
    return [
        ':nombre' => $datos['nombre'],
        ':categoria' => $datos['categoria'],
        ':meta' => $datos['meta'],
        ':notas' => $datos['notas'],
        ':precio' => (int) $datos['precio'],
        ':estrellas' => (int) $datos['estrellas'],
        ':imagen' => $datos['imagen'],
    ];
}
