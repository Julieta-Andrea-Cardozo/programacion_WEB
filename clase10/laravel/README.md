# Barismo & Café — módulo Laravel (TP N° 10)

Catálogo de productos de la tienda hecho con Laravel 12 siguiendo MVC: rutas en `routes/web.php`,
controlador `ProductoController`, modelo Eloquent `Producto` y vistas Blade en
`resources/views/productos/`. Usa la misma tabla `productos` del TP7 (base `barismo`).

## Requisitos

- PHP 8.2 o superior (XAMPP 8.2+ / Laragon) con `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`
- [Composer](https://getcomposer.org/)
- MySQL/MariaDB con la base `barismo` (importar `clase7/sql/barismo.sql`)

## Instalación

```bash
cd clase10/laravel
composer install
cp .env.example .env        # en Windows: copy .env.example .env
php artisan key:generate
php artisan migrate         # crea productos solo si no existe (no toca los datos del TP7)
php artisan serve
```

Abrir <http://127.0.0.1:8000/productos>.

Los datos de conexión están en `.env` (por defecto `DB_DATABASE=barismo`, usuario `root` sin
contraseña, como en XAMPP).

## Rutas

| Método | URI                     | Nombre            | Acción                         |
| ------ | ----------------------- | ----------------- | ------------------------------ |
| GET    | `/`                     | —                 | Redirige a `/productos`        |
| GET    | `/productos`            | `productos.index` | Listado; filtros `?q=` y `?categoria=grano\|insumo` |
| GET    | `/productos/{producto}` | `productos.show`  | Detalle (404 si no existe)     |

## Tests

```bash
php artisan test
```

Usan SQLite en memoria (`phpunit.xml`), no necesitan MySQL.
