# TP N° 10 — Refactorización a MVC e implementación con framework

## Parte A — MVC nativo (PHP puro)

Módulo refactorizado: CRUD de productos del panel de administración.

| Capa        | Ubicación                                   | Responsabilidad                                              |
| ----------- | ------------------------------------------- | ------------------------------------------------------------ |
| Modelo      | `app/Models/Producto.php`                   | Consultas SQL con PDO y prepared statements, validación      |
| Controlador | `app/Controllers/ProductoController.php`    | Recibe la petición, valida CSRF, usa el modelo, elige vista  |
| Vistas      | `app/Views/productos/`, `app/Views/layout/` | Solo HTML con los datos escapados                            |
| Entrada     | `admin/index.php?accion=index\|crear\|editar\|eliminar` | Front controller que despacha al controlador     |

Requiere la base `barismo` (`sql/barismo.sql` y `sql/usuarios.sql`) e iniciar sesión como admin
(`admin@barismo.com.ar` / `Barismo2026`).

```bash
php -S localhost:8000
# http://localhost:8000/login.php  →  http://localhost:8000/admin/index.php
```

## Parte B — Módulo en Laravel 12

Proyecto en [`laravel/`](laravel/): catálogo de productos con búsqueda y detalle.

- **Rutas:** `routes/web.php` → `GET /productos` y `GET /productos/{producto}`.
- **Controlador:** `app/Http/Controllers/ProductoController.php`.
- **Modelo:** `app/Models/Producto.php` (Eloquent, scopes `buscar()` y `deCategoria()`).
- **Vistas:** `resources/views/productos/index.blade.php` y `show.blade.php` (Blade).

Instalación y tests en [`laravel/README.md`](laravel/README.md).
