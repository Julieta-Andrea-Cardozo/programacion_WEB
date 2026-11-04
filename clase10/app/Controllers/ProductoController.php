<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Producto;

/**
 * Controlador de productos: recibe la petición, pide los datos al modelo
 * y elige la vista. No escribe SQL ni HTML.
 */
class ProductoController extends Controller
{
    private const AVISOS = [
        'created' => 'Producto agregado correctamente.',
        'updated' => 'Producto actualizado correctamente.',
        'deleted' => 'Producto eliminado correctamente.',
    ];

    public function __construct(private Producto $modelo = new Producto())
    {
    }

    public function index(): void
    {
        $status = (string) (filter_input(INPUT_GET, 'status') ?? '');

        $this->render('productos/index', [
            'titulo_pagina' => 'Administrar',
            'productos' => $this->modelo->todos(),
            'aviso' => self::AVISOS[$status] ?? '',
        ]);
    }

    public function crear(): void
    {
        $datos = Producto::vacio();
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $this->leerFormulario();
            $errores = $this->validar($datos);
            if (!$errores) {
                $this->modelo->crear($datos);
                $this->redirigir('index.php?status=created');
            }
        }

        $this->render('productos/crear', [
            'titulo_pagina' => 'Agregar producto',
            'datos' => $datos,
            'errores' => $errores,
            'accion' => 'index.php?accion=crear',
        ]);
    }

    public function editar(): void
    {
        $id = $this->idValido(INPUT_GET);
        $producto = $id ? $this->modelo->buscarPorId($id) : null;
        if (!$producto) {
            $this->redirigir('index.php');
        }

        $datos = array_map('strval', array_intersect_key($producto, Producto::vacio()));
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $datos = $this->leerFormulario();
            $errores = $this->validar($datos);
            if (!$errores) {
                $this->modelo->actualizar($id, $datos);
                $this->redirigir('index.php?status=updated');
            }
        }

        $this->render('productos/editar', [
            'titulo_pagina' => 'Editar producto',
            'producto' => $producto,
            'datos' => $datos,
            'errores' => $errores,
            'accion' => 'index.php?accion=editar&id=' . $id,
        ]);
    }

    /** Solo acepta POST con token CSRF: un enlace GET no puede borrar nada. */
    public function eliminar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && csrf_valido() && ($id = $this->idValido(INPUT_POST))) {
            $this->modelo->eliminar($id);
            $this->redirigir('index.php?status=deleted');
        }
        $this->redirigir('index.php');
    }

    private function leerFormulario(): array
    {
        $datos = [];
        foreach (Producto::vacio() as $campo => $porDefecto) {
            $datos[$campo] = trim((string) (filter_input(INPUT_POST, $campo) ?? $porDefecto));
        }

        return $datos;
    }

    private function validar(array $datos): array
    {
        $errores = Producto::validar($datos);
        if (!csrf_valido()) {
            $errores['csrf'] = 'La sesión del formulario expiró. Volvé a intentarlo.';
        }

        return $errores;
    }

    private function idValido(int $origen): ?int
    {
        $id = filter_input($origen, 'id', FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);

        return $id ?: null;
    }
}
