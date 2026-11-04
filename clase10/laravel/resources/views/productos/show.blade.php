@extends('layouts.app')

@section('titulo', $producto->nombre)

@section('contenido')
  <section class="seccion seccion-papel" aria-labelledby="titulo-producto">
    <div class="container">
      <p class="eyebrow">{{ \App\Models\Producto::CATEGORIAS[$producto->categoria] ?? $producto->categoria }}</p>
      <h1 class="titulo-seccion" id="titulo-producto">{{ $producto->nombre }}</h1>
      <p class="subtitulo">{{ $producto->meta }}</p>
      <div class="divisor" aria-hidden="true"></div>

      <div class="row g-4 align-items-center">
        <div class="col-md-5">
          <img class="img-fluid" src="{{ asset('img/' . ($producto->imagen ?: 'favicon.svg')) }}"
            alt="{{ $producto->nombre }}" width="500" height="500" />
        </div>
        <div class="col-md-7">
          <p class="estrellas fs-4" aria-label="{{ $producto->estrellas }} de 5 estrellas">{{ $producto->estrellas_texto }}</p>
          <p class="fst-italic">{{ $producto->notas }}</p>
          <p class="precio fs-2">{{ $producto->precio_formateado }}</p>
          <a class="btn btn-borde" href="{{ route('productos.index') }}">Volver a la tienda</a>
        </div>
      </div>
    </div>
  </section>
@endsection
