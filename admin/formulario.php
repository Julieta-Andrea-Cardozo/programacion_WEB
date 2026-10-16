<?php
/**
 * Formulario compartido por crear.php y editar.php.
 * Usa $datos, $errores y $accion definidos por la vista que lo incluye.
 */
$clase_campo = fn (string $campo): string => isset($errores[$campo]) ? ' is-invalid' : '';
?>
          <form class="taller form-barismo p-4" method="post" action="<?= e($accion) ?>" novalidate>
            <div class="row g-3">
              <div class="col-md-8">
                <label class="form-label" for="nombre">Nombre</label>
                <input
                  class="form-control<?= $clase_campo('nombre') ?>"
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
              <div class="col-md-4">
                <label class="form-label" for="categoria">Categoría</label>
                <select
                  class="form-select<?= $clase_campo('categoria') ?>"
                  id="categoria"
                  name="categoria"
                  required
                >
                  <option value="grano"<?= $datos['categoria'] === 'grano' ? ' selected' : '' ?>>Café en grano</option>
                  <option value="insumo"<?= $datos['categoria'] === 'insumo' ? ' selected' : '' ?>>Insumo</option>
                </select>
                <div class="invalid-feedback"><?= e($errores['categoria'] ?? 'Elegí una categoría.') ?></div>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="meta">Origen / detalle</label>
                <input
                  class="form-control<?= $clase_campo('meta') ?>"
                  type="text"
                  id="meta"
                  name="meta"
                  value="<?= e($datos['meta']) ?>"
                  placeholder="Ej: América · Natural · 250 g"
                  maxlength="120"
                />
                <div class="invalid-feedback"><?= e($errores['meta'] ?? 'Máximo 120 caracteres.') ?></div>
              </div>
              <div class="col-md-6">
                <label class="form-label" for="notas">Notas de sabor / descripción</label>
                <input
                  class="form-control<?= $clase_campo('notas') ?>"
                  type="text"
                  id="notas"
                  name="notas"
                  value="<?= e($datos['notas']) ?>"
                  placeholder="Ej: Caramelo · Uva · Chocolate"
                  maxlength="160"
                />
                <div class="invalid-feedback"><?= e($errores['notas'] ?? 'Máximo 160 caracteres.') ?></div>
              </div>
              <div class="col-md-4">
                <label class="form-label" for="precio">Precio ($)</label>
                <input
                  class="form-control<?= $clase_campo('precio') ?>"
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
              <div class="col-md-4">
                <label class="form-label" for="estrellas">Estrellas</label>
                <select
                  class="form-select<?= $clase_campo('estrellas') ?>"
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
              <div class="col-md-4">
                <label class="form-label" for="imagen">Imagen (opcional)</label>
                <input
                  class="form-control<?= $clase_campo('imagen') ?>"
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
              <div class="col-12 d-flex gap-2">
                <button class="btn btn-cafe" type="submit">Guardar</button>
                <a class="btn btn-borde" href="index.php">Cancelar</a>
              </div>
            </div>
<?php if ($errores) : ?>
            <div class="alert alert-danger mt-3 mb-0" role="alert">
              Revisá los campos marcados antes de guardar.
            </div>
<?php endif; ?>
          </form>
