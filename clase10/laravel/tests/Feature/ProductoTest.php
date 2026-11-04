<?php

namespace Tests\Feature;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    public function test_la_raiz_redirige_a_productos(): void
    {
        $this->get('/')->assertRedirect('/productos');
    }

    public function test_lista_y_filtra_productos(): void
    {
        Producto::factory()->create(['nombre' => 'Colombia Huila', 'categoria' => 'grano']);
        Producto::factory()->create(['nombre' => 'Molino Cerámico', 'categoria' => 'insumo', 'notas' => 'Acero']);

        $this->get('/productos')->assertOk()->assertSee('Colombia Huila')->assertSee('Molino Cerámico');

        $this->get('/productos?q=colombia')->assertOk()
            ->assertSee('Colombia Huila')->assertDontSee('Molino Cerámico');

        $this->get('/productos?categoria=insumo')->assertOk()
            ->assertSee('Molino Cerámico')->assertDontSee('Colombia Huila');
    }

    public function test_valida_los_parametros_de_busqueda(): void
    {
        $this->get('/productos?categoria=bebida')->assertSessionHasErrors('categoria');
    }

    public function test_muestra_un_producto_y_devuelve_404_si_no_existe(): void
    {
        $producto = Producto::factory()->create(['nombre' => 'Ethiopia Yirgacheffe', 'precio' => 4200]);

        $this->get("/productos/{$producto->id}")->assertOk()
            ->assertSee('Ethiopia Yirgacheffe')->assertSee('$4.200');

        $this->get('/productos/999')->assertNotFound();
    }
}
