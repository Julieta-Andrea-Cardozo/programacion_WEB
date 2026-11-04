# TP N° 6 — Diseño y normalización del esquema relacional

Proyecto integrador: **Barismo & Café**, sitio de una cafetería de especialidad con tienda online
(café en grano, insumos y suscripciones), talleres de barismo y usuarios registrados.

Archivos de esta entrega:

| Archivo            | Contenido                                                       |
| ------------------ | --------------------------------------------------------------- |
| `NORMALIZACION.md` | Parte 1: tabla sin normalizar, 1FN, 2FN, 3FN y tablas finales   |
| `schema.sql`       | Parte 2: script DDL (base, tablas, PK, FK, auditoría e índices) |
| `consultas.sql`    | Parte 3: sentencias DML de prueba (INSERT, SELECT, UPDATE, DELETE) |

## 1. Tabla principal sin normalizar

Así se vería un pedido de la tienda si se guardara todo en una sola tabla, como en una planilla:

| pedido | fecha      | cliente   | email_cliente      | rol_cliente | productos                                        | categorias            | precios       | cantidades | estado    | direccion_envio          | total |
| ------ | ---------- | --------- | ------------------ | ----------- | ------------------------------------------------ | --------------------- | ------------- | ---------- | --------- | ------------------------ | ----- |
| 1      | 04/11/2026 | Ana Gómez | ana.gomez@mail.com | cliente     | Colombia Huila, Kit Barista Inicial              | Café en grano, Insumos | 3800, 12500   | 2, 1       | pendiente | Av. Belgrano 1234, Salta | 20100 |
| 2      | 05/11/2026 | Martín Ruiz | martin.ruiz@mail.com | cliente | Ethiopia Yirgacheffe, Box Mensual Barismo        | Café en grano, Suscripciones | 4200, 7500 | 1, 1     | pagado    | Caseros 560, Salta       | 11700 |
| 3      | 06/11/2026 | Ana Gómez | ana.gomez@mail.com | cliente     | Colombia Huila                                   | Café en grano         | 3800          | 1          | pendiente | Av. Belgrano 1234, Salta | 3800  |

Problemas que se observan:

- **Campos multivalorados:** `productos`, `categorias`, `precios` y `cantidades` guardan listas
  separadas por comas en una sola celda. No se puede buscar ni sumar un producto en particular.
- **Redundancia:** los datos de Ana (nombre, email, rol, dirección) se repiten en cada pedido. Si
  cambia su email hay que modificar varias filas (anomalía de actualización).
- **Datos derivados:** `total` se puede calcular a partir de precios y cantidades.
- **Anomalía de inserción:** no se puede cargar un producto nuevo hasta que alguien lo compre.
- **Anomalía de borrado:** si se borra el pedido 2 se pierde que existe el Box Mensual Barismo.

## 2. Primera Forma Normal (1FN)

Regla: cada celda debe tener un único valor atómico y no puede haber grupos repetitivos.

Se separa cada producto del pedido en su propia fila y el nombre del cliente en `nombre` y
`apellido`. La clave pasa a ser compuesta: **(pedido, producto)**. Se quita `total` porque es un
dato calculado.

| **pedido** | **producto**         | fecha      | nombre | apellido | email              | rol     | categoria     | precio_unitario | cantidad | estado    | direccion_envio          |
| ---------- | -------------------- | ---------- | ------ | -------- | ------------------ | ------- | ------------- | --------------- | -------- | --------- | ------------------------ |
| 1          | Colombia Huila       | 04/11/2026 | Ana    | Gómez    | ana.gomez@mail.com | cliente | Café en grano | 3800            | 2        | pendiente | Av. Belgrano 1234, Salta |
| 1          | Kit Barista Inicial  | 04/11/2026 | Ana    | Gómez    | ana.gomez@mail.com | cliente | Insumos       | 12500           | 1        | pendiente | Av. Belgrano 1234, Salta |
| 2          | Ethiopia Yirgacheffe | 05/11/2026 | Martín | Ruiz     | martin.ruiz@mail.com | cliente | Café en grano | 4200          | 1        | pagado    | Caseros 560, Salta       |
| 2          | Box Mensual Barismo  | 05/11/2026 | Martín | Ruiz     | martin.ruiz@mail.com | cliente | Suscripciones | 7500          | 1        | pagado    | Caseros 560, Salta       |
| 3          | Colombia Huila       | 06/11/2026 | Ana    | Gómez    | ana.gomez@mail.com | cliente | Café en grano | 3800            | 1        | pendiente | Av. Belgrano 1234, Salta |

Ahora todos los valores son atómicos, pero la redundancia aumentó: los datos del pedido y del
cliente se repiten por cada producto.

## 3. Segunda Forma Normal (2FN)

Regla: estar en 1FN y que todo atributo no clave dependa de la clave primaria **completa**, no de
una parte.

Dependencias funcionales sobre la clave (pedido, producto):

| Atributo                                                          | Depende de            | Tipo        |
| ----------------------------------------------------------------- | --------------------- | ----------- |
| fecha, nombre, apellido, email, rol, estado, direccion_envio      | solo `pedido`         | parcial     |
| categoria                                                         | solo `producto`       | parcial     |
| cantidad, precio_unitario                                         | (pedido, producto)    | completa    |

`precio_unitario` se queda en el detalle a propósito: es el precio **al momento de la compra**. Si
mañana sube el precio del producto, los pedidos viejos no deben cambiar.

Se descompone en tres tablas, cada una con su propia clave:

**pedidos** (PK `id`)

| **id** | fecha      | nombre | apellido | email                | rol     | estado    | direccion_envio          |
| ------ | ---------- | ------ | -------- | -------------------- | ------- | --------- | ------------------------ |
| 1      | 04/11/2026 | Ana    | Gómez    | ana.gomez@mail.com   | cliente | pendiente | Av. Belgrano 1234, Salta |
| 2      | 05/11/2026 | Martín | Ruiz     | martin.ruiz@mail.com | cliente | pagado    | Caseros 560, Salta       |
| 3      | 06/11/2026 | Ana    | Gómez    | ana.gomez@mail.com   | cliente | pendiente | Av. Belgrano 1234, Salta |

**productos** (PK `id`)

| **id** | nombre               | categoria     | precio |
| ------ | -------------------- | ------------- | ------ |
| 1      | Ethiopia Yirgacheffe | Café en grano | 4200   |
| 2      | Colombia Huila       | Café en grano | 3800   |
| 5      | Kit Barista Inicial  | Insumos       | 12500  |
| 6      | Box Mensual Barismo  | Suscripciones | 7500   |

**detalle_pedidos** (PK `id`, único `pedido_id + producto_id`)

| **id** | pedido_id (FK) | producto_id (FK) | cantidad | precio_unitario |
| ------ | -------------- | ---------------- | -------- | --------------- |
| 1      | 1              | 2                | 2        | 3800            |
| 2      | 1              | 5                | 1        | 12500           |
| 3      | 2              | 1                | 1        | 4200            |
| 4      | 2              | 6                | 1        | 7500            |
| 5      | 3              | 2                | 1        | 3800            |

## 4. Tercera Forma Normal (3FN)

Regla: estar en 2FN y que ningún atributo no clave dependa de otro atributo no clave
(dependencias transitivas).

Dependencias transitivas que quedan:

| Tabla       | Dependencia transitiva                                   | Solución                                   |
| ----------- | -------------------------------------------------------- | ------------------------------------------ |
| `pedidos`   | `id → email → nombre, apellido, rol`                     | Tabla `usuarios`; el pedido guarda `usuario_id` |
| `usuarios`  | `id → rol → descripción del rol`                         | Tabla `roles`; el usuario guarda `rol_id`  |
| `pedidos`   | `id → estado` (texto repetido, se puede escribir mal)    | Tabla `estados_pedido`; el pedido guarda `estado_id` |
| `productos` | `id → categoria → descripción de la categoría`           | Tabla `categorias`; el producto guarda `categoria_id` |

Con el mismo criterio se modelaron los **talleres** de barismo del sitio: el nivel (Inicial,
Intermedio, Avanzado) pasa a la tabla `niveles`, y como un usuario puede anotarse en varios talleres
y un taller tiene varios alumnos (N:M), se agrega la tabla de relación `inscripciones`.

## 5. Tablas resultantes

```
roles            usuarios                 pedidos               detalle_pedidos        productos          categorias
─────────        ──────────────           ────────────          ───────────────        ──────────         ──────────
PK id      1───N FK rol_id         1───N  FK usuario_id   1───N FK pedido_id     N───1 PK id        N───1 PK id
   nombre        PK id                    PK id                 PK id                  FK categoria_id       nombre
   descripcion   nombre, apellido         FK estado_id          FK producto_id         nombre                descripcion
                 email (UNIQUE)           direccion_envio       cantidad               descripcion
                 password (hash)          created_at            precio_unitario        precio, stock
                 telefono, activo         updated_at                                   estrellas, imagen
                 created_at, updated_at        │                                       activo
                       │                       N                                       created_at, updated_at
                       │                       1
                       │                  estados_pedido
                       │                  PK id, nombre
                       │
                       1───N inscripciones N───1 talleres N───1 niveles
                             PK id               PK id          PK id
                             FK usuario_id       FK nivel_id    nombre
                             FK taller_id        nombre, fecha
                             created_at          cupo, precio
```

| Tabla             | Tipo              | PK   | FK                                                    | Otros campos                                                       |
| ----------------- | ----------------- | ---- | ----------------------------------------------------- | ------------------------------------------------------------------ |
| `roles`           | Maestra           | `id` | —                                                     | `nombre` (UNIQUE), `descripcion`                                   |
| `categorias`      | Maestra           | `id` | —                                                     | `nombre` (UNIQUE), `descripcion`                                   |
| `estados_pedido`  | Maestra           | `id` | —                                                     | `nombre` (UNIQUE)                                                  |
| `niveles`         | Maestra           | `id` | —                                                     | `nombre` (UNIQUE)                                                  |
| `usuarios`        | Usuarios          | `id` | `rol_id → roles.id`                                   | `nombre`, `apellido`, `email` (UNIQUE), `password`, `telefono`, `activo`, auditoría |
| `productos`       | Principal         | `id` | `categoria_id → categorias.id`                        | `nombre`, `descripcion`, `precio`, `stock`, `estrellas`, `imagen`, `activo`, auditoría |
| `pedidos`         | Principal         | `id` | `usuario_id → usuarios.id`, `estado_id → estados_pedido.id` | `direccion_envio`, auditoría                                   |
| `talleres`        | Principal         | `id` | `nivel_id → niveles.id`                               | `nombre`, `fecha`, `cupo`, `precio`, auditoría                     |
| `detalle_pedidos` | Relación N:M      | `id` | `pedido_id → pedidos.id`, `producto_id → productos.id` | `cantidad`, `precio_unitario`; UNIQUE (`pedido_id`, `producto_id`) |
| `inscripciones`   | Relación N:M      | `id` | `usuario_id → usuarios.id`, `taller_id → talleres.id` | `created_at`; UNIQUE (`usuario_id`, `taller_id`)                   |

## 6. Decisiones del script DDL

- **Claves primarias** `INT AUTO_INCREMENT PRIMARY KEY` en todas las tablas.
- **Claves foráneas** con `ON DELETE RESTRICT` para no dejar pedidos sin cliente ni productos sin
  categoría, y `ON DELETE CASCADE` en las tablas de detalle (si se borra un pedido se borran sus
  líneas).
- **Auditoría:** `created_at` y `updated_at` (`ON UPDATE CURRENT_TIMESTAMP`) en las tablas
  principales.
- **Tipos de datos:** `DECIMAL(10,2)` para dinero (no `FLOAT`, que redondea), `VARCHAR(255)` para el
  hash de la contraseña (bcrypt), `TINYINT(1)` para banderas y `DATE` para la fecha del taller.
- **Restricciones `CHECK`:** precio mayor a 0, cantidad mayor a 0 y estrellas entre 1 y 5.
- **Índices explícitos (`CREATE INDEX`):**
  - `idx_productos_categoria_activo (categoria_id, activo)`: la tienda filtra siempre por categoría
    y solo muestra productos activos.
  - `idx_productos_nombre (nombre)`: buscador de la tienda.
  - `idx_pedidos_estado (estado_id, created_at)`: listar pedidos pendientes ordenados por fecha.
  - `idx_usuarios_apellido (apellido)`: búsqueda de clientes en el panel.
  - El `email` ya tiene índice por ser `UNIQUE`, que se usa en el login.

## 7. Cómo probarlo (XAMPP / Laragon)

1. Iniciar MySQL desde el panel de XAMPP o Laragon.
2. En phpMyAdmin, pestaña **SQL** (o **Importar**): ejecutar primero `schema.sql` y después
   `consultas.sql`.
3. Por consola:

   ```bash
   mysql -u root < schema.sql
   mysql -u root -t < consultas.sql
   ```

La base se llama `barismo_tp6` para no pisar la base `barismo` que usa el CRUD de la Clase 7.
`schema.sql` se puede volver a ejecutar: borra las tablas en orden y las crea de nuevo.

Probado en MariaDB 10.6 (la misma que trae XAMPP); los dos scripts corren sin errores.
