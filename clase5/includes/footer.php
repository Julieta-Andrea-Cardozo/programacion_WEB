    <footer class="footer-barismo">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-4">
            <h2 class="h4 fst-italic"><?= e(APP_NAME) ?></h2>
            <p>Café de especialidad, arte latte y formación de baristas en el corazón de Palermo.</p>
          </div>
          <div class="col-6 col-lg-2">
            <h3>Explorar</h3>
            <ul class="list-unstyled">
              <li><a href="menu.php">Menú</a></li>
              <li><a href="galeria.php">Galería</a></li>
              <li><a href="talleres.php">Talleres</a></li>
              <li><a href="blog.php">Blog</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h3>Comprar</h3>
            <ul class="list-unstyled">
              <li><a href="tienda.php">Tienda</a></li>
              <li><a href="tecnicas.php">Técnicas</a></li>
              <li><a href="ubicacion.php">Ubicación</a></li>
              <li><a href="contacto.php">Contacto</a></li>
            </ul>
          </div>
          <div class="col-lg-4">
            <h3>Contacto</h3>
            <address class="mb-0">
              <?= e(APP_ADDRESS) ?><br />
              <a href="tel:<?= e(preg_replace('/[^0-9+]/', '', APP_PHONE)) ?>"><?= e(APP_PHONE) ?></a><br />
              <a href="mailto:<?= e(APP_EMAIL) ?>"><?= e(APP_EMAIL) ?></a><br />
              <a href="https://www.instagram.com/" target="_blank" rel="noopener">Instagram @barismo_arte</a>
            </address>
          </div>
        </div>
        <p class="copy mt-5 pt-3 mb-0 text-center">
          © <?= date('Y') ?> <?= e(APP_NAME) ?> · Trabajo práctico de Programación Web · Julieta Andrea Cardozo
<?php if (APP_ENV === 'local') : ?>
          · Entorno: <?= e(APP_ENV) ?>
<?php endif; ?>
        </p>
      </div>
    </footer>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <script src="js/main.js"></script>
  </body>
</html>
