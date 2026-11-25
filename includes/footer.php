    <footer class="mt-auto border-t-4 border-caramelo bg-espresso pb-8 pt-16 text-crema-oscura">
      <div class="contenedor">
        <div class="grid gap-10 md:grid-cols-2 lg:grid-cols-12">
          <div class="lg:col-span-4">
            <h2 class="font-titulo text-2xl italic text-white"><?= e(APP_NAME) ?></h2>
            <p class="mt-3 text-sm leading-relaxed text-crema-oscura/80">
              Café de especialidad, arte latte y formación de baristas en el corazón de Palermo.
            </p>
          </div>
          <div class="lg:col-span-2">
            <h3 class="mb-4 font-mono text-xs uppercase tracking-[0.2em] text-white">Explorar</h3>
            <ul class="space-y-2 text-sm">
              <li><a class="text-crema-oscura hover:text-white" href="<?= $base ?>menu.php">Menú</a></li>
              <li><a class="text-crema-oscura hover:text-white" href="<?= $base ?>galeria.php">Galería</a></li>
              <li><a class="text-crema-oscura hover:text-white" href="<?= $base ?>talleres.php">Talleres</a></li>
              <li><a class="text-crema-oscura hover:text-white" href="<?= $base ?>blog.php">Blog</a></li>
            </ul>
          </div>
          <div class="lg:col-span-2">
            <h3 class="mb-4 font-mono text-xs uppercase tracking-[0.2em] text-white">Comprar</h3>
            <ul class="space-y-2 text-sm">
              <li><a class="text-crema-oscura hover:text-white" href="<?= $base ?>tienda.php">Tienda</a></li>
              <li><a class="text-crema-oscura hover:text-white" href="<?= $base ?>tecnicas.php">Técnicas</a></li>
              <li><a class="text-crema-oscura hover:text-white" href="<?= $base ?>ubicacion.php">Ubicación</a></li>
              <li><a class="text-crema-oscura hover:text-white" href="<?= $base ?>contacto.php">Contacto</a></li>
              <li><a class="text-crema-oscura hover:text-white" href="<?= $base ?>admin_panel.php">Administrar</a></li>
            </ul>
          </div>
          <div class="lg:col-span-4">
            <h3 class="mb-4 font-mono text-xs uppercase tracking-[0.2em] text-white">Contacto</h3>
            <address class="space-y-1 text-sm not-italic">
              <p><?= e(APP_ADDRESS) ?></p>
              <p><a class="text-crema-oscura hover:text-white" href="tel:<?= e(preg_replace('/[^0-9+]/', '', APP_PHONE)) ?>"><?= e(APP_PHONE) ?></a></p>
              <p><a class="text-crema-oscura hover:text-white" href="mailto:<?= e(APP_EMAIL) ?>"><?= e(APP_EMAIL) ?></a></p>
              <p><a class="text-crema-oscura hover:text-white" href="https://www.instagram.com/" target="_blank" rel="noopener">Instagram @barismo_arte</a></p>
            </address>
          </div>
        </div>
        <p class="mt-12 border-t border-crema-oscura/20 pt-6 text-center font-mono text-xs text-crema-oscura/70">
          © <?= date('Y') ?> <?= e(APP_NAME) ?> · Trabajo práctico de Programación Web · Julieta Andrea Cardozo
        </p>
      </div>
    </footer>

    <div class="fixed inset-0 z-50 hidden bg-espresso/50 backdrop-blur-sm" data-carrito-fondo></div>
    <aside
      class="fixed inset-y-0 right-0 z-50 flex w-full max-w-md translate-x-full flex-col bg-papel shadow-2xl transition-transform duration-300"
      id="carrito"
      role="dialog"
      aria-modal="true"
      aria-labelledby="titulo-carrito"
      aria-hidden="true"
      inert
      data-carrito
    >
      <div class="flex items-center justify-between border-b border-borde px-6 py-5">
        <div>
          <p class="eyebrow mb-1">Tu pedido</p>
          <h2 class="text-2xl font-black" id="titulo-carrito">Carrito</h2>
        </div>
        <button
          class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-borde text-cafe hover:border-cafe"
          type="button"
          data-carrito-cerrar
          aria-label="Cerrar carrito"
        >✕</button>
      </div>
      <ul class="flex-1 space-y-4 overflow-y-auto px-6 py-5" data-carrito-lista></ul>
      <div class="hidden flex-1 flex-col items-center justify-center gap-3 px-6 text-center" data-carrito-vacio>
        <span class="text-5xl" aria-hidden="true">☕</span>
        <p class="subtitulo">Tu carrito está vacío.</p>
        <a class="btn-borde btn-sm" href="<?= $base ?>tienda.php">Ir a la tienda</a>
      </div>
      <div class="space-y-4 border-t border-borde bg-white px-6 py-5">
        <div class="flex items-center justify-between">
          <span class="meta uppercase tracking-[0.2em]">Total</span>
          <span class="precio" data-carrito-total>$0</span>
        </div>
        <div class="flex gap-2">
          <button class="btn-borde btn-sm flex-1" type="button" data-carrito-vaciar>Vaciar</button>
          <button class="btn-cafe btn-sm flex-1" type="button" data-carrito-finalizar>Finalizar compra</button>
        </div>
      </div>
    </aside>
    <div
      class="pointer-events-none fixed bottom-6 left-1/2 z-[60] -translate-x-1/2 translate-y-4 rounded-full bg-espresso px-5 py-3 font-mono text-xs uppercase tracking-[0.15em] text-white opacity-0 shadow-xl transition duration-300"
      role="status"
      aria-live="polite"
      data-toast
    ></div>

    <script src="<?= $base ?>js/main.js"></script>
    <script src="<?= $base ?>js/app.js"></script>
  </body>
</html>
