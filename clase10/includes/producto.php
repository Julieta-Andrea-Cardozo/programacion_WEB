            <div class="col-sm-6 col-lg-3">
              <article class="card tarjeta">
                <img
                  src="img/<?= e($producto['img']) ?>"
                  alt="<?= e($producto['alt']) ?>"
                  width="500"
                  height="500"
                  loading="lazy"
                />
                <div class="card-body p-3 d-flex flex-column">
                  <p class="meta mb-1"><?= e($producto['meta']) ?></p>
                  <<?= $nivel_titulo ?> class="card-title h5 mb-1"><?= e($producto['nombre']) ?></<?= $nivel_titulo ?>>
                  <p class="estrellas mb-1" aria-label="<?= $producto['estrellas'] ?> de 5 estrellas"><?= estrellas($producto['estrellas']) ?></p>
                  <p class="small fst-italic"><?= e($producto['notas']) ?></p>
                  <div class="d-flex justify-content-between align-items-center mt-auto">
                    <span class="precio fs-4"><?= precio($producto['precio']) ?></span>
                    <button
                      class="btn btn-borde btn-sm"
                      type="button"
                      data-agregar="<?= e($producto['nombre']) ?>"
                      aria-label="Agregar <?= e($producto['nombre']) ?> al carrito"
                    >
                      Agregar
                    </button>
                  </div>
                </div>
              </article>
            </div>
