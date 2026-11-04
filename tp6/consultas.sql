-- =====================================================================
-- TP N° 6 · Consultas de prueba CRUD (DML) para Barismo & Café
-- Ejecutar después de schema.sql:
--   mysql -u root < consultas.sql
-- =====================================================================

USE barismo_tp6;

-- ---------------------------------------------------------------------
-- 1. CREATE: datos iniciales
-- ---------------------------------------------------------------------

-- Tablas maestras
INSERT INTO roles (nombre, descripcion) VALUES
  ('admin', 'Administra productos, talleres y pedidos'),
  ('cliente', 'Compra en la tienda y se inscribe a talleres');

INSERT INTO categorias (nombre, descripcion) VALUES
  ('Café en grano', 'Orígenes de especialidad, tostado artesanal'),
  ('Insumos', 'Molinos, tampers y accesorios para barista'),
  ('Suscripciones', 'Envíos mensuales de café');

INSERT INTO estados_pedido (nombre) VALUES
  ('pendiente'), ('pagado'), ('enviado'), ('entregado'), ('cancelado');

INSERT INTO niveles (nombre) VALUES
  ('Inicial'), ('Intermedio'), ('Avanzado');

-- Usuarios (las contraseñas se guardan con password_hash de PHP, nunca en texto plano)
INSERT INTO usuarios (rol_id, nombre, apellido, email, password, telefono) VALUES
  (1, 'Julieta', 'Cardozo', 'admin@barismo.com.ar',
   '$2y$10$hiMgmBd.DwxCy.aVBa3ZQuqjsomi2TR5p3KGSsG7rtzuYTK83x9ki', '+54 387 555-0101'),
  (2, 'Ana', 'Gómez', 'ana.gomez@mail.com',
   '$2y$10$d5MtAau63g/st2c44ACedO6WMJEA1yshM5mLr2S/hP3xhZNvVjzUa', '+54 387 555-0202'),
  (2, 'Martín', 'Ruiz', 'martin.ruiz@mail.com',
   '$2y$10$d5MtAau63g/st2c44ACedO6WMJEA1yshM5mLr2S/hP3xhZNvVjzUa', NULL);

-- Tabla principal: productos vinculados a su categoría (FK)
INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock, estrellas, imagen) VALUES
  (1, 'Ethiopia Yirgacheffe', 'Jazmín · Durazno · Limón', 4200.00, 25, 5, 'grano-etiopia.jpg'),
  (1, 'Colombia Huila', 'Caramelo · Uva · Chocolate', 3800.00, 30, 5, 'grano-colombia.jpg'),
  (1, 'Brasil Cerrado', 'Chocolate · Avellana · Bajo', 2900.00, 40, 4, 'grano-brasil.jpg'),
  (2, 'Molino de Disco Cerámico', '40 graduaciones, ideal para espresso y filtrado', 38000.00, 5, 5, 'insumo-molino.jpg'),
  (2, 'Kit Barista Inicial', 'Tamper, jarra y tabla de golpes', 12500.00, 12, 4, 'insumo-kit.jpg'),
  (3, 'Box Mensual Barismo', 'Dos orígenes sorpresa por mes', 7500.00, 100, 5, 'insumo-bolsa.jpg');

-- Pedidos con su detalle (N:M pedidos-productos)
INSERT INTO pedidos (usuario_id, estado_id, direccion_envio) VALUES
  (2, 1, 'Av. Belgrano 1234, Salta'),
  (3, 2, 'Caseros 560, Salta');

INSERT INTO detalle_pedidos (pedido_id, producto_id, cantidad, precio_unitario) VALUES
  (1, 2, 2, 3800.00),
  (1, 5, 1, 12500.00),
  (2, 1, 1, 4200.00),
  (2, 6, 1, 7500.00);

-- Talleres e inscripciones (N:M usuarios-talleres)
INSERT INTO talleres (nivel_id, nombre, fecha, cupo, precio) VALUES
  (1, 'Introducción al espresso', '2026-11-14', 8, 15000.00),
  (2, 'Arte latte: corazón y tulipán', '2026-11-21', 6, 22000.00),
  (3, 'Rosetta y diseños avanzados', '2026-11-28', 6, 28000.00);

INSERT INTO inscripciones (usuario_id, taller_id) VALUES
  (2, 1), (2, 2), (3, 1);

-- ---------------------------------------------------------------------
-- 2. READ: consultas y uniones
-- ---------------------------------------------------------------------

-- Productos con precio mayor a $3.500, del más caro al más barato.
SELECT id, nombre, precio, stock
FROM productos
WHERE precio > 3500 AND activo = 1
ORDER BY precio DESC;

-- Productos de la tienda con el nombre de su categoría (INNER JOIN).
SELECT p.nombre AS producto, c.nombre AS categoria, p.precio
FROM productos p
INNER JOIN categorias c ON c.id = p.categoria_id
WHERE p.activo = 1
ORDER BY c.nombre, p.nombre;

-- Detalle de cada pedido: cliente, estado, productos y subtotal (JOIN de 5 tablas).
SELECT
  pe.id AS pedido,
  CONCAT(u.nombre, ' ', u.apellido) AS cliente,
  ep.nombre AS estado,
  pr.nombre AS producto,
  dp.cantidad,
  dp.precio_unitario,
  dp.cantidad * dp.precio_unitario AS subtotal
FROM pedidos pe
INNER JOIN usuarios u ON u.id = pe.usuario_id
INNER JOIN estados_pedido ep ON ep.id = pe.estado_id
INNER JOIN detalle_pedidos dp ON dp.pedido_id = pe.id
INNER JOIN productos pr ON pr.id = dp.producto_id
ORDER BY pe.id, pr.nombre;

-- Total de cada pedido (el total se calcula, no se guarda: evita datos redundantes).
SELECT pe.id AS pedido, SUM(dp.cantidad * dp.precio_unitario) AS total
FROM pedidos pe
INNER JOIN detalle_pedidos dp ON dp.pedido_id = pe.id
GROUP BY pe.id
ORDER BY total DESC;

-- Inscriptos por taller con su nivel.
SELECT t.nombre AS taller, n.nombre AS nivel, u.nombre, u.apellido, u.email
FROM inscripciones i
INNER JOIN talleres t ON t.id = i.taller_id
INNER JOIN niveles n ON n.id = t.nivel_id
INNER JOIN usuarios u ON u.id = i.usuario_id
ORDER BY t.fecha, u.apellido;

-- Usuarios con su rol.
SELECT u.id, u.nombre, u.apellido, u.email, r.nombre AS rol
FROM usuarios u
INNER JOIN roles r ON r.id = u.rol_id
ORDER BY r.nombre, u.apellido;

-- ---------------------------------------------------------------------
-- 3. UPDATE: siempre con WHERE sobre un registro concreto
-- ---------------------------------------------------------------------

-- Aumento de precio del Colombia Huila.
UPDATE productos
SET precio = 4100.00
WHERE id = 2;

-- El pedido 1 pasa de "pendiente" a "enviado".
UPDATE pedidos
SET estado_id = (SELECT id FROM estados_pedido WHERE nombre = 'enviado')
WHERE id = 1;

-- Verificación de los cambios
SELECT id, nombre, precio, updated_at FROM productos WHERE id = 2;
SELECT pe.id, ep.nombre AS estado, pe.updated_at
FROM pedidos pe
INNER JOIN estados_pedido ep ON ep.id = pe.estado_id
WHERE pe.id = 1;

-- ---------------------------------------------------------------------
-- 4. DELETE: baja de un registro de prueba con WHERE
-- ---------------------------------------------------------------------

-- Martín cancela su inscripción al taller de introducción.
DELETE FROM inscripciones
WHERE usuario_id = 3 AND taller_id = 1;

-- Producto de prueba que se da de alta y luego se elimina.
INSERT INTO productos (categoria_id, nombre, descripcion, precio, stock)
VALUES (2, 'Producto de prueba', 'Registro temporal para probar el DELETE', 100.00, 1);

DELETE FROM productos
WHERE nombre = 'Producto de prueba';

-- Verificación
SELECT COUNT(*) AS inscripciones_restantes FROM inscripciones;
SELECT COUNT(*) AS productos_restantes FROM productos;
