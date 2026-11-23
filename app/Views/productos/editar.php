    <main id="contenido">
      <section class="seccion bg-crema" aria-labelledby="titulo-editar">
        <div class="contenedor">
          <p class="eyebrow">Administración</p>
          <h1 class="titulo-seccion" id="titulo-editar">Editar producto</h1>
          <p class="subtitulo">Editando «<?= e($producto['nombre']) ?>»</p>
          <div class="divisor" aria-hidden="true"></div>
<?php require __DIR__ . '/formulario.php'; ?>
        </div>
      </section>
    </main>
