<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductoController extends Controller
{
    public function index(Request $request): View
    {
        $datos = $request->validate([
            'q' => ['nullable', 'string', 'max:60'],
            'categoria' => ['nullable', 'in:grano,insumo'],
        ]);

        $productos = Producto::buscar($datos['q'] ?? null)
            ->deCategoria($datos['categoria'] ?? null)
            ->orderBy('categoria')
            ->orderBy('nombre')
            ->get();

        return view('productos.index', [
            'productos' => $productos,
            'busqueda' => $datos['q'] ?? '',
            'categoria' => $datos['categoria'] ?? '',
            'categorias' => Producto::CATEGORIAS,
        ]);
    }

    public function show(Producto $producto): View
    {
        return view('productos.show', ['producto' => $producto]);
    }
}
