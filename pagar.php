<?php
$titulo_pagina = 'Pagar';
$descripcion_pagina = 'Finalizá tu compra en Barismo & Café con tarjeta de débito o Mercado Pago.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
require_once __DIR__ . '/data/catalogo.php';

// Los precios salen del servidor (catálogo + base de datos), nunca del navegador.
$catalogo = [];
foreach (array_merge($granos, $insumos) as $producto) {
    $catalogo[$producto['nombre']] = ['precio' => (int) $producto['precio'], 'img' => 'img/' . $producto['img']];
}
try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    foreach ($pdo->query('SELECT nombre, precio, imagen FROM productos') as $fila) {
        $catalogo[$fila['nombre']] = ['precio' => (int) $fila['precio'], 'img' => $fila['imagen']];
    }
} catch (PDOException $e) {
    // Sin base de datos se usa solo el catálogo estático.
}

$metodos = ['debito' => 'Tarjeta de débito', 'mercadopago' => 'Mercado Pago'];
$datos = ['nombre' => '', 'email' => '', 'metodo' => 'debito', 'titular' => '', 'vencimiento' => '', 'dni' => ''];
$errores = [];
$items = [];
$total = 0;
$pedido = null;
$paso_mp = false;

if ($_SERVER['REQUEST_METHOD'] !== 'POST' && usuario_logueado()) {
    $datos['nombre'] = (string) $_SESSION['usuario_nombre'];
    try {
        $stmt = $pdo->prepare('SELECT email FROM usuarios WHERE id = :id');
        $stmt->execute([':id' => $_SESSION['usuario_id']]);
        $datos['email'] = (string) $stmt->fetchColumn();
    } catch (Throwable $e) {
        // Sin base de datos se completa solo el nombre.
    }
}

function luhn_valido(string $numero): bool
{
    $suma = 0;
    foreach (array_reverse(str_split($numero)) as $i => $digito) {
        $d = (int) $digito * ($i % 2 ? 2 : 1);
        $suma += $d > 9 ? $d - 9 : $d;
    }

    return $suma % 10 === 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach (array_keys($datos) as $campo) {
        $datos[$campo] = trim((string) (filter_input(INPUT_POST, $campo) ?? ''));
    }

    $carrito = json_decode((string) (filter_input(INPUT_POST, 'carrito') ?? ''), true);
    foreach (is_array($carrito) ? $carrito : [] as $item) {
        $nombre = is_array($item) ? (string) ($item['nombre'] ?? '') : '';
        $cantidad = is_array($item) ? (int) ($item['cantidad'] ?? 0) : 0;
        if (isset($catalogo[$nombre]) && $cantidad > 0 && $cantidad <= 99) {
            $items[] = ['nombre' => $nombre, 'cantidad' => $cantidad, 'precio' => $catalogo[$nombre]['precio']];
            $total += $catalogo[$nombre]['precio'] * $cantidad;
        } else {
            $errores['general'] = 'Hay productos del carrito que ya no están disponibles o superan las 99 unidades. Quitalos y volvé a intentar.';
        }
    }

    if (!csrf_valido()) {
        $errores['general'] = 'La sesión expiró. Recargá la página e intentá de nuevo.';
    }
    if (!$items && !isset($errores['general'])) {
        $errores['general'] = 'Tu carrito está vacío. Agregá productos desde la tienda.';
    }
    if (largo($datos['nombre']) < 3) {
        $errores['nombre'] = 'Ingresá tu nombre (mínimo 3 letras).';
    }
    if (!filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'Ingresá un email válido.';
    }
    if (!array_key_exists($datos['metodo'], $metodos)) {
        $errores['metodo'] = 'Elegí un medio de pago.';
        $datos['metodo'] = 'debito';
    }

    $ultimos = '';
    if ($datos['metodo'] === 'debito') {
        $numero = preg_replace('/\D/', '', (string) (filter_input(INPUT_POST, 'numero') ?? ''));
        $cvv = (string) (filter_input(INPUT_POST, 'cvv') ?? '');
        if (largo($datos['titular']) < 3) {
            $errores['titular'] = 'Ingresá el nombre como figura en la tarjeta.';
        }
        if (strlen($numero) !== 16 || !luhn_valido($numero)) {
            $errores['numero'] = 'El número de tarjeta no es válido (16 dígitos).';
        }
        if (!preg_match('/^(0[1-9]|1[0-2])\/(\d{2})$/', $datos['vencimiento'], $m)) {
            $errores['vencimiento'] = 'Usá el formato MM/AA.';
        } elseif (mktime(0, 0, 0, (int) $m[1] + 1, 1, 2000 + (int) $m[2]) <= time()) {
            $errores['vencimiento'] = 'La tarjeta está vencida.';
        }
        if (!preg_match('/^\d{3}$/', $cvv)) {
            $errores['cvv'] = 'El código de seguridad tiene 3 dígitos.';
        }
        if (!preg_match('/^\d{7,8}$/', $datos['dni'])) {
            $errores['dni'] = 'Ingresá un DNI de 7 u 8 dígitos, sin puntos.';
        }
        $ultimos = substr($numero, -4);
    }

    if (!$errores) {
        if ($datos['metodo'] === 'mercadopago' && filter_input(INPUT_POST, 'mp_confirmado') !== '1') {
            $paso_mp = true;
        } else {
            $pedido = [
                'numero' => 'BC-' . strtoupper(bin2hex(random_bytes(3))),
                'metodo' => $datos['metodo'] === 'debito' ? "Tarjeta de débito terminada en {$ultimos}" : 'Mercado Pago',
            ];
        }
    }
}

$clase_campo = fn (string $campo): string => isset($errores[$campo]) ? ' is-invalid' : '';
$campos_ocultos = function () use ($datos): void {
    foreach (['nombre', 'email', 'metodo'] as $campo) {
        echo '<input type="hidden" name="' . $campo . '" value="' . e($datos[$campo]) . '" />' . "\n";
    }
    echo '<input type="hidden" name="carrito" value="' . e((string) (filter_input(INPUT_POST, 'carrito') ?? '')) . '" />' . "\n";
    echo '<input type="hidden" name="csrf" value="' . e(token_csrf()) . '" />' . "\n";
};
?>
    <main id="contenido">
<?php if ($pedido) : ?>
      <section class="seccion bg-crema" aria-labelledby="titulo-ok" data-compra-ok>
        <div class="contenedor max-w-2xl">
          <div class="rounded-[2rem] border border-borde bg-white p-8 text-center shadow-sm">
            <span class="mx-auto mb-4 grid h-16 w-16 place-items-center rounded-full bg-emerald-100 text-3xl text-emerald-700" aria-hidden="true">✓</span>
            <p class="eyebrow">Pago aprobado</p>
            <h1 class="titulo-seccion text-4xl" id="titulo-ok">¡Gracias, <?= e($datos['nombre']) ?>!</h1>
            <p class="subtitulo">Tu pedido <strong class="font-mono not-italic"><?= e($pedido['numero']) ?></strong> está confirmado.</p>
            <ul class="my-6 divide-y divide-borde text-left">
<?php foreach ($items as $item) : ?>
              <li class="flex justify-between py-2">
                <span><?= (int) $item['cantidad'] ?> × <?= e($item['nombre']) ?></span>
                <span class="font-titulo font-bold"><?= precio($item['precio'] * $item['cantidad']) ?></span>
              </li>
<?php endforeach; ?>
              <li class="flex justify-between py-3">
                <span class="meta uppercase tracking-[0.2em]">Total</span>
                <span class="precio"><?= precio($total) ?></span>
              </li>
            </ul>
            <p class="meta mb-1">Pagado con <?= e($pedido['metodo']) ?></p>
            <p class="meta mb-6">Te enviamos el comprobante a <?= e($datos['email']) ?></p>
            <a class="btn-cafe" href="tienda.php">Volver a la tienda</a>
          </div>
        </div>
      </section>
<?php elseif ($paso_mp) : ?>
      <section class="seccion bg-[#f5f5f5]" aria-labelledby="titulo-mp" data-pagar-mp>
        <div class="contenedor max-w-lg">
          <div class="overflow-hidden rounded-3xl bg-white shadow-lg">
            <div class="flex items-center gap-3 bg-[#009ee3] px-6 py-5 text-white">
              <span class="grid h-10 w-10 place-items-center rounded-full bg-white font-bold text-[#009ee3]" aria-hidden="true">MP</span>
              <div>
                <p class="mb-0 text-sm opacity-80">Checkout de</p>
                <h1 class="mb-0 font-sans text-xl font-semibold text-white" id="titulo-mp">Mercado Pago</h1>
              </div>
            </div>
            <div class="space-y-4 p-6">
              <p class="mb-0 text-suave">Estás pagando a <strong><?= e(APP_NAME) ?></strong></p>
              <p class="mb-0 font-sans text-4xl font-semibold text-[#333]"><?= precio($total) ?></p>
              <div class="rounded-2xl border border-gray-200 p-4">
                <p class="mb-1 font-semibold">Dinero disponible en Mercado Pago</p>
                <p class="mb-0 text-sm text-suave">Cuenta: <?= e($datos['email']) ?></p>
              </div>
              <form method="post" action="pagar.php">
<?php $campos_ocultos(); ?>
                <input type="hidden" name="mp_confirmado" value="1" />
                <button class="w-full rounded-xl bg-[#009ee3] px-6 py-3 font-semibold text-white transition hover:bg-[#007eb5]" type="submit">Pagar <?= precio($total) ?></button>
              </form>
              <form method="get" action="pagar.php">
                <button class="w-full rounded-xl px-6 py-3 font-semibold text-[#009ee3] hover:bg-sky-50" type="submit">Volver a Barismo &amp; Café</button>
              </form>
            </div>
          </div>
        </div>
      </section>
<?php else : ?>
      <section class="seccion bg-crema" aria-labelledby="titulo-pagar">
        <div class="contenedor">
          <p class="eyebrow">Checkout</p>
          <h1 class="titulo-seccion" id="titulo-pagar">Finalizar compra</h1>
          <p class="subtitulo">Elegí cómo querés pagar</p>
          <div class="divisor" aria-hidden="true"></div>
<?php if (isset($errores['general'])) : ?>
          <div class="alerta alerta-danger" role="alert"><?= e($errores['general']) ?></div>
<?php elseif ($errores) : ?>
          <div class="alerta alerta-danger" role="alert">Revisá los campos marcados.</div>
<?php endif; ?>
          <form class="grid gap-6 lg:grid-cols-12" method="post" action="pagar.php" novalidate data-pagar data-precios="<?= e(json_encode(array_map(fn ($p) => $p['precio'], $catalogo), JSON_UNESCAPED_UNICODE)) ?>">
            <input type="hidden" name="csrf" value="<?= e(token_csrf()) ?>" />
            <input type="hidden" name="carrito" value="" data-pagar-carrito />
            <div class="space-y-6 lg:col-span-7">
              <div class="panel" role="group" aria-labelledby="paso-datos">
                <div class="mb-4 flex flex-wrap items-baseline justify-between gap-2">
                  <h2 class="eyebrow mb-0" id="paso-datos">1 · Tus datos</h2>
<?php if (usuario_logueado()) : ?>
                  <span class="meta">Sesión iniciada como <?= e($_SESSION['usuario_nombre']) ?></span>
<?php else : ?>
                  <a class="meta font-medium text-cafe" href="login.php?volver=pagar">¿Tenés cuenta? Ingresá →</a>
<?php endif; ?>
                </div>
                <div class="grid gap-5 sm:grid-cols-2">
                  <div>
                    <label class="campo-label" for="nombre">Nombre y apellido</label>
                    <input class="campo<?= $clase_campo('nombre') ?>" type="text" id="nombre" name="nombre" value="<?= e($datos['nombre']) ?>" autocomplete="name" required />
                    <div class="invalid-feedback"><?= e($errores['nombre'] ?? '') ?></div>
                  </div>
                  <div>
                    <label class="campo-label" for="email">Email</label>
                    <input class="campo<?= $clase_campo('email') ?>" type="email" id="email" name="email" value="<?= e($datos['email']) ?>" autocomplete="email" required />
                    <div class="invalid-feedback"><?= e($errores['email'] ?? '') ?></div>
                  </div>
                </div>
              </div>

              <div class="panel" role="radiogroup" aria-labelledby="paso-pago">
                <h2 class="eyebrow mb-4" id="paso-pago">2 · Medio de pago</h2>
                <div class="grid gap-3 sm:grid-cols-2">
<?php foreach ($metodos as $valor => $texto) : ?>
                  <label class="flex cursor-pointer items-center gap-3 rounded-2xl border-2 border-borde bg-white p-4 transition has-[:checked]:border-cafe has-[:checked]:bg-crema">
                    <input class="h-4 w-4 accent-cafe" type="radio" name="metodo" value="<?= e($valor) ?>"<?= $datos['metodo'] === $valor ? ' checked' : '' ?> data-metodo />
<?php if ($valor === 'debito') : ?>
                    <span class="grid h-9 w-12 place-items-center rounded-md bg-espresso text-xs font-bold text-crema" aria-hidden="true">DÉB</span>
<?php else : ?>
                    <span class="grid h-9 w-12 place-items-center rounded-md bg-[#009ee3] text-xs font-bold text-white" aria-hidden="true">MP</span>
<?php endif; ?>
                    <span class="font-semibold"><?= e($texto) ?></span>
                  </label>
<?php endforeach; ?>
                </div>

                <div class="mt-6 grid gap-5 sm:grid-cols-6" data-panel-metodo="debito"<?= $datos['metodo'] === 'debito' ? '' : ' hidden' ?>>
                  <div class="sm:col-span-6">
                    <label class="campo-label" for="numero">Número de tarjeta</label>
                    <input class="campo font-mono<?= $clase_campo('numero') ?>" type="text" id="numero" name="numero" inputmode="numeric" autocomplete="off" placeholder="0000 0000 0000 0000" maxlength="19" data-tarjeta />
                    <div class="invalid-feedback"><?= e($errores['numero'] ?? '') ?></div>
                  </div>
                  <div class="sm:col-span-6">
                    <label class="campo-label" for="titular">Nombre del titular</label>
                    <input class="campo<?= $clase_campo('titular') ?>" type="text" id="titular" name="titular" value="<?= e($datos['titular']) ?>" autocomplete="off" placeholder="Como figura en la tarjeta" />
                    <div class="invalid-feedback"><?= e($errores['titular'] ?? '') ?></div>
                  </div>
                  <div class="sm:col-span-2">
                    <label class="campo-label" for="vencimiento">Vencimiento</label>
                    <input class="campo font-mono<?= $clase_campo('vencimiento') ?>" type="text" id="vencimiento" name="vencimiento" value="<?= e($datos['vencimiento']) ?>" inputmode="numeric" autocomplete="off" placeholder="MM/AA" maxlength="5" data-vencimiento />
                    <div class="invalid-feedback"><?= e($errores['vencimiento'] ?? '') ?></div>
                  </div>
                  <div class="sm:col-span-2">
                    <label class="campo-label" for="cvv">Código</label>
                    <input class="campo font-mono<?= $clase_campo('cvv') ?>" type="password" id="cvv" name="cvv" inputmode="numeric" autocomplete="off" placeholder="123" maxlength="3" />
                    <div class="invalid-feedback"><?= e($errores['cvv'] ?? '') ?></div>
                  </div>
                  <div class="sm:col-span-2">
                    <label class="campo-label" for="dni">DNI del titular</label>
                    <input class="campo font-mono<?= $clase_campo('dni') ?>" type="text" id="dni" name="dni" value="<?= e($datos['dni']) ?>" inputmode="numeric" placeholder="Sin puntos" maxlength="8" />
                    <div class="invalid-feedback"><?= e($errores['dni'] ?? '') ?></div>
                  </div>
                </div>

                <div class="mt-6 rounded-2xl border border-sky-200 bg-sky-50 p-5 text-sky-900" data-panel-metodo="mercadopago"<?= $datos['metodo'] === 'mercadopago' ? '' : ' hidden' ?>>
                  <p class="mb-0">
                    Al confirmar te llevamos al checkout de <strong>Mercado Pago</strong> para pagar con
                    dinero en cuenta, tarjeta guardada o cuotas.
                  </p>
                </div>
              </div>
            </div>

            <aside class="lg:col-span-5">
              <div class="panel sticky top-28">
                <h2 class="mb-4 text-2xl font-bold">Tu pedido</h2>
                <ul class="mb-4 divide-y divide-borde" data-pagar-lista></ul>
                <p class="alerta alerta-warning" data-pagar-vacio hidden>
                  Tu carrito está vacío. <a class="font-semibold" href="tienda.php">Ir a la tienda</a>
                </p>
                <div class="mb-6 flex items-center justify-between border-t border-borde pt-4">
                  <span class="meta uppercase tracking-[0.2em]">Total</span>
                  <span class="precio" data-pagar-total>$0</span>
                </div>
                <button class="btn-cafe w-full" type="submit" data-pagar-boton>Pagar</button>
              </div>
            </aside>
          </form>
        </div>
      </section>
<?php endif; ?>
    </main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
