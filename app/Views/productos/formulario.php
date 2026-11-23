<?php
/**
 * Formulario compartido por las vistas crear y editar.
 * Usa $datos, $errores y $accion que envía ProductoController.
 */
$clase_campo = fn (string $campo): string => isset($errores[$campo]) ? ' is-invalid' : '';
?>
          <form class="rounded-[2rem] border border-borde bg-white p-6 shadow-sm md:p-8" method="post" action="<?= e($accion) ?>" novalidate>
            <input type="hidden" name="csrf" value="<?= e(token_csrf()) ?>" />
            <div class="grid gap-5 md:grid-cols-12">
              <div class="md:col-span-8">
                <label class="campo-label" for="nombre">Nombre</label>
                <input
                  class="campo<?= $clase_campo('nombre') ?>"
                  type="text"
                  id="nombre"
                  name="nombre"
                  value="<?= e($datos['nombre']) ?>"
                  placeholder="Ej: Colombia Huila"
                  required
                  minlength="3"
                  maxlength="120"
                />
                <div class="invalid-feedback">
                  <?= e($errores['nombre'] ?? 'Ingresá un nombre entre 3 y 120 caracteres.') ?>
                </div>
              </div>
              <div class="md:col-span-4">
                <label class="campo-label" for="categoria">Categoría</label>
                <select
                  class="campo<?= $clase_campo('categoria') ?>"
                  id="categoria"
                  name="categoria"
                  required
                >
                  <option value="grano"<?= $datos['categoria'] === 'grano' ? ' selected' : '' ?>>Café en grano</option>
                  <option value="insumo"<?= $datos['categoria'] === 'insumo' ? ' selected' : '' ?>>Insumo</option>
                </select>
                <div class="invalid-feedback"><?= e($errores['categoria'] ?? 'Elegí una categoría.') ?></div>
              </div>
              <div class="md:col-span-6">
                <label class="campo-label" for="meta">Origen / detalle</label>
                <input
                  class="campo<?= $clase_campo('meta') ?>"
                  type="text"
                  id="meta"
                  name="meta"
                  value="<?= e($datos['meta']) ?>"
                  placeholder="Ej: América · Natural · 250 g"
                  maxlength="120"
                />
                <div class="invalid-feedback"><?= e($errores['meta'] ?? 'Máximo 120 caracteres.') ?></div>
              </div>
              <div class="md:col-span-6">
                <label class="campo-label" for="notas">Notas de sabor / descripción</label>
                <input
                  class="campo<?= $clase_campo('notas') ?>"
                  type="text"
                  id="notas"
                  name="notas"
                  value="<?= e($datos['notas']) ?>"
                  placeholder="Ej: Caramelo · Uva · Chocolate"
                  maxlength="160"
                />
                <div class="invalid-feedback"><?= e($errores['notas'] ?? 'Máximo 160 caracteres.') ?></div>
              </div>
              <div class="md:col-span-4">
                <label class="campo-label" for="precio">Precio ($)</label>
                <input
                  class="campo<?= $clase_campo('precio') ?>"
                  type="number"
                  id="precio"
                  name="precio"
                  value="<?= e($datos['precio']) ?>"
                  placeholder="3800"
                  min="1"
                  max="999999"
                  required
                />
                <div class="invalid-feedback">
                  <?= e($errores['precio'] ?? 'Ingresá un precio válido.') ?>
                </div>
              </div>
              <div class="md:col-span-4">
                <label class="campo-label" for="estrellas">Estrellas</label>
                <select
                  class="campo<?= $clase_campo('estrellas') ?>"
                  id="estrellas"
                  name="estrellas"
                  required
                >
<?php for ($i = 5; $i >= 1; $i--) : ?>
                  <option value="<?= $i ?>"<?= (string) $i === $datos['estrellas'] ? ' selected' : '' ?>><?= $i ?></option>
<?php endfor; ?>
                </select>
                <div class="invalid-feedback"><?= e($errores['estrellas'] ?? 'Elegí entre 1 y 5.') ?></div>
              </div>
              <div class="md:col-span-4">
                <label class="campo-label" for="imagen">Imagen (opcional)</label>
                <input
                  class="campo<?= $clase_campo('imagen') ?>"
                  type="text"
                  id="imagen"
                  name="imagen"
                  value="<?= e($datos['imagen']) ?>"
                  placeholder="grano-brasil.jpg"
                  maxlength="100"
                />
                <div class="invalid-feedback">
                  <?= e($errores['imagen'] ?? 'Solo el nombre del archivo.') ?>
                </div>
              </div>
              <div class="flex gap-2 md:col-span-12">
                <button class="btn-cafe" type="submit">Guardar</button>
                <a class="btn-borde" href="index.php">Cancelar</a>
              </div>
            </div>
<?php if ($errores) : ?>
            <div class="alerta alerta-danger mb-0 mt-4" role="alert">
              Revisá los campos marcados antes de guardar.
            </div>
<?php endif; ?>
          </form>
