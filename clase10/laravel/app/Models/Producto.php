<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Eloquent de la tabla productos (la misma base "barismo" del TP7).
 */
class Producto extends Model
{
    use HasFactory;

    public const CATEGORIAS = ['grano' => 'Café en grano', 'insumo' => 'Insumo'];

    protected $table = 'productos';

    // La tabla usa la columna "creado" en lugar de created_at / updated_at.
    public $timestamps = false;

    protected $fillable = ['nombre', 'categoria', 'meta', 'notas', 'precio', 'estrellas', 'imagen'];

    protected function casts(): array
    {
        return [
            'precio' => 'integer',
            'estrellas' => 'integer',
        ];
    }

    /** Producto::buscar('choco')->get() — filtra por nombre, notas u origen. */
    public function scopeBuscar(Builder $consulta, ?string $termino): Builder
    {
        if (blank($termino)) {
            return $consulta;
        }

        return $consulta->where(function (Builder $q) use ($termino) {
            $q->where('nombre', 'like', "%{$termino}%")
                ->orWhere('notas', 'like', "%{$termino}%")
                ->orWhere('meta', 'like', "%{$termino}%");
        });
    }

    public function scopeDeCategoria(Builder $consulta, ?string $categoria): Builder
    {
        return array_key_exists((string) $categoria, self::CATEGORIAS)
            ? $consulta->where('categoria', $categoria)
            : $consulta;
    }

    public function getPrecioFormateadoAttribute(): string
    {
        return '$' . number_format($this->precio, 0, ',', '.');
    }

    public function getEstrellasTextoAttribute(): string
    {
        return str_repeat('★', $this->estrellas) . str_repeat('☆', 5 - $this->estrellas);
    }
}
