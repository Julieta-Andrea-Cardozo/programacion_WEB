            <article class="tarjeta">
              <img
                class="tarjeta-img"
                src="img/<?= e($producto['img']) ?>"
                alt="<?= e($producto['alt']) ?>"
                width="500"
                height="500"
                loading="lazy"
              />
              <div class="flex flex-1 flex-col p-5">
                <p class="meta mb-1"><?= e($producto['meta']) ?></p>
                <<?= $nivel_titulo ?> class="mb-1 text-xl font-bold"><?= e($producto['nombre']) ?></<?= $nivel_titulo ?>>
                <p class="estrellas mb-1" aria-label="<?= $producto['estrellas'] ?> de 5 estrellas"><?= estrellas($producto['estrellas']) ?></p>
                <p class="mb-4 text-sm italic text-suave"><?= e($producto['notas']) ?></p>
                <div class="mt-auto flex items-center justify-between">
                  <span class="precio"><?= precio($producto['precio']) ?></span>
                  <button
                    class="btn-cafe btn-sm"
                    type="button"
                    data-agregar="<?= e($producto['nombre']) ?>"
                    data-precio="<?= (int) $producto['precio'] ?>"
                    data-img="<?= e($producto['img']) ?>"
                    aria-label="Agregar <?= e($producto['nombre']) ?> al carrito"
                  >
                    Agregar
                  </button>
                </div>
              </div>
            </article>
