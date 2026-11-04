<?php

namespace App\Models;

use App\Core\Database;
use PDO;

/**
 * Modelo Producto: toda la lógica de datos y las consultas SQL de la tabla productos.
 */
class Producto
{
    public const CATEGORIAS = ['grano' => 'Café en grano', 'insumo' => 'Insumo'];

    private PDO $db;

    public function __construct(?PDO $db = null)
    {
        $this->db = $db ?? Database::conexion();
    }

    public function todos(): array
    {
        return $this->db->query('SELECT * FROM productos ORDER BY id DESC')->fetchAll();
    }

    public function buscarPorId(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM productos WHERE id = :id');
        $stmt->execute([':id' => $id]);

        return $stmt->fetch() ?: null;
    }

    public function crear(array $datos): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO productos (nombre, categoria, meta, notas, precio, estrellas, imagen)
             VALUES (:nombre, :categoria, :meta, :notas, :precio, :estrellas, :imagen)'
        );
        $stmt->execute(self::parametros($datos));

        return (int) $this->db->lastInsertId();
    }

    public function actualizar(int $id, array $datos): void
    {
        $stmt = $this->db->prepare(
            'UPDATE productos
             SET nombre = :nombre, categoria = :categoria, meta = :meta,
                 notas = :notas, precio = :precio, estrellas = :estrellas, imagen = :imagen
             WHERE id = :id'
        );
        $stmt->execute(self::parametros($datos) + [':id' => $id]);
    }

    public function eliminar(int $id): void
    {
        $stmt = $this->db->prepare('DELETE FROM productos WHERE id = :id');
        $stmt->execute([':id' => $id]);
    }

    public static function vacio(): array
    {
        return ['nombre' => '', 'categoria' => 'grano', 'meta' => '', 'notas' => '',
            'precio' => '', 'estrellas' => '5', 'imagen' => ''];
    }

    /** Devuelve un array campo => mensaje; vacío si los datos son válidos. */
    public static function validar(array $datos): array
    {
        $errores = [];

        if (largo($datos['nombre']) < 3 || largo($datos['nombre']) > 120) {
            $errores['nombre'] = 'Ingresá un nombre entre 3 y 120 caracteres.';
        }
        if (!array_key_exists($datos['categoria'], self::CATEGORIAS)) {
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

    private static function parametros(array $datos): array
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
}
