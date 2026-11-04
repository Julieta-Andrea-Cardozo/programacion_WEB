<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla solo si no existe: si ya importaste clase7/sql/barismo.sql
     * se reutiliza la tabla del TP7 sin tocar sus datos.
     */
    public function up(): void
    {
        if (Schema::hasTable('productos')) {
            return;
        }

        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 120);
            $table->enum('categoria', ['grano', 'insumo'])->default('grano');
            $table->string('meta', 120)->default('');
            $table->string('notas', 160)->default('');
            $table->unsignedInteger('precio')->default(0);
            $table->unsignedTinyInteger('estrellas')->default(5);
            $table->string('imagen', 100)->default('');
            $table->timestamp('creado')->useCurrent();
        });
    }

    public function down(): void
    {
        // No se borra la tabla: es compartida con el CRUD del TP7.
    }
};
