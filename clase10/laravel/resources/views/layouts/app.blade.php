<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('titulo', 'Tienda') · {{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('img/favicon.svg') }}" type="image/svg+xml" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=DM+Mono:wght@400;500&family=Inter:wght@300;400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
  </head>
  <body>
    <header class="navbar navbar-expand-lg sticky-top">
      <div class="container">
        <a class="navbar-brand" href="{{ route('productos.index') }}">Barismo &amp; Café</a>
        <span class="meta">Módulo Laravel {{ app()->version() }}</span>
      </div>
    </header>

    <main id="contenido">
      @yield('contenido')
    </main>

    <footer class="py-4 text-center meta">
      {{ config('app.name') }} · TP10 Patrón MVC con Laravel
    </footer>
  </body>
</html>
