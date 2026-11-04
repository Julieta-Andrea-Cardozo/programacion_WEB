<?php require_once __DIR__ . '/../../../data/catalogo.php'; ?>
    <main id="contenido">
      <section class="seccion" aria-labelledby="titulo-admin">
        <div class="container">
          <p class="eyebrow">Administración · MVC</p>
          <h1 class="titulo-seccion" id="titulo-admin">Productos</h1>
          <p class="subtitulo">Granos e insumos de la tienda</p>
          <div class="divisor" aria-hidden="true"></div>
<?php if ($aviso) : ?>
          <div class="alert alert-success" role="status"><?= e($aviso) ?></div>
<?php endif; ?>
          <div class="d-flex justify-content-between align-items-center mb-3">
            <p class="meta mb-0"><?= count($productos) ?> producto(s) en la base de datos</p>
            <a class="btn btn-cafe" href="index.php?accion=crear">Agregar producto</a>
          </div>
          <div class="table-responsive">
            <table class="table table-borderless align-middle mb-0">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Producto</th>
                  <th scope="col">Categoría</th>
                  <th scope="col" class="text-end">Precio</th>
                  <th scope="col" class="text-end">Acciones</th>
                </tr>
              </thead>
              <tbody>
<?php foreach ($productos as $p) : ?>
                <tr>
                  <td><?= (int) $p['id'] ?></td>
                  <td>
                    <?= e($p['nombre']) ?><br />
                    <span class="meta"><?= e($p['meta']) ?></span>
                  </td>
                  <td><?= e(\App\Models\Producto::CATEGORIAS[$p['categoria']] ?? $p['categoria']) ?></td>
                  <td class="text-end"><?= e(precio((int) $p['precio'])) ?></td>
                  <td class="text-end text-nowrap">
                    <a class="btn btn-borde btn-sm" href="index.php?accion=editar&amp;id=<?= (int) $p['id'] ?>">Editar</a>
                    <form
                      method="post"
                      action="index.php?accion=eliminar"
                      class="d-inline"
                      onsubmit="return confirm('¿Eliminar «<?= e($p['nombre']) ?>»?')"
                    >
                      <input type="hidden" name="id" value="<?= (int) $p['id'] ?>" />
                      <input type="hidden" name="csrf" value="<?= e(token_csrf()) ?>" />
                      <button class="btn btn-borde btn-sm" type="submit">Eliminar</button>
                    </form>
                  </td>
                </tr>
<?php endforeach; ?>
<?php if (!$productos) : ?>
                <tr>
                  <td colspan="5" class="meta">Todavía no hay productos cargados.</td>
                </tr>
<?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </main>
