# TP Diseño Web — Café y Arte Latte

Trabajo práctico de Programación Web. Tema elegido: sitio web para mostrar datos del barismo, el arte latte y el café.

> El tema no se puede cambiar en el transcurso del año. Cualquier modificación debe reflejarse en toda la documentación.

## Barismo & Café — Maqueta web (TP N° 3)

Sitio estático de **Barismo & Café**, una cafetería de especialidad dedicada al barismo, al arte
latte y a la formación de baristas. Las 10 vistas se maquetaron en HTML5 + Bootstrap 5 a partir
de los wireframes de Figma.

- **Diseño en Figma:** [Site Map and Wireframe](https://www.figma.com/make/uKNA9mewDLy8gzO9RdJhTZ/Site-Map-and-Wireframe?t=ofV6AHS95d6uyXOT-1&preview-route=%2F%23galer%25C3%ADa)
- **Sitio publicado (GitHub Pages):** https://julieta-andrea-cardozo.github.io/programacion_WEB/
- **Auditoría de Lighthouse y Prettier:** [docs/auditoria-lighthouse.md](docs/auditoria-lighthouse.md)

### Tecnologías

| Tecnología                      | Uso                                                                    |
| ------------------------------- | ---------------------------------------------------------------------- |
| HTML5 semántico                 | Estructura de las 10 vistas                                            |
| CSS3 (variables, grid, flexbox) | Estilos propios en `css/styles.css`                                    |
| Bootstrap 5.3.3 (CDN)           | Grilla responsive, navbar colapsable, pestañas, collapse y formularios |
| JavaScript                      | Carrito con `localStorage` y validación del formulario (`js/main.js`)  |
| Google Fonts                    | Playfair Display, Inter y DM Mono                                      |
| Prettier 3                      | Formateo del código                                                    |
| Lighthouse                      | Auditoría de accesibilidad, rendimiento, buenas prácticas y SEO        |
| Git + GitHub + GitHub Pages     | Control de versiones y despliegue                                      |

### Vistas

| #   | Vista     | Archivo          | Contenido                                                 |
| --- | --------- | ---------------- | --------------------------------------------------------- |
| 1   | Inicio    | `index.html`     | Hero, sobre nosotros, accesos destacados y testimonios    |
| 2   | Menú      | `menu.html`      | Cafés de especialidad y tabla de acompañamientos          |
| 3   | Galería   | `galeria.html`   | Galería de diseños de arte latte                          |
| 4   | Equipo    | `equipo.html`    | Perfiles de los baristas                                  |
| 5   | Talleres  | `talleres.html`  | Talleres de barismo con nivel, fecha y precio             |
| 6   | Blog      | `blog.html`      | Notas destacadas desplegables                             |
| 7   | Tienda    | `tienda.html`    | Café en grano e insumos para cafetera con carrito         |
| 8   | Técnicas  | `tecnicas.html`  | Pestañas con el paso a paso de corazón, tulipán y rosetta |
| 9   | Ubicación | `ubicacion.html` | Mapa embebido, horarios y datos de contacto               |
| 10  | Contacto  | `contacto.html`  | Formulario con validación y casillas de contacto          |

### Estructura del proyecto

```
programacion_WEB/
├── index.html … contacto.html   # 10 vistas
├── css/styles.css               # estilos personalizados
├── js/main.js                   # interacciones
├── img/                         # imágenes y favicon
├── docs/                        # auditoría Lighthouse y capturas
├── .prettierrc / .prettierignore
└── package.json                 # scripts de Prettier
```

### Ejecución local

```bash
git clone https://github.com/Julieta-Andrea-Cardozo/programacion_WEB.git
cd programacion_WEB
npm install            # instala Prettier (opcional)
python3 -m http.server 8080
# abrir http://localhost:8080
```

También se puede abrir `index.html` directamente en el navegador o usar _Live Server_ de VS Code.

### Flujo de trabajo con Git

1. `git init` y estructura base `css/`, `js/`, `img/`.
2. Rama de trabajo `feature/maquetacion`.
3. Maquetación de las 10 vistas con Bootstrap y estilos propios.
4. Formateo con Prettier y auditoría de Lighthouse (ver `docs/auditoria-lighthouse.md`).
5. `git push origin feature/maquetacion` y Pull Request hacia `main`.
6. Merge del Pull Request.
7. Despliegue en GitHub Pages.

### Capturas

| Inicio                                  | Menú                                    |
| --------------------------------------- | --------------------------------------- |
| ![Inicio](docs/capturas/index.png)      | ![Menú](docs/capturas/menu.png)         |
| **Galería**                             | **Tienda**                              |
| ![Galería](docs/capturas/galeria.png)   | ![Tienda](docs/capturas/tienda.png)     |
| **Técnicas**                            | **Contacto**                            |
| ![Técnicas](docs/capturas/tecnicas.png) | ![Contacto](docs/capturas/contacto.png) |

## Migración a PHP, modularización (SSI) y renderizado server-side (TP N° 4)

En la rama `feature/migracion-php-ssi` las 10 vistas pasaron de `.html` a `.php`. El código
repetido (cabecera, navegación y pie) se extrajo a `includes/`, y el servidor arma cada página
antes de enviarla al navegador.

### Qué cambió

| Requisito               | Implementación                                                                                                                                                                   |
| ----------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| Vistas en PHP           | `index.php`, `menu.php`, `galeria.php`, `equipo.php`, `talleres.php`, `blog.php`, `tienda.php`, `tecnicas.php`, `ubicacion.php`, `contacto.php`                                  |
| Modularización (SSI)    | `includes/header.php`, `includes/nav.php` e `includes/footer.php` incluidos con `require_once`                                                                                   |
| Título dinámico         | Cada vista define `$titulo_pagina` (y `$descripcion_pagina`) antes de incluir el header, que imprime `<title><?= e($titulo_pagina) ?> \| <?= e(APP_NAME) ?></title>`             |
| Navegación activa       | `nav.php` recorre un arreglo de páginas y compara con `basename($_SERVER['SCRIPT_NAME'], '.php')` para agregar la clase `active` y `aria-current="page"`                         |
| Variables de entorno    | `config/config.php` lee `.env` y define `APP_NAME`, `APP_EMAIL`, `APP_PHONE`, `APP_ADDRESS` y `APP_ENV`. `.env` está en `.gitignore`; en el repo solo se versiona `.env.example` |
| Renderizado server-side | El menú y la tienda se generan con `foreach` sobre el catálogo `data/catalogo.php`. El año del footer sale de `date('Y')`                                                        |
| Formulario              | `contacto.php` valida el envío `POST` en el servidor, conserva los datos cargados, muestra los errores y escapa la salida con `htmlspecialchars`                                 |
| Seguridad               | `.htaccess` bloquea el acceso a `.env`, `.git`, `includes/`, `config/` y `data/`                                                                                                 |

Ejemplo de vista:

```php
<?php
$titulo_pagina = 'Menú';
$descripcion_pagina = 'Menú de cafés de especialidad de Barismo & Café.';

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/nav.php';
require_once __DIR__ . '/data/catalogo.php';
?>
<main id="contenido">
  <?php foreach ($bebidas as $bebida) : ?> ... <?php endforeach; ?>
</main>
<?php require_once __DIR__ . '/includes/footer.php'; ?>
```

### Estructura (versión PHP)

```
programacion_WEB/
├── index.php … contacto.php   # 10 vistas PHP
├── includes/
│   ├── header.php             # <head> con título dinámico
│   ├── nav.php                # navegación con página activa
│   ├── footer.php             # pie con datos del .env
│   └── producto.php           # tarjeta de producto reutilizable
├── config/config.php          # carga de .env y constantes
├── data/catalogo.php          # bebidas, granos e insumos
├── css/ js/ img/ docs/
├── .env.example               # plantilla de configuración
└── .htaccess                  # reglas de Apache
```

### Instalación y ejecución local

1. Requisitos: PHP 8.0 o superior. Sirve XAMPP, Laragon o el servidor integrado de PHP.
2. Clonar el repositorio y crear el archivo de entorno:

   ```bash
   git clone https://github.com/Julieta-Andrea-Cardozo/programacion_WEB.git
   cd programacion_WEB
   cp .env.example .env      # en Windows: copy .env.example .env
   ```

3. Levantar el sitio con una de estas opciones:
   - **Servidor integrado de PHP:** `php -S localhost:8000` y abrir http://localhost:8000
   - **XAMPP:** copiar la carpeta en `C:\xampp\htdocs\programacion_WEB`, iniciar Apache y abrir
     http://localhost/programacion_WEB/
   - **Laragon:** copiar la carpeta en `C:\laragon\www\programacion_WEB`, iniciar todo y abrir
     http://programacion_WEB.test/ o http://localhost/programacion_WEB/

Variables disponibles en `.env`:

| Variable      | Ejemplo                       | Uso                                                                  |
| ------------- | ----------------------------- | -------------------------------------------------------------------- |
| `APP_NAME`    | `Barismo & Café`              | Marca, título y footer                                               |
| `APP_EMAIL`   | `hola@barismo.com.ar`         | Email de soporte (contacto y footer)                                 |
| `APP_PHONE`   | `+54 11 4832-1650`            | Teléfono del footer                                                  |
| `APP_ADDRESS` | `Thames 1650, Palermo · CABA` | Dirección del footer                                                 |
| `APP_ENV`     | `local`                       | Con `local` se muestran los errores de PHP y el entorno en el footer |

### Evidencias de funcionamiento

Probado con PHP 8.1 en Apache (`http://localhost/programacion_WEB/`) y con `php -S localhost:8000`.
Lighthouse en escritorio, sobre las 10 vistas PHP: **100** en Rendimiento, Accesibilidad,
Buenas prácticas y SEO.

| Servidor y títulos dinámicos                                       | Navegación activa (Menú)                                    |
| ------------------------------------------------------------------ | ----------------------------------------------------------- |
| ![Servidor PHP y títulos](docs/capturas/php/terminal-servidor.png) | ![Menú](docs/capturas/php/navegador-menu.png)               |
| **Tienda renderizada con PHP**                                     | **Formulario procesado en el servidor**                     |
| ![Tienda](docs/capturas/php/navegador-tienda.png)                  | ![Contacto enviado](docs/capturas/php/contacto-enviado.png) |
| **HTML generado por el servidor**                                  | **`.env` bloqueado (403)**                                  |
| ![Código fuente](docs/capturas/php/codigo-fuente-tienda.png)       | ![.env bloqueado](docs/capturas/php/env-bloqueado.png)      |

## Procesamiento de formularios con POST y GET (Clase 5)

Todo el desarrollo de esta entrega está en la carpeta [`clase5/`](clase5/), que contiene el sitio
completo en PHP. Se incorporaron dos interacciones de formulario que capturan y procesan datos en
el servidor, con sanitización estricta para prevenir XSS (OWASP Top 10).

### Formulario POST — `contacto.php`

Formulario de contacto (nombre, email, asunto y mensaje) que se envía por `POST` a la misma vista:

- **Sanitización:** cada campo se lee con `filter_input(INPUT_POST, ...)` y `trim()`, y toda la
  salida se escapa con `htmlspecialchars()` (función `e()` de `config/config.php`), por lo que un
  envío como `<script>alert(1)</script>` se muestra como texto y nunca se ejecuta.
- **Validación en el servidor:** nombre con mínimo 3 letras, email con
  `filter_var(..., FILTER_VALIDATE_EMAIL)`, asunto contra una lista blanca y mensaje con mínimo
  10 caracteres.
- **Retroalimentación:** los errores se muestran debajo de cada campo y en un aviso general; si el
  envío es válido aparece un mensaje de éxito con el nombre recibido.
- **Persistencia:** ante errores, los campos conservan lo que el usuario ya había cargado.

### Formulario GET — buscador en `tienda.php`

Buscador de productos (`?q=`) con filtro por categoría (`?tipo=`), que viaja por `GET` en la URL y
permite compartir el enlace de la búsqueda:

- **Sanitización:** `q` y `tipo` se leen con `filter_input(INPUT_GET, ...)` y `trim()`; el término
  se muestra escapado en el input y en el mensaje de resultado, por lo que no es posible inyectar
  scripts (ver captura de XSS).
- **Validación en el servidor:** `q` no puede llegar vacío ni superar los 60 caracteres; `tipo` se
  valida contra una lista blanca (`todo`, `granos`, `insumos`).
- **Retroalimentación:** informa cuántos productos se encontraron para el término, o un aviso cuando
  no hay coincidencias.
- **Persistencia:** el término buscado y la categoría elegida quedan cargados en el formulario.

### Capturas

| Búsqueda con resultados (GET)                                    | Sin resultados                                                            |
| ---------------------------------------------------------------- | ------------------------------------------------------------------------- |
| ![Búsqueda](clase5/docs/capturas/busqueda.png)                   | ![Sin resultados](clase5/docs/capturas/busqueda-sin-resultados.png)       |
| **XSS sanitizado: el script se muestra como texto**              | **Errores de validación con datos conservados (POST)**                    |
| ![XSS sanitizado](clase5/docs/capturas/busqueda-xss.png)         | ![Errores](clase5/docs/capturas/contacto-errores.png)                     |
| **Envío exitoso (POST)**                                         |                                                                           |
| ![Éxito](clase5/docs/capturas/contacto-ok.png)                   |                                                                           |

### Ejecución local

```bash
cd clase5
cp .env.example .env   # en Windows: copy .env.example .env
php -S localhost:8000  # abrir http://localhost:8000
```

## Persistencia PHP–MySQL: CRUD de productos (Clase 7)

Todo el desarrollo de esta entrega está en la carpeta [`clase7/`](clase7/), que contiene el sitio
completo en PHP más el módulo de administración conectado a MySQL. Se implementó un CRUD sobre la
tabla `productos` (granos e insumos de la tienda), integrado al layout del sitio y accesible desde el
enlace **Administrar** del footer.

### Componentes

| Componente              | Archivo                                     | Qué hace                                                                                    |
| ----------------------- | ------------------------------------------- | ------------------------------------------------------------------------------------------- |
| Conexión segura         | `config/conexion.php`                       | Instancia PDO con `try-catch` (`PDOException`), credenciales desde `.env`                     |
| Listado (Read)          | `admin/index.php`                           | Tabla con todos los productos, consulta preparada `SELECT`, avisos de alta/baja/modificación |
| Alta (Create)           | `admin/crear.php`                           | Formulario validado en el servidor + `INSERT` preparado; redirige con `?status=created`      |
| Edición (Update)        | `admin/editar.php`                          | Carga el registro con `SELECT` preparado por `id` y guarda con `UPDATE` preparado            |
| Baja (Delete)           | `admin/eliminar.php`                        | Solo acepta `POST` con `id` entero validado; `DELETE` preparado; los enlaces GET no borran   |
| Formulario compartido   | `admin/formulario.php` + `admin/funciones.php` | Campos, validación y sanitización reutilizados por crear y editar                          |
| Esquema y datos iniciales | `sql/barismo.sql`                         | `CREATE DATABASE` + `CREATE TABLE productos` + los 8 productos del catálogo                  |

### Seguridad aplicada

- **Consultas preparadas obligatorias:** todas las operaciones (SELECT, INSERT, UPDATE, DELETE)
  usan `$pdo->prepare()` con marcadores `:parametro`; ningún dato del usuario se concatena en el SQL.
- **Sanitización XSS:** toda variable impresa en las vistas sale por `htmlspecialchars()` (`e()`).
- **Validación en el servidor:** `filter_input`/`filter_var` para enteros, listas blancas para
  categoría y estrellas, largos máximos y formato de nombre de archivo para la imagen.
- **Persistencia de campos:** ante errores de validación el formulario conserva lo cargado.

### Instalación de la base de datos (XAMPP / Laragon)

1. Importar `clase7/sql/barismo.sql` desde phpMyAdmin, o por consola:
   `mysql -u root < sql/barismo.sql`
2. Configurar `.env` (los valores por defecto ya son los de XAMPP):

   ```
   DB_HOST=localhost
   DB_NAME=barismo
   DB_USER=root
   DB_PASS=
   ```

3. Abrir `admin/index.php` dentro del sitio (o el enlace **Administrar** del footer).

### Capturas

| Listado con aviso de alta                                        | Formulario de nuevo producto                                  |
| ---------------------------------------------------------------- | ------------------------------------------------------------- |
| ![Listado](clase7/docs/capturas/admin-listado.png)               | ![Crear](clase7/docs/capturas/admin-crear.png)                |
| **Edición con datos cargados**                                   | **Errores de validación en el servidor**                      |
| ![Editar](clase7/docs/capturas/admin-editar.png)                 | ![Errores](clase7/docs/capturas/admin-errores.png)            |

## Diseño del esquema relacional en MySQL (TP N° 6)

La carpeta [`tp6/`](tp6/) contiene el modelo de datos completo de Barismo & Café, en una base
separada (`barismo_tp6`) para no pisar la base `barismo` que usa el CRUD del TP7.

| Archivo                                         | Contenido                                                                                       |
| ----------------------------------------------- | ----------------------------------------------------------------------------------------------- |
| [`NORMALIZACION.md`](tp6/NORMALIZACION.md)   | Tabla sin normalizar, paso a 1FN, 2FN y 3FN, tablas finales con sus PK/FK y decisiones de diseño |
| [`schema.sql`](tp6/schema.sql)               | `CREATE DATABASE` + 10 tablas, claves foráneas, `CHECK`, índices y auditoría `created_at/updated_at` |
| [`consultas.sql`](tp6/consultas.sql)         | Datos iniciales, `SELECT` con filtros, `INNER JOIN`, `UPDATE` y `DELETE` con `WHERE`            |

Tablas: `roles`, `usuarios`, `categorias`, `productos`, `estados_pedido`, `pedidos`,
`detalle_pedidos` (N:M pedidos ↔ productos), `niveles`, `talleres` e `inscripciones`
(N:M usuarios ↔ talleres).

```bash
mysql -u root < tp6/schema.sql
mysql -u root < tp6/consultas.sql
```

En phpMyAdmin (XAMPP / Laragon): pestaña **Importar** → `schema.sql` y después `consultas.sql`.

## Sesiones y autenticación (TP N° 8)

Desarrollo en [`clase8/`](clase8/): el sitio del TP7 más registro, login, logout y control de acceso
por roles.

| Componente           | Archivo                     | Qué hace                                                                                   |
| -------------------- | --------------------------- | ------------------------------------------------------------------------------------------ |
| Tabla de usuarios    | `sql/usuarios.sql`          | `usuarios` con email `UNIQUE`, `password VARCHAR(255)`, rol `admin`/`usuario` y admin inicial |
| Sesión segura        | `config/sesion.php`         | Cookie `HttpOnly` + `SameSite=Lax`, `use_strict_mode`, helpers de rol y token CSRF          |
| Registro             | `registro.php`              | Valida y sanitiza, rechaza emails duplicados y guarda `password_hash()` (bcrypt)            |
| Login                | `login.php`                 | `password_verify()`, `session_regenerate_id(true)` y datos mínimos en `$_SESSION`           |
| Guardián de rutas    | `includes/auth_guard.php`   | Sin sesión → `login.php`; rol insuficiente (`$rol_requerido`) → `cuenta.php`                |
| Vistas protegidas    | `cuenta.php`, `admin_panel.php`, `admin/*` | Área del usuario; panel y CRUD solo para `admin`                         |
| Logout               | `logout.php`                | Vacía `$_SESSION`, borra la cookie de sesión y llama a `session_destroy()`                  |

**Instalación:** importar `clase7/sql/barismo.sql` y luego `clase8/sql/usuarios.sql`.
Usuario administrador de prueba: `admin@barismo.com.ar` / `Barismo2026` (las cuentas nuevas se crean
desde `registro.php` con rol `usuario`).

| Registro                                           | Error de login genérico                               |
| -------------------------------------------------- | ----------------------------------------------------- |
| ![Registro](clase8/docs/capturas/registro.png)     | ![Login](clase8/docs/capturas/login-error.png)        |
| **Área del usuario (`cuenta.php`)**                | **Usuario sin rol admin intentando entrar al panel**  |
| ![Cuenta](clase8/docs/capturas/cuenta-usuario.png) | ![Sin permiso](clase8/docs/capturas/usuario-sin-permiso.png) |
| **Panel de administración**                        | **Ruta protegida sin sesión**                         |
| ![Panel](clase8/docs/capturas/admin-panel.png)     | ![Acceso denegado](clase8/docs/capturas/acceso-denegado.png) |

## Comunicación asincrónica con Fetch API y JSON (TP N° 9)

Desarrollo en [`clase9/`](clase9/) (parte de la versión del TP8).

- **Endpoint** [`api/buscar_productos.php`](clase9/api/buscar_productos.php): responde solo JSON
  (`Content-Type: application/json; charset=utf-8`) con consultas preparadas PDO sobre `productos`.
  - `?q=texto` busca por nombre, notas u origen; `&categoria=grano|insumo` filtra; `?id=3` devuelve uno.
  - Códigos HTTP: `200` OK, `400` parámetros inválidos, `404` producto inexistente, `405` método no
    permitido, `500` error de base de datos.
  - Formato: `{"status":"success","total":2,"data":[...]}` o `{"status":"error","message":"..."}`.
- **Cliente** [`js/app.js`](clase9/js/app.js): en la tienda, el evento `input` del buscador (con
  espera de 300 ms) y el `submit` prevenido llaman a `fetch()` con `async/await`, controlan
  `response.ok`, parsean con `response.json()` y reemplazan solo el contenedor `#resultados`, sin
  recargar la página. Muestra mensajes de "buscando", sin resultados y errores de red/HTTP en una
  región `aria-live`. Las tarjetas se arman con `createElement` + `textContent` (sin `innerHTML`),
  así que los datos de la base no pueden inyectar HTML. Sin JavaScript, el formulario sigue
  funcionando por GET como en la Clase 5.

```bash
curl "http://localhost/programacion_WEB/clase9/api/buscar_productos.php?q=colombia"
```

| Búsqueda en vivo (sin recargar)                           | Respuesta JSON del endpoint                          |
| --------------------------------------------------------- | ---------------------------------------------------- |
| ![Búsqueda](clase9/docs/capturas/busqueda-en-vivo.png)    | ![JSON](clase9/docs/capturas/endpoint-json.png)      |

## Patrón MVC e introducción a frameworks (TP N° 10)

Desarrollo en [`clase10/`](clase10/), en dos partes.

### Parte 1 — Refactorización a MVC nativo

El CRUD de productos (antes `crear.php`, `editar.php`, `eliminar.php` con SQL y HTML mezclados) pasa a
un único punto de entrada y tres capas:

```
clase10/
├── admin/index.php                       # front controller: ?accion=index|crear|editar|eliminar
└── app/
    ├── bootstrap.php                     # sesión + autoload de clases App\*
    ├── Core/Database.php                 # conexión PDO única
    ├── Core/Controller.php               # render() de vistas y redirigir()
    ├── Models/Producto.php               # todo el SQL (consultas preparadas) y la validación
    ├── Controllers/ProductoController.php# recibe la petición, usa el modelo, elige la vista
    └── Views/
        ├── layout/header.php, footer.php
        └── productos/index.php, crear.php, editar.php, formulario.php   # solo HTML + e()
```

El controlador no escribe SQL ni HTML, el modelo no conoce la vista y las vistas solo imprimen
variables escapadas. Se mantienen el guardián de rol `admin` y el token CSRF del TP8.

### Parte 2 — Módulo en Laravel 12

[`clase10/laravel/`](clase10/laravel/) es un proyecto Laravel que lee la misma tabla `productos`:

| Capa        | Archivo                                               | Qué hace                                                        |
| ----------- | ----------------------------------------------------- | --------------------------------------------------------------- |
| Rutas       | `routes/web.php`                                      | `GET /productos` y `GET /productos/{producto}` (con nombre)     |
| Controlador | `app/Http/Controllers/ProductoController.php`         | Valida `q` y `categoria`, consulta con Eloquent, devuelve vistas |
| Modelo      | `app/Models/Producto.php`                             | Eloquent sobre `productos`, scopes `buscar()` y `deCategoria()` |
| Vistas      | `resources/views/layouts/app.blade.php`, `productos/*.blade.php` | Blade con la estética del sitio (escapado automático `{{ }}`) |
| Tests       | `tests/Feature/ProductoTest.php`                      | Listado, filtros, validación, detalle y 404                     |

Requiere PHP 8.2+ y Composer. Instrucciones en [`clase10/laravel/README.md`](clase10/laravel/README.md).

| MVC nativo: listado del CRUD                          | Laravel: búsqueda con Eloquent                            |
| ----------------------------------------------------- | --------------------------------------------------------- |
| ![MVC](clase10/docs/capturas/mvc-listado.png)         | ![Laravel](clase10/docs/capturas/laravel-busqueda.png)    |
| **MVC nativo: edición**                               | **Laravel: detalle de producto**                          |
| ![Editar](clase10/docs/capturas/mvc-editar.png)       | ![Detalle](clase10/docs/capturas/laravel-detalle.png)     |

---

# Documentación de diseño (TP anteriores)

## 1. Intereses personales

Me interesa en particular todo lo relacionado con el café de especialidad: la preparación del espresso, la textura de la leche y el arte latte. También me gusta el diseño gráfico aplicado a lo cotidiano (menús, cartelería, identidad visual de un local) y estoy en contacto permanente con la cultura de internet y las redes sociales.

## 2. Tema elegido

**Tema:** sitio web para mostrar datos del barismo, el arte latte y el café.

Elegí este tema porque combino conocimiento de gastronomía (experiencia como barista) con lo que estoy aprendiendo en la tecnicatura.

## 3. Sitios de referencia

| #   | Sitio                                                 | Qué es                                                                |
| --- | ----------------------------------------------------- | --------------------------------------------------------------------- |
| 1   | [Onyx Coffee Lab](https://onyxcoffeelab.com/)         | Tostadora y cadena de cafeterías de EE.UU., e-commerce + storytelling |
| 2   | [Blue Bottle Coffee](https://bluebottlecoffee.com/)   | Cadena de cafeterías, e-commerce minimalista                          |
| 3   | [Perfect Daily Grind](https://perfectdailygrind.com/) | Publicación/blog especializado en café                                |
| 4   | [Full City Coffee House](https://fullcity.com.ar/)    | Tostadora y cafetería de especialidad de Buenos Aires                 |
| 5   | [La Marzocco Home](https://home.lamarzoccousa.com/)   | Marca de máquinas de espresso, foco en producto + educación           |

### 1) Onyx Coffee Lab

**Positivos**

- Home muy narrativo: cada bloque combina video corto, imagen y un texto breve sobre el origen del café, así que vende y educa al mismo tiempo.
- Jerarquía de navegación clara (Tienda, Mayoristas, Ubicaciones, Aprender) que separa bien e-commerce de contenido educativo.
- Sección de premios y reconocimientos que construye autoridad de marca de un vistazo.

**Negativos**

- La home es larguísima, con muchos videos autoplay: carga pesada y hay que scrollear mucho para llegar al pie.
- Exceso de banners promocionales (colaboraciones, merchandising) que compiten entre sí por la atención.
- Al ser un sitio de e-commerce grande, no es un ejemplo simple de replicar para un TP académico.

### 2) Blue Bottle Coffee

**Positivos**

- Enfoque "menos es más": la home muestra un producto destacado, imagen simple y un botón de compra, sin ruido visual.
- Menú de navegación breve y directo a las secciones clave (Tienda, Suscripciones, Ubicaciones).
- Fuerte coherencia de marca (tipografía, paleta de color) en todas las páginas.

**Negativos**

- Analistas de UX señalan que la página de ubicaciones no promociona su propia app, una oportunidad desaprovechada.
- El menú de cafetería no siempre está visible desde el home, lo que dificulta a quien solo quiere ver qué se puede tomar en el local.
- El agrupamiento de productos en la tienda puede resultar confuso por la cantidad de variantes.

### 3) Perfect Daily Grind

**Positivos**

- Estructura de blog/revista muy ordenada: categorías claras (barista, tueste, producción, cafeterías).
- Cada artículo tiene "key takeaways" al inicio, ideal para quien busca información rápida sobre técnica.
- Newsletter y suscripción bien integradas sin ser invasivas.

**Negativos**

- Al ser un sitio con miles de artículos, la búsqueda y el filtrado pueden quedar cortos para encontrar contenido específico.
- Diseño visual más funcional que atractivo, con poco uso de imágenes propias grandes.
- Mucho texto por página, lo que puede resultar denso para un lector que solo quiere una guía rápida.

### 4) Full City Coffee House

**Positivos**

- Sitio simple y liviano, fácil de tomar como referencia de estructura para un TP (Tienda, Mayoristas, Trainers, Quiénes somos).
- Buena combinación de e-commerce (venta de café) y presentación del local físico con mapa embebido.
- Identidad visual coherente con el local real, útil como ejemplo "de escala real" y no una multinacional.

**Negativos**

- Pocas imágenes de arte latte o del proceso de barismo, algo débil para un sitio que se supone gira en torno al café de especialidad.
- Estructura de menú algo escueta; le faltan secciones de contenido educativo o blog.
- El footer repite enlaces que ya están en el header, es redundante.

### 5) La Marzocco Home

**Positivos**

- Buen equilibrio entre catálogo de producto (máquinas) y contenido educativo/institucional (Accademia del Caffè Espresso).
- Diseño elegante, con fotografía de producto de alta calidad, coherente con el posicionamiento premium de la marca.
- Blog de novedades bien integrado, con fechas y actualizaciones frecuentes visibles en la home.

**Negativos**

- Enfocado en la venta de equipamiento, no en el barismo o el arte latte en sí, así que como referencia de contenido es más limitado.
- El aviso de cookies y las capas de personalización pueden interrumpir la primera visita.
- Al tener versiones por país (home vs. profesional, distintos dominios), la navegación puede confundir a un usuario nuevo.

## 4. Wireframes a mano — secciones (mínimo 10)

1. Header / navegación principal
2. Hero o banner principal (imagen de un latte art destacado)
3. Sobre nosotros / nuestra historia como cafetería o barista
4. Menú de cafés (espresso, con leche, bebidas frías)
5. Galería de arte latte (diseños destacados)
6. Perfil de baristas / equipo
7. Clases o talleres de barismo
8. Blog o novedades sobre café
9. Testimonios o reseñas de clientes
10. Ubicación y horarios (mapa embebido)
11. Tienda online (granos, equipos)
12. Contacto / formulario / newsletter
13. Footer con redes sociales y enlaces legales

julieta cardozo — Tecnicatura Superior en Análisis de Sistemas, IES N° 6.001 (Salta, Argentina)
