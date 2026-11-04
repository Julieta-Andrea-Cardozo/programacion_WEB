@extends('layouts.app')

@section('titulo', 'Tienda')

@section('contenido')
  <section class="seccion" aria-labelledby="titulo-tienda">
    <div class="container">
      <p class="eyebrow">Tienda · Laravel</p>
      <h1 class="titulo-seccion" id="titulo-tienda">Productos</h1>
      <p class="subtitulo">Datos leídos con Eloquent desde la tabla productos</p>
      <div class="divisor" aria-hidden="true"></div>

      <form class="taller form-barismo p-4 mb-4" method="get" action="{{ route('productos.index') }}" role="search">
        <div class="row g-3 align-items-end">
          <div class="col-md-6">
            <label class="form-label" for="q">Buscar</label>
            <input class="form-control @error('q') is-invalid @enderror" type="search" id="q" name="q"
              value="{{ $busqueda }}" maxlength="60" placeholder="Ej: colombia, molino, chocolate..." />
            @error('q')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>
          <div class="col-md-3">
            <label class="form-label" for="categoria">Categoría</label>
            <select class="form-select" id="categoria" name="categoria">
              <option value="">Todo</option>
              @foreach ($categorias as $valor => $etiqueta)
                <option value="{{ $valor }}" @selected($categoria === $valor)>{{ $etiqueta }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-3 d-grid">
            <button class="btn btn-cafe" type="submit">Buscar</button>
          </div>
        </div>
      </form>

      <p class="meta">{{ $productos->count() }} producto(s)</p>

      <div class="row g-4">
        @forelse ($productos as $producto)
          <div class="col-sm-6 col-lg-3">
            <article class="card tarjeta h-100">
              <img src="{{ asset('img/' . ($producto->imagen ?: 'favicon.svg')) }}" alt="{{ $producto->nombre }}"
                width="500" height="500" loading="lazy" />
              <div class="card-body p-3 d-flex flex-column">
                <p class="meta mb-1">{{ $producto->meta }}</p>
                <h2 class="card-title h5 mb-1">{{ $producto->nombre }}</h2>
                <p class="estrellas mb-1" aria-label="{{ $producto->estrellas }} de 5 estrellas">{{ $producto->estrellas_texto }}</p>
                <p class="small fst-italic">{{ $producto->notas }}</p>
                <div class="d-flex justify-content-between align-items-center mt-auto">
                  <span class="precio fs-4">{{ $producto->precio_formateado }}</span>
                  <a class="btn btn-borde btn-sm" href="{{ route('productos.show', $producto) }}">Ver</a>
                </div>
              </div>
            </article>
          </div>
        @empty
          <div class="col-12">
            <p class="alert alert-warning mb-0">No encontramos productos para «{{ $busqueda }}».</p>
          </div>
        @endforelse
      </div>
    </div>
  </section>
@endsection
